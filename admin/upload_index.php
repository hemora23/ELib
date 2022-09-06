<?php
include "../vendors/autoload.php";
include_once "library/inc.connection.php";

if (!empty($_FILES)) {


	$txtCode = $_POST['txtCode'];
	$txtVersion = $_POST['txtVersion'];
	$txtName = $_POST['txtName'];

	function filesize_formatted($path)
	{
		$size = filesize($path);
		$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		$power = $size > 0 ? floor(log($size, 1024)) : 0;
		return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
	}

	$fileTitle = str_replace("&", "And", $_FILES['file']['name']);



	$targetDir = "../document_index/";
	$fileName = str_replace('&', 'And', $_FILES['file']['name']);
	$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

	$targetFile = $targetDir . $fileName;


	if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
		//insert file information into db table
		$fileSize = filesize_formatted($targetFile);
		// $koneksidb->query("INSERT INTO document_files_index (document_id, document_version, document_file_name, document_file_title, document_file_ext, document_size, updated_by, updated_date) 
		// VALUES('$txtCode','$txtVersion','$targetFile','$fileName','$fileExt','$fileSize','$txtName',NOW())");

		$fileTitle = mysqli_real_escape_string($koneksidb, $fileTitle);
		$targetFile1 = mysqli_real_escape_string($koneksidb, $targetFile);
		// 	$koneksidb->query("INSERT INTO document_files (document_id, document_version, document_file_name, document_file_title, document_file_ext, document_size, updated_by, updated_date) 
		// VALUES('$txtCode','$txtVersion','$targetFile','$fileTitle','$fileExt','$fileSize','$txtName',NOW())");
		$koneksidb->query("INSERT INTO document_files (document_id, document_version, document_file_name, document_file_title, document_file_ext, document_size, updated_by, updated_date) 
		VALUES('$txtCode','$txtVersion','$targetFile1','$fileTitle','$fileExt','$fileSize','$txtName',NOW())");

		$parser = new \Smalot\PdfParser\Parser();
		$pdf = $parser->parseFile($targetFile);
		$pages = $pdf->getPages();
		$text = "";
		$i = 1;
		foreach ($pages as $page) {
			$text = $page->getText();
			$text = mysqli_real_escape_string($koneksidb, $text);
			$koneksidb->query("INSERT INTO document_index (document_id, document_version, document_file_title, document_page, document_content, updated_by, updated_date) 
		VALUES('$txtCode','$txtVersion','$fileName','$i','$text','$txtName',NOW())");
			$i++;
		}
	}
}
