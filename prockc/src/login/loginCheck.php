<?php
	require_once('../header.php');

	$user="";
	$pass="";
	if(isset($_POST["userName"])){
		//echo "<h1>TEST SUBMIT </h1>" . $_POST["userName"];
		$user = $_POST["userName"];
		$pass = $_POST["password"];
		
		$query = "select * from users where username='" . $user . "'";
		$result = mysql_query ($query) or trigger_error("Query fails. Contact us to report the issue.");
	    if (mysql_affected_rows() > 0){
	        while($row = mysql_fetch_array($result, MYSQL_NUM)){
	            if($row[5] == $pass){
	            	// Check if Account is Activated or not
	            	if($row[6] == 0){
	            		// Ok To Login
	            		$_SESSION['userName'] = $row[1];
	            		$_SESSION['userId'] = $row[0];
	            		$_SESSION['email'] = $row[3];
	            		$_SESSION['userRealName'] = $row[2];
	            		$_SESSION['function'] = "LOGIN";
	            		header('Location: updatePersonalInfo.php');
	            	}else{
	            		// Not Active
	            		$_SESSION['otpEmail'] = $row[3];
	            		$_SESSION['function'] = "LOGIN";
	            		header('Location: verifyOtp.php');
	            	}
	            }else{
	            	$_SESSION['gError'] = "Wrong Password";
	            	header('Location: login.php');
	            }
	        }
	    }
	    else{
	        $_SESSION['gError'] = "Unknown UserName";
	        header('Location: login.php');
	    }
	}else{
		header('Location: login.php');
	}
?>