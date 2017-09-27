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

	if(!isset($_POST['classCreationSubmit'])){
		header('Location: myClass.php');
	}


	$email = $_SESSION['email'];
	$userId = $_SESSION['userId'];
	$className = $_POST['className'];
	$subjectTags = $_POST['subjectTags'];
	$taregtAudience = $_POST['taregtAudience'];
	$classAddress = $_POST["classAddress"];
	$defaultPlan = $_POST["defaultPlan"];
	$entityType = $_POST["entityType"];
	$physicalPresence = 0;
	if(strcmp($classAddress, "Address") == 0){
		$physicalPresence = 0;
	}else{
		$physicalPresence = 1;
	}

	$savePath = "../../resources/uploads/" . $userId . "/";
	if (!file_exists($savePath)) {
    	mkdir($savePath, 0777, true);
	}
	
	$allowedExts = array("jpeg", "jpg", "png");
	$extension = pathinfo($_FILES['classLogo']['name'], PATHINFO_EXTENSION);

	if(in_array($extension, $allowedExts)){

		if ($_FILES["classLogo"]["error"] > 0)
		{
			$_SESSION['gClassCreationError'] = "Upload failed: Error: " .  $_FILES["classLogo"]["error"];
    	}
		else{
		    	echo "Upload: " . $_FILES["classLogo"]["name"] . "<br />";
		    	echo "Type: " . $_FILES["classLogo"]["type"] . "<br />";
		    	echo "Size: " . ($_FILES["classLogo"]["size"] / 1024) . " Kb<br />";
		    	echo "Temp file: " . $_FILES["classLogo"]["tmp_name"] . "<br />";

				if(move_uploaded_file($_FILES["classLogo"]["tmp_name"],
		 		$savePath . $_FILES["classLogo"]["name"])){
	      		echo "Stored in: " . $savePath . $_FILES["classLogo"]["name"];

				date("Y-m-d H:i:s");
	      		$query = "INSERT INTO userClass(userId, className, classLogo, address, defaultPlan, physicalPresence, entityType, targetAudience) values(" . $userId . ",'" . $className . "','" . $_FILES["classLogo"]["name"] . "','" . 
	      			$classAddress . "'," . $defaultPlan . "," . $physicalPresence . "," . $entityType . "," . $taregtAudience . ");";

	      		mysql_query ($query) or die("Insert Query fails. Contact us to report the issue.");

	      		
      		}else{
      			$_SESSION['gClassCreationError'] = "Upload Failed: Invalid File.";
      		}
	    }
  	}else{
  		$_SESSION['gClassCreationError'] = "Upload Failed: Invalid File.";
	}

	header('Location: myClass.php');
?>
