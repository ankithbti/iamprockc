<?php
$fileName = $_FILES["file1"]["name"];
$fileTempLoc = $_FILES["file1"]["tmp_name"];
$fileType = $_FILES["file1"]["type"];
$fileSize = $_FILES["file1"]["size"];
$fileErrorMsg = $_FILES["file1"]["error"];

if(!$fileTempLoc){
	echo " Please browse a file.";
	exit();
}

if(move_uploaded_file($fileTempLoc, "../../resources/uploads/$fileName")){
	echo "$fileName upload is complete.";
}else{
	echo "$fileName upload failed";
}

?>