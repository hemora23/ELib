<?php

// include_once "library/inc.connection.php";


if (!empty($_FILES)) {

	$dbHost  = "localhost";
	$dbUsername  = "root";
	$dbPassword  = "Rentas123!@#";
	$dbName  = "rentas_elib_db";
	//connect with the database
	$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}



	$txtCode = $_POST['txtCode'];
	$txtVersion = $_POST['txtVersion'];
	$txtName = $_POST['txtName'];
	$targetDir = "../uploads/";
	$fileName = "logo.png";
	$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
	$targetFile = $targetDir . $fileName;
	if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
		//insert file information into db table
		$conn->query("UPDATE master_logo SET updated_by='$txtName', updated_date=NOW() where 1=1");
	}
}
