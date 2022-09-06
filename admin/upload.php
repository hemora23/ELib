<?php

include_once "library/inc.connection.php";


if(!empty($_FILES)){
	
	function filesize_formatted($path)
	{
		$size = filesize($path);
		$units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		$power = $size > 0 ? floor(log($size, 1024)) : 0;
		return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
	}
	
	
	//database configuration
	//$dbHost = 'localhost';
	//$dbUsername = 'root';
	//$dbPassword = '';
	//$dbName = 'rentas_kms_db';
	//connect with the database
	//$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
	//if($mysqli->connect_errno){
	//	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	//}

	$txtCode= $_POST['txtCode'];
	$txtVersion= $_POST['txtVersion'];
	$txtName= $_POST['txtName'];
	$targetDir = "../document/";
	$fileTitle = str_replace("&","And",$_FILES['file']['name']);
	$fileName = $_POST['txtCode'].'_'.$_POST['txtVersion'].'_'.str_replace('&','And',$_FILES['file']['name']);
	$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
	
	$targetFile = $targetDir.$fileName;
	
	if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
		//insert file information into db table
		$fileSize =filesize_formatted($targetFile);
		$koneksidb->query("INSERT INTO document_files (document_id, document_version, document_file_name, document_file_title, document_file_ext, document_size, updated_by, updated_date) 
		VALUES('$txtCode','$txtVersion','$targetFile','$fileTitle','$fileExt','$fileSize','$txtName',NOW())");
		
	}
	
	
}
