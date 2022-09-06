<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Organization pada URL (alamat browser)
if(isset($_GET['id'])){
	// Delete data sesuai Organization yang didapat di URL
	
	$mySql = "DELETE FROM master_organization WHERE organization_id='".$_GET['id']."'";
	$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysqli_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?page=Organization'>";
	}
}
else {
	// Jika tidak ada data Organization ditemukan di URL
	echo "<b>Data does not exist!</b>";
}
?>