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

	if(!isset($_POST['instructorId'])){
		die(0);
	}

    $retString='';

    $instructorId = $_POST['instructorId'];
    $month = $_POST['month'];
    $year = $_POST['year'];
   
    // $instructorId = 7;
    // $month = 9;
    // $year = 2017;

    if($month < 10){
        $month = "0" . $month;
    }

    $beginDate= $year . "-" . $month . "-01";
    $endDate= $year . "-" . $month . "-31";

    $getActivityQ="select * from userPlannedActivities where userId=" . $instructorId . " and activityDate >= '" . $beginDate . "' and activityDate <= '" . $endDate . "'";
    $getActivityQRes = mysql_query ($getActivityQ) or trigger_error("Query fails: " . $getActivityQ . " , Contact us to report the issue.");

    if (mysql_affected_rows() > 0){
        while($getActivityQResRow = mysql_fetch_array($getActivityQRes, MYSQL_NUM) ){
            
            $eventDate=$getActivityQResRow[3];

            $dateTokens = explode("-", $eventDate);
            $count = 0;
            foreach ($dateTokens as $token) {
                $count+=1;
                if($count == 3){
                    $retString .= '<p class="eventShow"><span class="label label-warning dateSpan">' . $token . '</span>&nbsp;<span class="eventSpan"><strong>' . $getActivityQResRow[5] .'</strong></span></p>';
                }
            }

        }
    }else{
        $retString .= '<p class="eventShow"><span class="eventSpan"><strong>No Plans in this month as of now.</strong></span></p>';
    }

    echo $retString;

?>