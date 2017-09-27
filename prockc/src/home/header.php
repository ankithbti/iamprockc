<?php
    //ob_start();
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
<link rel="stylesheet" type="text/css" href="../../resources/css/youc.css" />

<style>

.navbar-youc{
  background-color: #01429b;
  border-color: #01429b;
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

  background-color: #01429b;
  border-color: #01429b;
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
</style>


</head>