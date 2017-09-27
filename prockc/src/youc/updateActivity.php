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

	if(!isset($_POST['activityId'])){
		die(0);
	}

    $activityId = $_POST['activityId'];
   
    $deleteActivityQ="delete from userPlannedActivities where id=" . $activityId . ";";
    mysql_query ($deleteActivityQ) or trigger_error("Query fails: " . $deleteActivityQ . " , Contact us to report the issue.");

?>