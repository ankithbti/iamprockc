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
	
    $tagsStr="";

    
    $tagsQ="SELECT * from videoTags ORDER BY tagId DESC";
    $tagsQRes=mysql_query ($tagsQ) or trigger_error("Query fails. Contact us to report the issue.");
    while($tagsQResRow = mysql_fetch_array($tagsQRes, MYSQL_NUM) ){
        $tagsStr = $tagsQResRow[1] . "," . $tagsStr;
    }
    echo $tagsStr;
?>