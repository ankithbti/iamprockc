<?php
	require_once('../header.php');

	if(!isset($_POST['submitted'])){
		header('Location: login.php');
	}

	$email = $_POST['email'];
	// Check if email is registered
	$query = "select * from users where email='" . $email . "'";
	$result = mysql_query ($query) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){

		if(strcmp("userName", $_POST['forgotType']) == 0){
			$_SESSION['gHelpSuccess'] = "Your UserName has been sent to your email!!";
			header('Location: needHelp.php');
		}else if(strcmp("password", $_POST['forgotType']) == 0){
			$_SESSION['gHelpSuccess'] = "Your new Password has been sent to your email!!";
			header('Location: needHelp.php');
		}else{
			header('Location: login.php');
		}
	}else{
		// Not a registered EmailId
		$_SESSION['gHelpError'] = "EmailId is not registered with Us. Please register first!!";
		header('Location: needHelp.php');
	}
?>