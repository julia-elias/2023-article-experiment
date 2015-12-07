$(document).ready(function() {

    // hide comments on page load
    if($('.comments-section').length) {
        $('.comments-section').hide();
    }

    $('.show-comments').click(function(e){
        e.preventDefault();
        $('.show-comments-wrap').remove();
        $('.comments-section').fadeIn();
        // send to google
        ga('send','event','Button','Click', 'Show Comments');
    });

    $('.social-share__link').click(function(e){
        var label = $(this).attr('data-event');
        ga('send','event','Button', 'Click', label);
    });


});
