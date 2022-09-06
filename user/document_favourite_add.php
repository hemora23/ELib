<?php
include_once "library/inc.seslogin.php";
$User =$_SESSION['SES_USERID'];
$ses_nama	= $_SESSION['SES_NAMA'];
// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if(isset($_GET['id'])){
	
	$mySql = "INSERT INTO document_favourite (user_id, document_id, updated_by, updated_date)
					   VALUES ('$User','".$_GET['id']."','$ses_nama',now())";
	$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysqli_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=".$_SESSION['SES_PAGE']."'>";
	}
}
else {
	// Jika tidak ada data Code ditemukan di URL
	echo "<b>Data does not exist!</b>";
}
?>