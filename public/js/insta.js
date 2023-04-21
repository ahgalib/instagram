$(function(){
    $(".reply-div").hide();
    $('.reply').click(function(){
        let parent_id = $(this).attr('data-parent');
        $('.parent').attr('value',parent_id);
        $(".reply-div").show();
        //alert(parent_id);
    })
})
