$(document).ready(function () {});

$(document).ready(function () {

  $(document).on('click', '.social-share__item button', function (e) {
    e.preventDefault();
    logClick('Button: ' + $(this).data('social'), $(this).data('position'));
    alert('Thanks for being willing to share this article, but for the purposes of this study, we have disabled the share function.');
  });

  function log(action, label, comment) {
    var xhr = new XMLHttpRequest();

    xhr.open('POST', '../../inc/class.log.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
      if (xhr.status === 200) {
        // alert('Something went wrong.  Name is now ' + xhr.responseText);
        // xhr.send(encodeURI('log=' +logContent ));
      } else if (xhr.status !== 200) {
        alert('Request failed.  Returned status of ' + xhr.status);
      }
    };
    xhr.send(encodeURI('log=true&identifier=' + studyID + '&user_id=' + userID + '&action=' + action + '&comment=' + comment + '&label=' + label + '&url=' + window.location.href));
  }

  // label == what it is
  function logClick(label, comment) {
    var action = 'click';
    log(action, label, comment);
  }

  // capture page load
  log('Page View', pageTitle, 'Loaded');

  ////////////////
  /// Comments ///
  ////////////////

  $("#submit-comment").click(function (event) {
    var commenter_name = $("#commenter-name").val();
    var new_comment = $("#commenter-comment").val();
    var url = pageTitle;
    var label = userID;

    if (commenter_name.length > 0 && new_comment.length > 0) {
      submitComment(commenter_name, new_comment, label);
      // send to google
      ga('send', 'event', 'Comments', 'Add Comment', label);
    } else {
      submitCommentError();
      // var commenter_position = ".support";
      // send to google
      ga('send', 'event', 'Comments', 'Add Comment Error', label);
    }

    // var commenter_position = ".support";
    event.preventDefault();
  });

  function submitComment(name, comment, identifier, url) {
    $(".new-comment").replaceWith('<div class="alert alert-success">Thanks for your comment!</div>');

    log('Comment', 'Add Comment', name + ': ' + comment);
  }

  function submitCommentError() {
    $('.alert-error').remove();
    $(".new-comment").append("<div class='alert alert-error'>* Please enter your name and a comment.</div>");
    log('Comment', 'Add Comment', 'Add Comment Error');
  }

  function receiveMessage(event) {
    var whitelist = ['https://localhost:3000', 'https://eyp-study.test', 'https://thenewsbeat.org', 'https://stroudresearch.net', 'https://mediaengagement.org', 'https://utexas.ca1.qualtrics.com'];
    // Do we trust the sender of this message?  (might be
    // different from what we originally opened, for example).
    if (whitelist.indexOf(event.origin) == -1) {
      console.error('postMessage from ' + event.origin + ' not allowed');
      return;
    }

    console.log('child message recieved', event);
  }
  window.addEventListener("message", receiveMessage, false);
});