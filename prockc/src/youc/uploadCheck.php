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

	if(!isset($_POST['uploadSubmitted'])){
		header('Location: uploadManager.php');
	}

	if(!$_FILES['videoFile']['name']){
		echo " Please browse a file.";
		exit();
	}

	$email = $_SESSION['email'];
	$userId = $_SESSION['userId'];
	$title = $_POST['title'];
	$description = $_POST["description"];
	$costPerView = $_POST["costPerView"];
	$videoTagsArray = explode(',', $_POST['videoTags']);



	$saveVideoPath = "../../resources/uploads/" . $userId . "/";
	if (!file_exists($saveVideoPath)) {
    	mkdir($saveVideoPath, 0777, true);
	}
	
	$allowedExts = array("mp4", "avi", "mpeg");
	$extension = pathinfo($_FILES['videoFile']['name'], PATHINFO_EXTENSION);

	if(in_array($extension, $allowedExts)){

		if ($_FILES["videoFile"]["error"] > 0)
		{
			$_SESSION['gUploadError'] = "Upload failed: Error: " .  $_FILES["videoFile"]["error"];
    		echo "Return Code: " . $_FILES["videoFile"]["error"] . "<br />";
    	}
		else{
	    	// echo "Upload: " . $_FILES["videoFile"]["name"] . "<br />";
	    	// echo "Type: " . $_FILES["videoFile"]["type"] . "<br />";
	    	// echo "Size: " . ($_FILES["videoFile"]["size"] / 1024) . " Kb<br />";
	    	// echo "Temp file: " . $_FILES["videoFile"]["tmp_name"] . "<br />";

			if(move_uploaded_file($_FILES["videoFile"]["tmp_name"],
	 		$saveVideoPath . $_FILES["videoFile"]["name"])){
      		//echo "Stored in: " . $saveProfilePicPath . $_FILES["videoFile"]["name"];

			// date("Y-m-d H:i:s");
      		$query = "INSERT INTO videos(title, description, videoFile, uploaderId, uploadDateTime, noOfViews, cost, lastViewDateTime, promotional) values('" . $title . "', '" . $description . "', '" .
      		$_FILES["videoFile"]["name"] . "', " . $userId . ", '" . $datetime . "', 0, " .
      		$costPerView . ", '" . $datetime . "', 0);";

      		mysql_query ($query) or die("Insert Query fails: " . $query . " Contact us to report the issue.");
      		$_SESSION['gUploadSuccess'] = "Video has been uploaded successfully.";
      		echo $_FILES["videoFile"]["name"] . " - upload completed.";

      		$thisVideoId=0;

      		// Get previous Video Id
      		$getVideoId="select * from videos where uploaderId=" . $userId . " ORDER BY uploadDateTime DESC LIMIT 1";
      		$getVideoIdRes = mysql_query ($getVideoId) or die("Query fails: " . $getVideoId . " Contact us to report the issue.");
      		while($getVideoIdResRow = mysql_fetch_array($getVideoIdRes, MYSQL_NUM) ){
      			$thisVideoId = $getVideoIdResRow[0];
      		}


      		// Add Tags if new
      		foreach ($videoTagsArray as &$tagName) {

      			$tagId=0;

      			$tagCreateQ="select * from videoTags where tagName='" . strtoupper($tagName) . "';";
      			mysql_query ($tagCreateQ) or die("Query fails: " . $tagCreateQ . " Contact us to report the issue.");
      			if (mysql_affected_rows() > 0){
      				// Add this Tag Id against this video
      			}else{
      				// Insert this new Video Tag
      				$tagInsertQ="INSERT INTO videoTags(tagName) values('" . strtoupper($tagName) . "');";
      				mysql_query ($tagInsertQ) or die("Query fails: " . $tagInsertQ . " Contact us to report the issue.");
      			}

      			// Select the TagId
      			$getTagId="select * from videoTags where tagName='" . strtoupper($tagName) . "';";
      			$getTagIdRes = mysql_query ($getTagId) or die("Query fails: " . $getTagId . " Contact us to report the issue.");
      			while($getTagIdResRow = mysql_fetch_array($getTagIdRes, MYSQL_NUM) ){
      				$tagId = $getTagIdResRow[0];
      			}

      			// Insert this tagId against this video
      			$videoTagInsertQ="INSERT INTO video2VideoTags values(" . $tagId . "," . $thisVideoId . ");";
      			mysql_query ($videoTagInsertQ) or die("Query fails: " . $videoTagInsertQ . " Contact us to report the issue.");

      		}
      		

      		//header('Location: uploadManager.php');
      		}else{
      			$_SESSION['gUploadError'] = "Upload Failed: Invalid File.";
      			echo $_FILES["videoFile"]["name"] . " - upload failed";
      		}
	    }
  	}else{
  		$_SESSION['gUploadError'] = "Upload Failed: Invalid File.";
		echo "Invalid file: " . $extension;	  	
		
	}
?>
