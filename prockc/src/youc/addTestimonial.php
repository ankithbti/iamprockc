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

	if(!isset($_POST['testimonialFor'])){
		die(0);
	}
	
    $newTestimonialId=0;

    $testimonialFor=$_POST['testimonialFor'];
    $testimonialBy=$_POST['testimonialBy'];
    $testimonialText=$_POST['testimonialText'];

    $testimonialInsertQ="INSERT INTO userTestimonials(userId, givenBy, testimonialDateTime, testimonialText) values(" . $testimonialFor . "," . $testimonialBy . ",'" . $datetime . "','" . $testimonialText . "');";
    mysql_query ($testimonialInsertQ) or trigger_error("Query fails. Contact us to report the issue.");

    $getLatestTestimonialId="SELECT * from userTestimonials where userId=" . $testimonialFor . " and givenBy=" . $testimonialBy . " ORDER BY testimonialDateTime DESC LIMIT 1;";
    $getLatestTestimonialIdRes = mysql_query ($getLatestTestimonialId) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
        while($getLatestTestimonialIdResRow = mysql_fetch_array($getLatestTestimonialIdRes, MYSQL_NUM) ){
            $newTestimonialId=$getLatestTestimonialIdResRow[0];
        }
    }

    echo $newTestimonialId;

?>