<?php
	ob_start();
    session_start();
    require_once('common/dbconfig.php');
    //require_once('common/dbconfig.fitied.php');

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
<link rel="stylesheet" type="text/css" href="../../resources/css/style.css" />
</head>