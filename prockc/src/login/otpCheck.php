<?php
	require_once('../header.php');

	$email="";
	$otp="";
	if(isset($_POST["email"])){
		//echo "<h1>TEST SUBMIT </h1>" . $_POST["userName"];
		$email = $_POST["email"];
		$otp = $_POST["otp"];
		
		$query = "select * from users where email='" . $email . "'";
		$result = mysql_query ($query) or trigger_error("Query fails. Contact us to report the issue.");
	    if (mysql_affected_rows() > 0){
	        while($row = mysql_fetch_array($result, MYSQL_NUM)){
	            if($row[6] == $otp){
	            	$updateQuery = "UPDATE users SET accountStatus=0 where email='" . $email . "';";
	            	$upadteResult = mysql_query ($updateQuery) or trigger_error("Query fails. Contact us to report the issue.");
	            	if (mysql_affected_rows() > 0){
	            		if(isset($_SESSION['function'])){
	            			if($_SESSION['function'] == "LOGIN"){
	            				$_SESSION['gRegisterSuccess'] = "Congrats! Your account is active.";

	            				$query = "select * from users where email='" . $email . "'";
								$result = mysql_query ($query) or trigger_error("Query fails. Contact us to report the issue.");
	    						if (mysql_affected_rows() > 0){
	        						while($row = mysql_fetch_array($result, MYSQL_NUM)){
	        							$_SESSION['userName'] = $row[1];
	            						$_SESSION['email'] = $row[3];
	            						$_SESSION['userId'] = $row[0];
	            						$_SESSION['userRealName'] = $row[2];
	            					}
	            				}
	            				header('Location: updatePersonalInfo.php');
	            			}
	            		}else{
	            			$_SESSION['gRegisterSuccess'] = "Congrats! Your account is active. You can try login now.";	
	            			header('Location: login.php');
	            		}
	            	}else{
	            		$_SESSION['gRegisterError'] = "Failed to update Activation Status in DB. Contact Admin";
	        			header('Location: verifyOtp.php');
	            	}
	            }else{
	            	$_SESSION['gRegisterError'] = "Wrong Otp. Please use the same as sent in Mail";
	        		header('Location: verifyOtp.php');
	            }
	        }
	    }
	    else{
	        $_SESSION['gRegisterError'] = "Email not registered with us";
	        header('Location: verifyOtp.php');
	    }
	}else{
		header('Location: login.php');
	}

?>

<body>
<div class="container">
	<div class="alert alert-success" role="alert">Account Activation Successful.</div>
</div>
</body>