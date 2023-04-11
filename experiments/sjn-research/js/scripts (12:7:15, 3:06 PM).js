$(document).ready(function() {

    // hide comments on page load
    if($('.comments-section').length) {
        $('.comments-section').hide();
    }

    $('.show-comments').click(function(e){
        e.preventDefault();
        $('.show-comments-wrap').remove();
        $('.comments-section').fadeIn();
        var label = $('#user-ip').attr('data-ip');
        // send to google
        ga('send','event','Comments', 'Show Comments', label);
    });

    $('.social-share__link').click(function(e){
        var action = $(this).attr('data-action');
        var label = $(this).attr('data-label');
        ga('send','event', 'Social', action, label);
    });


});
