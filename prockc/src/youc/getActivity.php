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

    $retString='';

    $activityId = $_POST['activityId'];
   
    $getActivityQ="select * from userPlannedActivities where id=" . $activityId . ";";
    $getActivityQRes = mysql_query ($getActivityQ) or trigger_error("Query fails: " . $getActivityQ . " , Contact us to report the issue.");

    if (mysql_affected_rows() > 0){
        while($getActivityQResRow = mysql_fetch_array($getActivityQRes, MYSQL_NUM) ){
            $retString = $getActivityQResRow[3] . "," . $getActivityQResRow[4] . "," . $getActivityQResRow[5];
        }
    }

    echo $retString;

?>