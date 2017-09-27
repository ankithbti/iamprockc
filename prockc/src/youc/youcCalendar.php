<html>
	<head>
		<title>Calendar</title>
		
		<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/demo/css/semantic.ui.min.css">
		<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/demo/css/prism.css" />
		<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/demo/css/calendar-style.css" />
		<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/demo/css/style.css" />
		<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/dist/css/pignose.calendar.css" />
		
		<script src="../../resources/js/jquery-3.2.1.min.js"></script>
		<!-- <script type="text/javascript" src="../../resources/calendarResource/demo/js/jquery.latest.min.js"></script> -->
		<script type="text/javascript" src="../../resources/calendarResource/demo/js/moment.latest.min.js"></script>
		<script type="text/javascript" src="../../resources/calendarResource/emo/js/semantic.ui.min.js"></script>
		<script type="text/javascript" src="../../resources/calendarResource/demo/js/prism.min.js"></script>
		<script type="text/javascript" src="../../resources/calendarResource/dist/js/pignose.calendar.js"></script>

		<script type="text/javascript">
	//<![CDATA[
	$(function() {
		$('#wrapper .version strong').text('v' + $.fn.pignoseCalendar.ComponentVersion);

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
			var text = 'You choose date ';

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

			$box.text(text);
		}

		// Default Calendar
		$('.calendar').pignoseCalendar({
			select: onClickHandler
		});

		// This use for DEMO page tab component.
		$('.menu .item').tab();
	});
	//]]>
	</script>

	</head>

	<body>

		<div id="basic" class="article">
			<h3><span>Basic</span></h3>
            <div class="calendar"></div>
			<div class="box"></div>
		</div>


	</body>


</html>