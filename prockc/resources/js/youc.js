
function formatDateJS(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}


var updateActivityId=0;

function resetActivity(){
	var todayDate = new Date().toISOString().slice(0,10);
	$("#selectDate").val(todayDate);
	$("#selectTime").val("");
	$("#activityTitle").val("");
	$("#activityHead").text("Schedule New Activity");
}

function submitActivity(userId){

	var activityTitle = $("#activityTitle").val();
	var selectDate = $("#selectDate").val();
	var selectTime = $("#selectTime").val();

	$.ajax({
	    type: 'POST',
	    data: { 
	        'userId': userId,
	        'activityDate': selectDate,
	        'activityTime': selectTime,
	        'activityTitle': activityTitle,
	        'updateActivity': updateActivityId
	    },
	    url: 'submitActivity.php',
	    success: function(msg){
	    	$("#checkPoint").text(msg);
	    	updateActivityId = 0;
	    	if(updateActivityId > 0){
				$("#activityHead").text("Schedule New Activity");
			}
	    	location.reload(true);

	    }
	});
}


function deleteActicvity(activityId){
	if(confirm('Are you sure you want to delete the activity ?' )){
		$.ajax({
		    type: 'POST',
		    data: { 
		        'activityId': activityId
		    },
		    url: 'deleteActicvity.php',
		    success: function(msg){
		    	//$("#checkPoint").text(msg);
		    	location.reload(true);
		    }
		});	
	}
}



function updateActivity(activityId){
	$.ajax({
	    type: 'POST',
	    data: { 
	        'activityId': activityId
	    },
	    url: 'getActivity.php',
	    success: function(msg){

	    	var str_array = msg.split(',');

			for(var i = 0; i < str_array.length; i++) {
			   // Trim the excess whitespace.
			   str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
			   // Add additional code here, such as:
			   if(i == 0){
			   		//alert(str_array[i]);
			   		$("#selectDate").val(str_array[i]);
			   }else if(i == 1){
			   		$("#selectTime").val(str_array[i]);
			   }else if(i == 2){
			   		$("#activityTitle").val(str_array[i]);
			   }
			}
			$('html, body').animate({ scrollTop: 0 }, 'slow');
			updateActivityId=activityId;
			if(updateActivityId > 0){
				$("#activityHead").text("Update Activity");
			}
	    	//location.reload(true);
	    }
	});
}


$(function(){
	

	var timelineBlocks = $('.cd-timeline-block'),
		offset = 0.8;

	if(timelineBlocks){

		$("#activityHead").text("Schedule New Activity");
		
		//hide timeline blocks which are outside the viewport
		hideBlocks(timelineBlocks, offset);

		//on scolling, show/animate timeline blocks when enter the viewport
		$(window).on('scroll', function(){
			(!window.requestAnimationFrame) 
				? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
				: window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });
		});
	}

	function hideBlocks(blocks, offset) {
		blocks.each(function(){
			( $(this).offset().top > $(window).scrollTop()+$(window).height()*offset ) && $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		});
	}

	function showBlocks(blocks, offset) {
		blocks.each(function(){
			( $(this).offset().top <= $(window).scrollTop()+$(window).height()*offset && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) && $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
		});
	}

	// $("#textInput").autofill({
	// 	data: ["javascript", "mysql", "jquery", "php", "ajax"]
	// });

	var todayDate = new Date().toISOString().slice(0,10);
	$("#selectDate").val(todayDate);

	var tagsArray = [];
	$.ajax({
	    type: 'POST',
	    url: 'getVideoTags.php',
	    success: function(msg){
	        var myarray = msg.split(',');
			for(var i = 0; i < myarray.length; i++)
			{
				if(myarray[i].length > 0){
					tagsArray.push(myarray[i]);
				}
			   
			}
	    }
	});

	$("#textInput").tags({
		//requireData: true,
		unique: true
	}).autofill({
		data: tagsArray
	});

	// $("#textInput").on("tagRemove", function(e, tag){
	// 	console.log("Removed Tag: " + tag);
	// });

	var monthNames = ["January", "February", "March", "April", "May", "June",
  		"July", "August", "September", "October", "November", "December"
		];
	var currDate = new Date();
	$(".monthPlaceholder").text(monthNames[currDate.getMonth()] + " " + (currDate.getFullYear()));

	if($("#myChart").length){

	
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
		        datasets: [{
		            label: '# of Votes',
		            data: [12, 19, 3, 5, 2, 3],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255,99,132,1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
		    }
		});

	}else{

	}

	

	// Default Calendar
	$('.calendar').pignoseCalendar({

		//initialize: false // Active date (today or `date` option you gave) isn't displayed at first time.
		//date: moment('2017-06-12'),
		
		//minDate: moment('2017-06-01'),
		//maxDate: moment('2017-10-04'),

		//modal: true,
		//toggle: true,

		language: 'en',

		// additional custom languages.
	    languages: {
	        // Check schema of this value at below link.
	        // link: https://github.com/KennethanCeyer/pg-calendar/wiki/Language#basic-best-practice
	    },

		// default first week (0-6), 0 means sunday.
    	week: 1,

    	// default date format, it follow moment format rule.
    	format: 'YYYY-MM-DD',

    	theme: 'light', // dark


		select: onClickHandler,
		// next: function(info, context) {
	 //        /**
	 //         * @params context PignoseCalendarPageInfo
	 //         * @params context PignoseCalendarContext
	 //         * @returns void
	 //         */

	 //         // This is clicked arrow button element.
	 //         var $this = $(this);

	 //         // `info` parameter gives useful information of current date.
	 //         var type = info.type; // it will be `next`.
	 //         var year = info.year; // current year (number type), ex: 2017
	 //         var month = info.month; // current month (number type), ex: 6
	 //         var day = info.day; // current day (number type), ex: 22

	 //         // You can get target element in `context` variable.
	 //         var $element = context.element;

	 //         // You can also get calendar element, It is calendar view DOM.
	 //         var $calendar = context.calendar;

	 //         console.log(year + " " + month + " " + day + " "  + type);
	 //    },

	 //    prev: function(info, context) {
	 //        /**
	 //         * @params context PignoseCalendarPageInfo
	 //         * @params context PignoseCalendarContext
	 //         * @returns void
	 //         */

	 //         // This is clicked arrow button element.
	 //         var $this = $(this);

	 //         // `info` parameter gives useful information of current date.
	 //         var type = info.type; // it will be `next`.
	 //         var year = info.year; // current year (number type), ex: 2017
	 //         var month = info.month; // current month (number type), ex: 6
	 //         var day = info.day; // current day (number type), ex: 22

	 //         // You can get target element in `context` variable.
	 //         var $element = context.element;

	 //         // You can also get calendar element, It is calendar view DOM.
	 //         var $calendar = context.calendar;

	 //         console.log(year + " " + month + " " + day + " "  + type);
	 //    },

	    page: function(info, context) {
	        /**
	         * @params context PignoseCalendarPageInfo
	         * @params context PignoseCalendarContext
	         * @returns void
	         */

	         // This is clicked arrow button element.
	         var $this = $(this);

	         // `info` parameter gives useful information of current date.
	         var type = info.type; // it will be one of `next`, `prev`, `unkown`.
	         var year = info.year; // current year (number type), ex: 2017
	         var month = info.month; // current month (number type), ex: 6
	         var day = info.day; // current day (number type), ex: 22

	         // You can get target element in `context` variable.
	         var $element = context.element;

	         // You can also get calendar element, It is calendar view DOM.
	         var $calendar = context.calendar;
	    	 $(".monthPlaceholder").text(monthNames[month-1] + " " + year);
	    	 loadUserProfile(currInstructorId, year, month);
	         //console.log(currInstructorId + " " + year + " " + month);
	    }
	});



	function onClickHandler(date, obj) {
		/**
		 * @date is an array which be included dates(clicked date at first index)
		 * @obj is an object which stored calendar interal data.
		 * @obj.calendar is an element reference.
		 * @obj.storage.activeDates is all toggled data, If you use toggle type calendar.
         * @obj.storage.events is all events associated to this date
		 */

		var $calendar = obj.calendar;
		var $box = $calendar.parent().siblings('.box').show();
		var text = '';

		if(date[0] !== null) {
			text += date[0].format('YYYY-MM-DD');
		}

		if(date[0] !== null && date[1] !== null) {
			text += ' ~ ';
		} else if(date[0] === null && date[1] == null) {
			text += 'nothing';
		}

		if(date[1] !== null) {
			text += date[1].format('YYYY-MM-DD');
		}

		// text += ' [YYYY-MM-DD]';

		//$box.text(text);
		var dateVal = $("#selectDate").val();
		//if(dateVal.length == 0){
			$("#selectDate").val(text);
		//}
	}

});

function onVideoPageLoad(videoId, userId){
	//alert(videoId + " " + userId);
}


function onWatchLaterClicked(videoId, userId){

	$.ajax({
	    type: 'POST',
	    // make sure you respect the same origin policy with this url:
	    url: 'likeDislikeVideo.php',
	    data: { 
	        'reqType': 'watchLater', 
	        'videoId': videoId,
	        'userId': userId
	    },
	    success: function(msg){
	        // Nothing to do
	    }
	});

	$("#watchLaterSpan").attr("onclick","onRemoveFromWatchLaterClicked(" + videoId + "," + userId + ")");
	$("#watchLaterSpan").html("<img width=\"50px\" src=\"../../resources/images/watch.png\"><p><span>Saved</span></p>");

}

function onRemoveFromWatchLaterClicked(videoId, userId){

	$.ajax({
	    type: 'POST',
	    // make sure you respect the same origin policy with this url:
	    url: 'likeDislikeVideo.php',
	    data: { 
	        'reqType': 'removeFromWatchLater', 
	        'videoId': videoId,
	        'userId': userId
	    },
	    success: function(msg){
	        // Nothing to do
	    }
	});

	$("#watchLaterSpan").attr("onclick","onWatchLaterClicked(" + videoId + "," + userId + ")");
	$("#watchLaterSpan").html("<img width=\"50px\" src=\"../../resources/images/watch.png\"><p><span>Watch Later</span></p>");

}

function onVideoLikeClick(videoId, userId){

	$.ajax({
	    type: 'POST',
	    // make sure you respect the same origin policy with this url:
	    url: 'likeDislikeVideo.php',
	    data: { 
	        'reqType': 'like', 
	        'videoId': videoId,
	        'userId': userId
	    },
	    success: function(msg){
	        $("#totalLikes").text(msg);
	    }
	});


	$("#videoLikeButton").attr("onclick","onVideoUndoLikeClick(" + videoId + "," + userId + ")");
	$("#videoLikeButton").html("<i class=\"fa fa-thumbs-up\" aria-hidden=\"true\"></i> Liked");
}

function onVideoUndoLikeClick(videoId, userId){

	$.ajax({
	    type: 'POST',
	    // make sure you respect the same origin policy with this url:
	    url: 'likeDislikeVideo.php',
	    data: { 
	        'reqType': 'undolike', 
	        'videoId': videoId,
	        'userId': userId
	    },
	    success: function(msg){
	        $("#totalLikes").text(msg);
	    }
	});

	$("#videoLikeButton").attr("onclick","onVideoLikeClick(" + videoId + "," + userId + ")");
	$("#videoLikeButton").html("<i class=\"fa fa-thumbs-o-up\" aria-hidden=\"true\"></i> Like");
}

function onVideoDisklikeClick(videoId, userId){

	$.ajax({
	    type: 'POST',
	    // make sure you respect the same origin policy with this url:
	    url: 'likeDislikeVideo.php',
	    data: { 
	        'reqType': 'dislike', 
	        'videoId': videoId,
	        'userId': userId
	    },
	    success: function(msg){
	        $("#totalDislikes").text(msg);
	    }
	});

	$("#videoDislikeButton").attr("onclick","onVideoUndoDislikeClick(" + videoId + "," + userId + ")");
	$("#videoDislikeButton").html("<i class=\"fa fa-thumbs-down\" aria-hidden=\"true\"></i> Disliked");
}

function onVideoUndoDislikeClick(videoId, userId){

	$.ajax({
	    type: 'POST',
	    // make sure you respect the same origin policy with this url:
	    url: 'likeDislikeVideo.php',
	    data: { 
	        'reqType': 'undodislike', 
	        'videoId': videoId,
	        'userId': userId
	    },
	    success: function(msg){
	        $("#totalDislikes").text(msg);
	    }
	});

	$("#videoDislikeButton").attr("onclick","onVideoDisklikeClick(" + videoId + "," + userId + ")");
	$("#videoDislikeButton").html("<i class=\"fa fa-thumbs-o-down\" aria-hidden=\"true\"></i> Dislike");
}

function onVideoShareClick(videoId, userId){
	alert("Functionality not working right now.");
}


function subscribeInstructor(userId, uploaderId){

	
	$.ajax({
	    type: 'POST',
	    // make sure you respect the same origin policy with this url:
	    url: 'subscribe.php',
	    data: { 
	        'reqType': 'subscribe', 
	        'subscriberId': userId,
	        'uploaderId': uploaderId
	    },
	    success: function(msg){
	        // Nothing to do
	        //$("#roughWork").text(msg);
	    }
	});

	$("#subscribeButton").attr("onclick","unSubscribeInstructor(" + userId + "," + uploaderId + ")");
	$("#subscribeButton").html("<i class=\"fa fa-heart\" aria-hidden=\"true\"></i> Subscribed");

}

function unSubscribeInstructor(userId, uploaderId){

	$.ajax({
	    type: 'POST',
	    // make sure you respect the same origin policy with this url:
	    url: 'subscribe.php',
	    data: { 
	        'reqType': 'unsubscribe', 
	        'subscriberId': userId,
	        'uploaderId': uploaderId
	    },
	    success: function(msg){
	        // Nothing to do
	    }
	});
	
	$("#subscribeButton").attr("onclick","subscribeInstructor(" + userId + "," + uploaderId + ")");
	$("#subscribeButton").html("<i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i> Subscribe");

}




