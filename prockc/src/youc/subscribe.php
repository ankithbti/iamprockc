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

	if(!isset($_POST['uploaderId'])){
		die(0);
	}

	$reqType=$_POST['reqType'];
	$userId=$_POST['uploaderId'];
	$subscriberId=$_POST['subscriberId'];

	$retVal = "";

	if(strcmp($reqType, "subscribe") == 0){

		$subscribeQ = "insert into subscribers values(" . $userId . "," .  $subscriberId . ")";
		$retVal = $subscribeQ;
		$subscribeQResult = mysql_query ($subscribeQ) or trigger_error("Query fails. Contact us to report the issue.");


	}else if(strcmp($reqType, "unsubscribe") == 0){
		$unSubscribeQ = "delete from subscribers where  userId=" . $userId . " and subscriberId=" .  $subscriberId;
		$retVal = $unSubscribeQ;
		$unSubscribeQResult = mysql_query ($unSubscribeQ) or trigger_error("Query fails. Contact us to report the issue.");	
	}

	echo $retVal;

?>