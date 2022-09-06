<?php
include_once "library/inc.seslogin.php";
$User =$_SESSION['SES_USERID'];
// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if(isset($_GET['id'])){
	
	$mySql = "DELETE FROM document_favourite WHERE document_id='".$_GET['id']."' and user_id='$User'";
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