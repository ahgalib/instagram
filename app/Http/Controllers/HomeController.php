<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($user)
    {
        $user = User::find($user);
        return view('home', ['user' => $user]);
    }
    //    function createPost(Request $request){
    //        $data = $request->validate([
    //            'caption'=>'required',
    //            'image'=>'required|image|mimes:jpeg,png,jpg',
    //        ]);
    //       // $imagePath = request('image')->store('uploads','public');
    //        $upload_file = $request->image;
    //        $extension = $upload_file->getClientOriginalExtension();
    //        $file_name = rand(00000,88888).'.'.$extension;
    //         Image::make($upload_file)->save(public_path('uploads/posts/'.$file_name));
    //        $request->user()->posts()->create([
    //            'caption'=>$data['caption'],
    //             'image'=>$file_name,

    //        ]);
    //        //$post->image = $req->file('image')->store('uploads','public');

    //        return redirect('user/'.auth()->user()->id);

    //    }




    public function createPost(Request $request)
    {
        // 1. Validation (Same as your original code)
        $data = $request->validate([
            'caption' => 'required|string|max:2000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000', // Max 5MB file size
        ]);

        // --- GEMINI API VALIDATION START ---

        try {
            // Get the original file instance
            $upload_file = $request->image;
            $caption = $data['caption'];

            // A. Convert Image to Base64
            // Get the contents of the uploaded file and encode it to Base64
            $imageContents = file_get_contents($upload_file->getRealPath());
            $base64Image = base64_encode($imageContents);
            $mimeType = $upload_file->getClientMimeType();

            // B. Construct the API Payload
            $apiKey = env('GEMINI_API_KEY');
            if (empty($apiKey)) {
                throw new \Exception("GEMINI_API_KEY is not configured.");
            }

            $apiEndpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            // Caption validation part
                            [
                                'text' => "Analyze the following caption and image for safety and policy compliance. ONLY respond with 'safe' if both are completely safe, or 'unsafe' if either is questionable. Do not elaborate or provide any other text. Caption: '{$caption}'"
                            ],
                            // Image validation part (Multimodal)
                            [
                                'inlineData' => [
                                    'mimeType' => $mimeType,
                                    'data' => $base64Image,
                                ],
                            ],
                        ],
                    ],
                ],
                // Setting safety limits if needed, but the model's default safety check is strong.
                // We mainly rely on the model's internal safety classifier and the structured output/check.
            ];

            // C. Call the Gemini API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                // API Key is typically passed as a query parameter in the URL for REST calls
            ])->post("{$apiEndpoint}?key={$apiKey}", $payload);


            // D. Check for API/Request Errors
            if ($response->failed()) {
                Log::error("Gemini API Error: " . $response->body());
                // For a failed API call, we'll block the post or proceed with a warning, depending on policy.
                // For safety, we will block it here.
                return redirect()->back()->withInput()->withErrors(['image' => 'Content validation service temporarily unavailable. Please try again later.']);
            }

            // E. & F. Extract the result and check safety ratings/blocks
            $apiResult = $response->json();

            dd($apiResult);
            // 1. **CRITICAL CHECK:** Check if the prompt/input was blocked immediately by the API
            $isBlockedByPrompt = isset($apiResult['promptFeedback']['blockReason']);

            if ($isBlockedByPrompt) {
                // This catches your specific "blockReason" => "OTHER"

                Log::warning('Post Blocked by Gemini API (Prompt Feedback):', [
                    'user_id' => $request->user()->id,
                    'caption' => $caption,
                    'image_mime' => $mimeType,
                    'reason' => 'Input Blocked (Reason: ' . ($apiResult['promptFeedback']['blockReason'] ?? 'Unknown') . ')',
                    // Note: Safety ratings might be in promptFeedback for some blocks, but we check if it was blocked.
                ]);

                // BLOCK POST
                return redirect()->back()->withInput()->withErrors(['image' => 'The content (image or caption) violates our community guidelines and has been blocked.']);
            }

            // 2. If not blocked immediately, proceed to check the generated candidates
            $candidates = $apiResult['candidates'] ?? [];

            // If candidates are present, check the finish reason and the model's explicit response
            if (!empty($candidates)) {
                $candidate = $candidates[0];

                // Check 2a. If the model blocked the response during generation
                $isBlockedByModel = isset($candidate['finishReason']) &&
                    $candidate['finishReason'] === 'SAFETY';

                // Check 2b. Safely extract the model's explicit 'unsafe' classification
                $responseText = $candidate['content']['parts'][0]['text'] ?? '';
                $isExplicitlyUnsafe = (strtolower(trim($responseText)) === 'unsafe');

                if ($isExplicitlyUnsafe || $isBlockedByModel) {

                    Log::warning('Post Blocked by Gemini API (Candidate Check):', [
                        'user_id' => $request->user()->id,
                        'caption' => $caption,
                        'image_mime' => $mimeType,
                        'reason' => $isBlockedByModel ? 'Model Blocked (SAFETY)' : 'Model Classified as Unsafe',
                        'safety_ratings' => $candidate['safetyRatings'] ?? [],
                    ]);

                    // BLOCK POST
                    return redirect()->back()->withInput()->withErrors(['image' => 'The content (image or caption) violates our community guidelines and has been blocked.']);
                }
            }

            // --- GEMINI API VALIDATION END (Content is deemed safe) ---
        } catch (\Exception $e) {
            Log::error("Gemini Validation System Exception: " . $e->getMessage());
            // Optionally, you might choose to let the post go through if validation fails due to an *external* error,
            // but for a robust safety system, blocking is safer.
            return redirect()->back()->withInput()->withErrors(['image' => 'A critical error occurred during content check. Please try again.']);
        }

        // --- GEMINI API VALIDATION END (Content is deemed safe) ---


        // 2. File Handling (Original logic, slightly cleaned up)
        $extension = $upload_file->getClientOriginalExtension();
        $file_name = uniqid() . time() . '.' . $extension; // Generate a unique filename

        // Use Intervention Image to save the file
        // IMPORTANT: The file must be saved to the location where your server serves uploads.
        // public_path('uploads/posts/') is a common convention.
        Image::make($upload_file)->save(public_path('uploads/posts/' . $file_name));

        // 3. Database Save (Original logic)
        $request->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $file_name,
        ]);

        // 4. Redirect
        return redirect('user/' . auth()->user()->id);
    }
}
