<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if(isset($_GET['id'])){
	// Delete data sesuai Code yang didapat di URL
	$mySql  	= "UPDATE document_files SET document_order='".$_GET['o1']."' WHERE document_order = '".$_GET['o2']."' and document_id='".$_GET['id2']."'";
	$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());		
	
	$mySql  	= "UPDATE document_files SET document_order='".$_GET['o2']."' WHERE id = '".$_GET['id']."'";
	$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());		
	
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