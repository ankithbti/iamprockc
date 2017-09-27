<?php
	require_once('../header.php');

	$fName=$_POST['fName'];
	$mName=$_POST['mName'];
	$lName=$_POST['lName'];
	$userName=$_POST['userName'];
	$password=$_POST['password'];
	$confirmPassword=$_POST['confirmPassword'];
	$email=$_POST['email'];
	$mobile=$_POST['mobileNumber'];

    if(strcmp($password, $confirmPassword) != 0){
        $_SESSION['gRegisterError'] = "Password and Confirm Password are different. Please try again!!";
        header('Location: login.php');
        die("Password and Confirm Password are different. Please try again!!");
    }

	// Random Num of 4 digits
	$digits = 4;
	$randomOtp = rand(pow(10, $digits-1), pow(10, $digits)-1);


	// Check if UserName / EmailId is uniq
	$query = "select * from users where username='" . $userName . "';";
	$result = mysql_query ($query) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
    	// UserName is already registered with us
        $_SESSION['gRegisterError'] = "UserName is already taken. Please try again!!";
        header('Location: login.php');
        die("UserName is already taken. Please try again!!");
    }

    $query = "select * from users where email='" . $email . "';";
	$result = mysql_query ($query) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
    	// EmailId is already registered with us
    	$_SESSION['gRegisterError'] = "Email is already taken. Please try again!!";
        header('Location: login.php');
        die("Email is already taken. Please try again!!");
    }

	// Fill these details in database
    $query = "INSERT INTO users(username, name, email, password, accountStatus, phoneNumber) 
    values('" . $userName . "','" . $fName . " " . $mName . " " . $lName . "','" . $email . "','" .
    $password . "'," . $randomOtp . ",'" . $mobile . "');";


    $result = mysql_query ($query) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
    	$_SESSION['otpEmail'] = $email;

        // Get UserId
        $userIdQuery = "select * from users where email='" . $email . "'";
        $userIdResult = mysql_query ($userIdQuery) or trigger_error("Query fails. Contact us to report the issue.");
        if (mysql_affected_rows() > 0){
            while($row = mysql_fetch_array($userIdResult, MYSQL_NUM)){

                // Also fill the default userDetails
                $detailsFillQuery="INSERT INTO userDetails values(" . $row[0] . ", 0,0,0,0);";
                $detailsFillQueryResult = mysql_query ($detailsFillQuery) or trigger_error("Query fails. Contact us to report the issue.");
            }
        }

    	header('Location: verifyOtp.php');
    }else{
    	$_SESSION['gRegisterError'] = "Some technical Issue. Please contact admin.";
        header('Location: login.php');
    }

?>
