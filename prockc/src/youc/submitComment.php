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

	if(!isset($_POST['reqType'])){
		die(0);
	}

    $reqType=$_POST['reqType'];
	
    $commentId=0;


    if(strcmp($reqType, "submit") == 0){

        $videoId=$_POST['videoId'];
        $userId=$_POST['userId'];
        $commentText=$_POST['commentText'];

        $commentInsertQ="INSERT INTO videoCommentDetails(userId, videoId, commentText, commentdatetime) values(" . $userId . "," . $videoId . ",'" . $commentText . "','" . $datetime . "');";
        mysql_query ($commentInsertQ) or trigger_error("Query fails. Contact us to report the issue.");

        $getLatestCommentId="SELECT * from videoCommentDetails where userId=" . $userId . " and videoId=" . $videoId . " ORDER BY commentDateTime DESC LIMIT 1;";
        $getLatestCommentIdResult = mysql_query ($getLatestCommentId) or trigger_error("Query fails. Contact us to report the issue.");
        if (mysql_affected_rows() > 0){
            while($getLatestCommentIdResultRow = mysql_fetch_array($getLatestCommentIdResult, MYSQL_NUM) ){
                $commentId=$getLatestCommentIdResultRow[0];
            }
        }

    }else if(strcmp($reqType, "delete") == 0){

        $commentId=$_POST['commentId'];

        $commentDeleteQuery="DELETE from videoCommentDetails where id=" . $commentId . ";";
        mysql_query ($commentDeleteQuery) or trigger_error("Query fails. Contact us to report the issue.");

       // $commentId=9999;

    }

    echo $commentId;

?>