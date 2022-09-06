<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if(isset($_GET['id'])){
	// Delete data sesuai Code yang didapat di URL
	$mySql1 = "INSERT INTO log_deleted  (table_name, table_id, deleted_by, deleted_date) 
	VALUES ('master_category','".$_GET['id2']."','".$_SESSION['SES_NAMA']."', NOW())";
	$myQry1 = mysqli_query($koneksidb,$mySql1) or die ("Eror hapus data".mysqli_error());
	
	$mySql = "DELETE FROM master_category WHERE id='".$_GET['id']."' and category_id='".$_GET['id2']."'";
	$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysqli_error());
	$mySql  	= "UPDATE master_category SET id=id-1 WHERE id >= '".$_GET['id']."'";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());		
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?page=Category'>";
	}
}
else {
	// Jika tidak ada data Code ditemukan di URL
	echo "<b>Data does not exist!</b>";
}
?>