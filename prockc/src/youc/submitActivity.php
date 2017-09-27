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

	if(!isset($_POST['activityTitle'])){
		die(0);
	}

    $userId = $_POST['userId'];
    $activityDate = $_POST['activityDate'];
    $activityTime = $_POST['activityTime'];
    $activityTitle = $_POST['activityTitle'];
    $updateActivity = $_POST['updateActivity'];
    $activityType = 0;

    if($updateActivity <= 0){
        $insertActivityQ="INSERT INTO userPlannedActivities(userId, activityType, activityDate, activityTime, activityTitle, creationDateTime) values(" . $userId . "," . $activityType . ",'" . $activityDate . "','" . $activityTime . "','" . $activityTitle . "','" . $datetime . "');";
        //echo $insertActivityQ;

        mysql_query ($insertActivityQ) or trigger_error("Query fails: " . $insertActivityQ . " , Contact us to report the issue.");
    
    }else{
        // UPDATE the given activity
        $updateActivityQ = "UPDATE userPlannedActivities SET activityDate='" . $activityDate . "', activityTime='" .
            $activityTime . "',activityTitle='" . $activityTitle . "' where id=" . $updateActivity;
        mysql_query ($updateActivityQ) or trigger_error("Query fails: " . $updateActivityQ . " , Contact us to report the issue.");        
    }


    
?>