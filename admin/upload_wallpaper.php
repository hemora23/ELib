<?php

include_once "library/inc.connection.php";


if(!empty($_FILES)){
	
	
	


	$txtCode= $_POST['txtCode'];
	$txtVersion= $_POST['txtVersion'];
	$txtName= $_POST['txtName'];
	$targetDir = "../uploads/";
	$fileName = "wallpaper.jpg";
	$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
	$targetFile = $targetDir.$fileName;
	if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
		//insert file information into db table
		$koneksidb->query("UPDATE master_wallpaper SET updated_by='$txtName', updated_date=NOW() where 1=1");
		
	}
	
	
	
}
?>