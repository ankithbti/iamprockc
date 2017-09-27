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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>YouC</title>
<!-- <link rel="shortcut icon" type="images/png" href="/favicon.png"/> -->
<link rel="icon" href="../../resources/images/favicon.ico" type="image/png" sizes="16x16">

<link rel="stylesheet" type="text/css" href="../../resources/bootstrap-3.3.5/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../../resources/bootstrap-3.3.5/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/demo/css/semantic.ui.min.css">
<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/demo/css/prism.css" />
<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/demo/css/calendar-style.css" />
<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/demo/css/style.css" />
<link rel="stylesheet" type="text/css" href="../../resources/calendarResource/dist/css/pignose.calendar.css" />
<link rel="stylesheet" type="text/css" href="../../resources/css/style_youc.css" />
<link rel="stylesheet" type="text/css" href="../../resources/css/youc.css" />
<link rel="stylesheet" type="text/css" href="../../resources/css/youcVideo.css" />
<link rel="stylesheet" type="text/css" href="../../resources/css/tag.css" />
<link rel="stylesheet" type="text/css" href="../../resources/jquery-timepicker-master/jquery.timepicker.css" />
<link rel="stylesheet" type="text/css" href="../../resources/jquery-timepicker-master/lib/bootstrap-datepicker.css" />
<link rel="stylesheet" href="../../resources/vertical-timeline/css/style.css">
<style>


.eventShow{
  padding: 5px;
  margin-bottom: 10px;
}

.dateSpan{
  font-size: 1em;
}

.eventSpan{
  font-size: 1em;
  color:#f1f1f1;
  font-weight: 200;
  margin-left: 5px;
}

.next-upload input {

  margin-bottom: 0px;
  padding: 0px;
}


.marginToRight{
  margin-right: 10px;
}

#activityTimeline{
  font-size: 100%;
  font-family: "Droid Serif", serif;
  color: #7f8c97;
  background-color: #e9f0f5;
}

.thumbnailVideo{
  border-left: 5px #333 solid;
  padding-left: 10px;
  width:220px;
  height: 150px;
}

.wrapper{
    display:table;
    width:auto;
    position:relative;
    width:50%;
}
.playpause {
    background-image:url(../../resources/images/playIconOverlay.png);
    background-repeat:no-repeat;
    width:50%;
    height:50%;
    position:absolute;
    left:0%;
    right:0%;
    top:0%;
    bottom:0%;
    margin:auto;
    background-size:contain;
    background-position: center;
}


#textInput{
  display: none;
  margin-top: 10px;
}

.navbar-youc{
  background-color: #9a2c00;
  border-color: #9a2c00;
  border-radius: 0px;
}

.navHeadings li{
  margin-right: 10px;
}

.navHeadings .caret{
  color: #f1f1f1;
}

.navHeadings li a{
  color: #f1f1f1;
}

.userImageNav li a:link{
  color: #333;
}

.userImageNav li a:hover{
  color: #333;
}

.userImageNav li a:visited{
  color: #333;
}

.userImageNav li a:active{
  color: #333;
}

.navbar-youc li a:hover{
  /*color: #000;
  background-color: #f1f1f1;
  margin-top: 5px;*/

  background-color: #9a2c00;
  border-color: #9a2c00;
  border-radius: 0px;

  /*height:100%;*/
}

.myBrandLogo{
  margin-right: 20px;
  display: block;
}

.myBrandLogo img{
  width: 80px;
}

.userImageNav img{
  width:50px;
}

#bar_blank {
  border: solid 1px #000;
  height: 20px;
  width: 300px;
}

#bar_color {
  background-color: #006666;
  height: 20px;
  width: 0px;
}

#bar_blank, #hidden_iframe {
  display: none;
}

.closeButton{
  background: rgba(255,255,255,1);
  color: #333;
}

button:focus {outline:0;}

</style>

</head>