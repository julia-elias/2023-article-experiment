$(document).ready(function() {
  var begin = new Date();
  var frequent = "ping";
  begin = begin.toString();
	
	setInterval(function(){
		$.ajax({
			type: "POST",
			url: "_code/ProcessPoll.php",
			data: { type : frequent, start : begin, render : "comment-form" }
		})
	},1000);
	
});