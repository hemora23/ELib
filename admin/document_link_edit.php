<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if(isset($_GET['id'])){
	$dataCode       = $_GET['id'];
	$dataVersion	= $_GET['v'];
	$dataFile       = $_GET['file'];
	// Delete data sesuai Code yang didapat di URL
	$documentlink = $link."?page=Document-Open&id=".$dataCode."&doc=".$dataFile."&hal=1"; 
	
	$mySql	= "SELECT count(*) as total from document_link WHERE  document_id='$dataCode' and document_file_title='$dataFile' ";
	$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
	$myData = mysqli_fetch_array($myQry);
	if ($myData['total']<1) {
	
	$mySql1 = "INSERT INTO document_link (document_id, document_file_title, document_link, updated_by, updated_date) 
	VALUES ('$dataCode','$dataFile','$documentlink','".$_SESSION['SES_NAMA']."', NOW())";
	$myQry1 = mysqli_query($koneksidb,$mySql1) or die ("Eror hapus data".mysqli_error());
	}
	if($myQry){
		echo "<meta http-equiv='refresh' content='0; url=?page=Document-Link-Add&id=".$dataCode."&v=".$dataVersion."'>";
		
	}
}
else {
	// Jika tidak ada data Code ditemukan di URL
	echo "<b>Data does not exist!</b>";
	
}
?>