<?php
include "../vendors/autoload.php";
include_once "library/inc.connection.php";

if(!empty($_FILES)){
	
	//database configuration
	$dbHost = 'localhost';
	$dbUsername = 'root';
	$dbPassword = 'Rentas123!@#';
	$dbName = 'rentas_kms_db';
	//connect with the database
	$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
	if($conn->connect_errno){
		echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}
	
	$txtCode= $_POST['txtCode'];
	$txtVersion=$_POST['txtVersion'];
	$txtName= $_POST['txtName'];
	
	
	
	
    
    
	
    



	
	
	function filesize_formatted($path)
	{
		$size = filesize($path);
		$units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		$power = $size > 0 ? floor(log($size, 1024)) : 0;
		return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
	}
	
	

	
	$targetDir = "../document_index/";
	$fileName = str_replace('&','And',$_FILES['file']['name']);
	$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
	
	$targetFile = $targetDir.$fileName;
	$fileSize =filesize_formatted($targetFile);
	
	if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
		//insert file information into db table
		$conn->query("INSERT INTO document_files_index (document_id, document_version, document_file_name, document_file_title, document_file_ext, document_size, updated_by, updated_date) 
		VALUES('$txtCode','$txtVersion','$targetFile','$fileName','$fileExt','$fileSize','$txtName',NOW())");
		
		
		$parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile($targetFile);
    $pages = $pdf->getPages();
    $text = "";
	$i=1;
    foreach ($pages as $page) {
        $text = $page->getText();
		$text = mysqli_real_escape_string($conn, $text);
		$conn->query("INSERT INTO document_index (document_id, document_version, document_file_title, document_page, document_content, updated_by, updated_date) 
		VALUES('$txtCode','$txtVersion','$fileName','$i','$text','$txtName',NOW())");		
		$i++;
    }
		
	}
	
	
	
	
	
}
?>