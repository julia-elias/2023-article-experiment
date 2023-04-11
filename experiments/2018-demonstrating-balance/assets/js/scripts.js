
$(document).ready(function() {

    // track all link clicks
    $(document).on('click', 'a', function(e) {
      e.preventDefault();
      url = $(this).attr('href');
      linkText = trimText($(this).text());
      if($(this).data('position')) {
        linkText = $(this).data('position')+': '+linkText
      }

      // check if this is a 'go back to article' link. If so, set the url correctly
      if($(this).hasClass('prev-article')) {
        // get our previous article
        var history = JSON.parse(sessionStorage.getItem('history'))
        // it won't be the last item, but the second to last item
        url = window.location.origin + history[history.length - 2]

        // splice the array before this item, as we're going to be adding it to the end of the history next load
        history = history.slice(0, history.length - 2)
        // set the history with these items removed
        sessionStorage.setItem('history', JSON.stringify(history))
      }
      // send off a message to the parent page
      // allow all domains to access this message
      parent.postMessage(JSON.stringify({action: 'pageClick'}), "*")

      logClick('Link: '+ linkText, url);
      window.location.href = url;
    });

    $(document).on('click', '.social-share__item button', function(e) {
      e.preventDefault();
      logClick('Button: '+ $(this).data('social'), $(this).data('position'));
      alert('Thanks for being willing to share this article, but for the purposes of this study, we have disabled the share function.');
    });

    function trimText(text) {
      text = $.trim(text);
      text = text.replace(/\r?\n|\r/g, " ");
      // if there's multiple spaces, condense them
      text = text.replace(/\s\s\s/g, "");

      return text;
    }


    function log(action, label, comment) {
        var xhr = new XMLHttpRequest();

        xhr.open('POST', '../../inc/class.log.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // alert('Something went wrong.  Name is now ' + xhr.responseText);
                // xhr.send(encodeURI('log=' +logContent ));
            }
            else if (xhr.status !== 200) {
                alert('Request failed.  Returned status of ' + xhr.status);
            }
        };
        xhr.send(encodeURI('log=true&identifier='+studyID+'&user_id='+userID+'&action='+action+'&comment='+comment+'&label='+label+'&url='+window.location.href));
    }

    // label == what it is
    function logClick(label, comment) {
        var action = 'click';
        log(action, label, comment);
    }

    // capture page load
    log('Page View', pageTitle, 'Loaded');


    ///////////////////////
    /// Session History ///
    ///////////////////////

    if(!sessionStorage.getItem('history')) {
      // no history! Create the session
      sessionStorage.setItem('history', '[]');
    }
    var history = JSON.parse(sessionStorage.getItem('history'))
    // check to make sure it's not a reload. We don't want to add the same path twice in a row
    if(0 === history.length || history[history.length - 1] !== window.location.pathname) {
      // push our new one
      history.push(window.location.pathname)
      // store it
      sessionStorage.setItem('history', JSON.stringify(history))
    }

    // if there's a place to go back, add in our PREV links
    if(2 <= history.length) {
      var prevLink = '<a class="prev-article" href="#"><svg class="icon icon--arrow_back"><use xlink:href="#arrow_back"></use></svg> Go Back to Previous Article</a>'
      // where to insert it?
      $('#content').prepend(prevLink)
      $('.social-share--bottom').before(prevLink)
    }

    ////////////////
    /// Comments ///
    ////////////////

    $("#submit-comment").click(function(event) {
      var commenter_name = $("#commenter-name").val();
      var new_comment = $("#commenter-comment").val();
      var url = pageTitle;
      var label = userID;

      if (commenter_name.length > 0 && new_comment.length > 0 ) {
        submitComment(commenter_name, new_comment, label);
        // send to google
        ga('send', 'event','Comments', 'Add Comment', label);


      } else {
        submitCommentError();
        // var commenter_position = ".support";
        // send to google
        ga('send','event','Comments', 'Add Comment Error', label);

      }

      // var commenter_position = ".support";
      event.preventDefault();
    });


    function submitComment(name, comment, identifier, url) {
      $(".new-comment").replaceWith('<div class="alert alert-success">Thanks for your comment!</div>');

      log('Comment', 'Add Comment', name+ ': '+comment);
    }

    function submitCommentError() {
      $('.alert-error').remove();
      $(".new-comment").append("<div class='alert alert-error'>* Please enter your name and a comment.</div>");
      log('Comment', 'Add Comment', 'Add Comment Error');
    }

    function receiveMessage(event){
        var whitelist = [
          'https://localhost:3000',
          'https://demonstrating-balance.test',
          'https://thenewsbeat.org',
          'https://stroudresearch.net',
          'https://mediaengagement.org',
          'https://utexas.ca1.qualtrics.com'
        ]
        // Do we trust the sender of this message?  (might be
        // different from what we originally opened, for example).
        if (whitelist.indexOf(event.origin) == -1) {
          console.error('postMessage from '+event.origin + ' not allowed')
          return
        }

        console.log('child message recieved', event)
    }
    window.addEventListener("message", receiveMessage, false);

});
