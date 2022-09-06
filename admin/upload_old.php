<?php
$uploadDir = "uploads/files/";


if (!empty($_FILES)) {
	
	$tmpFile = $_FILES['file']['tmp_name'];
	$filename = $uploadDir.'/'.time().'_'. $_FILES['file']['name'];

	move_uploaded_file($tmpFile,$filename);
	
	
}

     $txtCode= $_POST['txtCode'];
	$txtVersion= $_POST['txtVersion'];
	$ses_nama	= $_SESSION['SES_NAMA'];
	
	$mySql  	= "INSERT INTO sales_files(sales_version, sales_id, sales_filename, updated_by, updated_date)
	
					   				   VALUES ('1','2','3','$ses_nama',now())";
	$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query  ".mysqli_error());
//VALUES ('$txtVersion','$txtCode','$filename','$ses_nama',now())";
?>
