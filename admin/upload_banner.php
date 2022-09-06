<?php

// include_once "library/inc.connection.php";
//database configuration
// $dbHost = '192.168.20.158';
// $dbUsername = 'nex_erp_usr';
// $dbPassword = 'Rentas123!@#';
// $dbName = 'nex_erp_db';
$dbHost  = "localhost";
$dbUsername  = "root";
$dbPassword  = "Rentas123!@#";
$dbName  = "rentas_elib_db";
//connect with the database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!empty($_FILES)) {





	$txtCode = $_POST['txtCode'];
	$txtVersion = $_POST['txtVersion'];
	$txtName = $_POST['txtName'];
	$targetDir = "../uploads/";
	$fileName = "banner.jpg";



	$file_size   = $_FILES['txtPhoto']['size'];
	$file_tmp   = $_FILES['txtPhoto']['tmp_name'];
	$file_type  = $_FILES['txtPhoto']['type'];
	$file_ext  = strtolower(end(explode('.', $_FILES['txtPhoto']['name'])));
	$file_name   = $_FILES['txtPhoto']['name'] . "." . $file_ext;
	$fileName = str_replace("/", "-", $txtCode) . '-' . $_FILES['file']['name'];


	$ses_nama  = $_SESSION['SES_NAMA'];

	$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
	$targetFile = $targetDir . $fileName;
	if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
		//insert file information into db table
		$conn->query("INSERT INTO master_banner (logo, updated_by, updated_date)
		VALUES ('$fileName','$txtName', now())");
		// $conn->query("UPDATE master_banner SET updated_by='$txtName', updated_date=NOW() where 1=1");

	}
}
