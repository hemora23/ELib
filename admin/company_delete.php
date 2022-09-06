<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if(isset($_GET['id'])){
	// Delete data sesuai Code yang didapat di URL
	$mySql1 = "INSERT INTO log_deleted  (table_name, table_id, deleted_by, deleted_date) 
	VALUES ('master_company','".$_GET['id']."','".$_SESSION['SES_NAMA']."', NOW())";
	$myQry1 = mysqli_query($koneksidb,$mySql1) or die ("Eror hapus data".mysqli_error());
	
	$mySql = "DELETE FROM master_company WHERE company_id='".$_GET['id']."'";
	$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysqli_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?page=Company'>";
	}
}
else {
	// Jika tidak ada data Code ditemukan di URL
	echo "<b>Data does not exist!</b>";
}
?>