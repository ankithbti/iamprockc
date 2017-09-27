
<footer>
<div class="container" align="center">
	<hr>
	<p>Single PROCKC account for<br>youC, weC &amp; soC<br>&copy;prockc.com</p>
</div>
</footer>


<script src="../../resources/js/jquery-3.2.1.min.js"></script>
<script src="../../resources/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../resources/calendarResource/demo/js/moment.latest.min.js"></script>
<!-- <script type="text/javascript" src="../../resources/calendarResource/emo/js/semantic.ui.min.js"></script> -->
<script type="text/javascript" src="../../resources/calendarResource/demo/js/prism.min.js"></script>
<script type="text/javascript" src="../../resources/calendarResource/dist/js/pignose.calendar.js"></script>
<script type="text/javascript" src="../../resources/js/autofill.js"></script>
<script type="text/javascript" src="../../resources/js/tag.js"></script>
<script type="text/javascript" src="../../resources/js/chart.js"></script>
<script type="text/javascript" src="../../resources/jquery-timepicker-master/jquery.timepicker.js"></script>
<script type="text/javascript" src="../../resources/jquery-timepicker-master/lib/bootstrap-datepicker.js"></script>
<!-- <link rel="stylesheet" href="../../resources/vertical-timeline/js/modernizr.js"> -->
<script type="text/javascript" src="../../resources/js/youcVideo.js"></script>
<script type="text/javascript" src="../../resources/js/youc.js"></script>
<script>


var currInstructorId=0;

function loadUserProfile(instructorId, year, month){
	currInstructorId = instructorId;
	//var d = new Date();
	$.post("getActivityForIdAndMonth.php", 
	{
		'instructorId': instructorId,
		'year': year,
		'month': month
	}).done(function(msg){
		$("#eventDetails").html(msg);
	});
}

function loadDatePicker(){
	$('#selectTime').timepicker();
}

function removeTestimonial(testimonialId){
	if(confirm('Are you sure you want to delete the testimonial ?' )){
		$.post("removeTestimonial.php", 
		{
			'testimonialId': testimonialId,
		}).done(function(msg){
			location.reload(true);
		});
	}
}

function submitTestimonial(testimonialFor, testimonialBy){
	var testimonialText=$("#testimonialText").val();
	$.post("addTestimonial.php", 
	{
		'testimonialFor': testimonialFor,
		'testimonialBy': testimonialBy,
		'testimonialText': testimonialText,
	}).done(function(msg){
		$('#addTestimonial').modal('toggle');
		location.reload(true);
	});

}

function removeComment(commentId, videoId){

	if(confirm('Are you sure you want to delete the comment ?' )){
	

		$.post("submitComment.php", 
		{
			'reqType': "delete",
	        'commentId': commentId
		}).done(function(msg){

			$("#userComment_" + commentId).remove();
			$.post("countComments.php", 
			{
				'videoId': videoId
			}).done(function(comentsCount){
				$("#totalComments").text(comentsCount);
				$("#totalCommentsSecond").text(comentsCount);
			});
		});

	}

}

function submitComment(userName, userId, userPic, videoId){

	var latestCommentId=0;
	var commentText = $("#videoCommentText").val();

	if(commentText.localeCompare("Enter your Comment....") == 0 || commentText.length == 0){
		ale
	}else{

		// $.ajax({
		//     type: 'POST',
		//     // make sure you respect the same origin policy with this url:
		//     url: 'submitComment.php',
		//     data: { 
		//         'userId': userId, 
		//         'videoId': videoId,
		//         'commentText': commentText
		//     },
		//     success: function(msg){
		//         latestCommentId=msg;
		//     }
		// });

		$.post("submitComment.php", 
		{
			'reqType': "submit",
			'userId': userId, 
	        'videoId': videoId,
	        'commentText': commentText
		}).done(function(msg){
			latestCommentId=msg;
			$("#addCommentBlock").after('<div class="comment_box" id="userComment_' + msg + '"><div class="user"><img src="' + userPic + '" alt=""></div><div class="comment"><h4>' + userName + '</h4><div class="date">15/09/2017</div><p>' + commentText + '</p><ul><li><a href="javascript:;" onClick="removeComment(' + latestCommentId + ',' + videoId + ')"><i class="fa fa-trash"></i> Delete</a></li></ul></div></div>');
			$("#videoCommentText").val("");

			$.post("countComments.php", 
			{
				'videoId': videoId
			}).done(function(comentsCount){
				$("#totalComments").text(comentsCount);
				$("#totalCommentsSecond").text(comentsCount);
			});

		});




	}

}


function _(e1){
	return document.getElementById(e1);
}

function uploadFile(){

	var file = _("videoFile").files[0];
	var videoTitle=$("#videoTitle").val();
	var videoDesc=$("#videoDesc").val();
	var videoCost=$("#costPerView").val();
	var videoTags=$("#textInput").val();
	//alert(file.name + " | " + file.size + " | " + file.type);

	var formdata = new FormData();
	formdata.append("videoFile", file);
	formdata.append("title", videoTitle);
	formdata.append("description", videoDesc);
	formdata.append("costPerView", videoCost);
	formdata.append("uploadSubmitted", videoCost);
	formdata.append("videoTags", videoTags);


	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);

	ajax.open("POST", "uploadCheck.php");
	ajax.send(formdata);
}

function progressHandler(event){
	//_("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
	var percent = (event.loaded / event.total ) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent) + "% uploaded.... please wait";
}

function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
	$("#uploadVideoModal").modal('toggle');
	location.reload(true);
}

function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}

function abortHandler(event){
	_("status").innerHTML = "Upload aborted";
}

</script>


</body>
</html>