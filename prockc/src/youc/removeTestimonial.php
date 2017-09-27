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

	if(!isset($_POST['testimonialId'])){
		die(0);
	}

    $testimonialId=$_POST['testimonialId'];
    
    $removeTestimonial="DELETE from userTestimonials where id=" . $testimonialId ;
    mysql_query ($removeTestimonial) or trigger_error("Query fails. Contact us to report the issue.");

?>