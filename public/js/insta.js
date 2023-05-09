$(function(){
    $(".reply-div").hide();
    $('.reply').click(function(){
        let parent_id = $(this).attr('data-parent');
        $('.parent').attr('value',parent_id);
        $(".reply-div").show();
        //alert(parent_id);
    });

    $('.like').click(function(){

        var postId = $(this).attr('data-post');
        //alert(postId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url:'ajax/like',
            type:'post',
            data:{postId:postId},
            success:function(resp){
               $('.like-append').hide();
               $('.unlike').html(resp);
                //$('.unlike-append').html(resp);
            },error:function(){
                alert('error ay geya');
            }

        })


    })
})
