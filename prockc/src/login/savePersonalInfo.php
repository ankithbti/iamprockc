<?php
	require_once('../header.php');

	$email = $_SESSION['email'];
	$dob = $_POST['dob'];
	$educationQualification = $_POST['educationQualification'];
	$userType = $_POST['userType'];
	$gender = $_POST['gender'];

	$saveProfilePicPath = "../../resources/uploads/" . $email . "/";
	if (!file_exists($saveProfilePicPath)) {
    	mkdir($saveProfilePicPath, 0777, true);
	}
	
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = pathinfo($_FILES['profilePicFile']['name'], PATHINFO_EXTENSION);
	if(in_array($extension, $allowedExts)){

		if ($_FILES["profilePicFile"]["error"] > 0)
		{
    		echo "Return Code: " . $_FILES["profilePicFile"]["error"] . "<br />";
    	}
		else{
	    	// echo "Upload: " . $_FILES["profilePicFile"]["name"] . "<br />";
	    	// echo "Type: " . $_FILES["profilePicFile"]["type"] . "<br />";
	    	// echo "Size: " . ($_FILES["profilePicFile"]["size"] / 1024) . " Kb<br />";
	    	// echo "Temp file: " . $_FILES["profilePicFile"]["tmp_name"] . "<br />";

			move_uploaded_file($_FILES["profilePicFile"]["tmp_name"],
	 		$saveProfilePicPath . $_FILES["profilePicFile"]["name"]);
      		//echo "Stored in: " . $saveProfilePicPath . $_FILES["profilePicFile"]["name"];

      		$delQuery = "delete from userProfile where email='" . $email . "';";
      		//echo "<br>" . $delQuery . "<br>";
      		mysql_query ($delQuery) or die("Delete Query fails. Contact us to report the issue.");

      		$query = "INSERT INTO userProfile values('" . $email . "', '" .
      		$_FILES["profilePicFile"]["name"] . "', '" . $dob . "', '" . $educationQualification . "', '" .
      		$userType . "', '" . $gender . "');";
      		mysql_query ($query) or die("Insert Query fails. Contact us to report the issue.");
      		
      		header('Location: addInstitution.php');

	    }
  	}else{
		echo "Invalid file";		  	
	}
?>


