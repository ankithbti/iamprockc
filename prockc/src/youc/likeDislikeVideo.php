<?php
	
	ob_start();
    session_start();
    require_once('../common/dbconfig.php');
    //require_once('../common/dbconfig.fitied.php');

    error_reporting(E_ALL | E_WARNING | E_NOTICE);
    ini_set('display_errors', TRUE);
    //flush();
    ini_set('allow_url_fopen', "1");
    date_default_timezone_set('UTC');
    $curr_date = date(DATE_RFC822);
    $datetime = date('Y-m-d H:i:s') ;

	if(!isset($_POST['videoId'])){
		die(0);
	}

	$reqType=$_POST['reqType'];
	$videoId=$_POST['videoId'];
	$userId=$_POST['userId'];

	$retVal = 0;

	if(strcmp($reqType, "like") == 0){

		$likeQ = "update userViewVideos SET likeVideo=1 where userId=" . $userId . " and videoId=" . $videoId;
		$likeQResult = mysql_query ($likeQ) or trigger_error("Query fails. Contact us to report the issue.");

		$totalLikeQ = "select * from userViewVideos where videoId=" . $videoId . " and likeVideo=1";
		$totalLikeQResult = mysql_query ($totalLikeQ) or trigger_error("Query fails. Contact us to report the issue.");
	    $retVal = mysql_affected_rows();


	}else if(strcmp($reqType, "dislike") == 0){

		$likeQ = "update userViewVideos SET dislikeVideo=1 where userId=" . $userId . " and videoId=" . $videoId;
		$likeQResult = mysql_query ($likeQ) or trigger_error("Query fails. Contact us to report the issue.");

		$totalLikeQ = "select * from userViewVideos where videoId=" . $videoId . " and dislikeVideo=1";
		$totalLikeQResult = mysql_query ($totalLikeQ) or trigger_error("Query fails. Contact us to report the issue.");
	    $retVal = mysql_affected_rows();

	}else if(strcmp($reqType, "undolike") == 0){

		$likeQ = "update userViewVideos SET likeVideo=0 where userId=" . $userId . " and videoId=" . $videoId;
		$likeQResult = mysql_query ($likeQ) or trigger_error("Query fails. Contact us to report the issue.");

		$totalLikeQ = "select * from userViewVideos where videoId=" . $videoId . " and likeVideo=1";
		$totalLikeQResult = mysql_query ($totalLikeQ) or trigger_error("Query fails. Contact us to report the issue.");
	    $retVal = mysql_affected_rows();

	}else if(strcmp($reqType, "undodislike") == 0){

		$likeQ = "update userViewVideos SET dislikeVideo=0 where userId=" . $userId . " and videoId=" . $videoId;
		$likeQResult = mysql_query ($likeQ) or trigger_error("Query fails. Contact us to report the issue.");

		$totalLikeQ = "select * from userViewVideos where videoId=" . $videoId . " and dislikeVideo=1";
		$totalLikeQResult = mysql_query ($totalLikeQ) or trigger_error("Query fails. Contact us to report the issue.");
	    $retVal = mysql_affected_rows();

	}else if(strcmp($reqType, "watchLater") == 0){

		$likeQ = "update userViewVideos SET watchLater=1 where userId=" . $userId . " and videoId=" . $videoId;
		$likeQResult = mysql_query ($likeQ) or trigger_error("Query fails. Contact us to report the issue.");

	}else if(strcmp($reqType, "removeFromWatchLater") == 0){

		$likeQ = "update userViewVideos SET watchLater=0 where userId=" . $userId . " and videoId=" . $videoId;
		$likeQResult = mysql_query ($likeQ) or trigger_error("Query fails. Contact us to report the issue.");

	}

	echo $retVal;

?>