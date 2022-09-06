<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if(isset($_GET['id'])){
	// Delete data sesuai Code yang didapat di URL
	$mySql1 = "INSERT INTO log_deleted  (table_name, table_id, deleted_by, deleted_date) 
	VALUES ('document_files_index','".$_GET['id']."','".$_SESSION['SES_NAMA']."', NOW())";
	$myQry1 = mysqli_query($koneksidb,$mySql1) or die ("Eror hapus data".mysqli_error());
	
	$mySql = "DELETE FROM document_files_index WHERE id='".$_GET['id']."'";
	$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysqli_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?page=Document-Files&id=".$_GET['id2']."&v=".$_GET['v']."'>";
	}
}
else {
	// Jika tidak ada data Code ditemukan di URL
	echo "<b>Data does not exist!</b>";
}
?>