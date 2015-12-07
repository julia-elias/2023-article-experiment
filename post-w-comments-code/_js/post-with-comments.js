$(document).ready(function(){
  
  $("#submit-comment").click(function(event) {
    var commenter_name = $("#commenter-name").val();
    var new_comment = $("#commenter-comment").val();
    var commenter_position = ".support";
    
    if (commenter_name.length > 0 && new_comment.length > 0 && commenter_position.length > 0 ) {
      submitComment(commenter_name, new_comment, commenter_position);
    } else {
      submitCommentError();
    }
    
    event.preventDefault();
  });   
  
  for (var i = 1; i <= $('.comment').length; i++) {
    $("#comment-" + i).click(function(event) {
      likeClicked(this);
    });
  }
  
  function likeClicked(element) {
    // returns comment-1 
    var element_id = $(element).attr("id");
    
    $(element).attr("disabled", "disabled");
    
    var current_like_count = $("#" + element_id + "-like-count").val();
    var new_count = parseInt(current_like_count) + 1;
    
    $(element).val(button_name + " (" + new_count + ")");
    

    //IP|datetime|type|comment|name
    //10.1.1.1|nov 14th 5pm|button|comment-1|like
    
    $.ajax({
			type: "POST",
			url: "_code/ProcessPoll.php",
			dataType: "json",
			data: { button : button_name,  id : element_id }
		})
    
    //console.log("ipaddress" + "|" + element_id + "|" + "liked");
  }  
   
  function submitComment(name, comment, commenter_position) {
    var myDate = new Date();
    // TODO format date
    //var displayDate = (myDate.getMonth()+1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();
    
    $(".new-comment").replaceWith('<div class="alert alert-success">Thanks for your comment!</div>');
    
    commenter_position
    
    $(commenter_position + " .panel-body").prepend("<div class='comment'><b>" + name + 
      " says:</b><p>" + comment + 
      "</p><span>" + myDate.toDateString() + "</span></div>");

    //IP|datetime|type|comment|name
    //10.1.1.1|nov 14th 5pm|comment|this is a new comment|john doe
    $.ajax({
			type: "POST",
			url: "_code/ProcessPoll.php",
			dataType: "json",
			data: { comment : comment,  name : name, commenter_position : "" }
		})
    
    //console.log("ipaddress" + "|" + name + "|" + comment);
  }
   
  function submitCommentError() {
    $('.error').html('');
    $(".new-comment").append("<span class='error'>* Please enter a name, a comment and select a position.</span>");
  }
});