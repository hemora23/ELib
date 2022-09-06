<?php
$target_dir = "uploads/files/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$status = 0;

$_SESSION['SES_UPLOAD_FILES']=$_FILES['file']['name'];
$storagename = $target_dir."master_category.xlsx";
if (move_uploaded_file($_FILES["file"]["tmp_name"], $storagename)) {
	
    $status = 1;
	
	
}
?>
