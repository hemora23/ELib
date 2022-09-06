<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if (isset($_GET['id'])) {
	$dataCode       = $_GET['id'];
	$dataVersion	= $_GET['v'];
	$mySql	= "SELECT * FROM document WHERE document_id='$dataCode' and document_version='$dataVersion'";
	$myQry	= mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
	$myData = mysqli_fetch_array($myQry);
	$dataStatus		= $myData['document_status'];
	if ($dataStatus	== "Reviewed") {
		echo "<meta http-equiv='refresh' content='0; url=?page=Document-Review'>";
	}
	$ses_nama	= $_SESSION['SES_NAMA'];

	if ($dataStatus		== "Created") {
		$mySql1 = "INSERT INTO log_deleted  (table_name, table_id, deleted_by, deleted_date) 
		VALUES ('document','$dataCode','$ses_nama', NOW())";
		$myQry1 = mysqli_query($koneksidb, $mySql1) or die("Eror hapus data" . mysqli_error($koneksidb));

		$mySql = "DELETE FROM document_status WHERE document_id='$dataCode' and document_version='$dataVersion'";
		$myQry = mysqli_query($koneksidb, $mySql) or die("Error hapus data" . mysqli_error($koneksidb));

		$mySql = "DELETE FROM document_files WHERE document_id='$dataCode' and document_version='$dataVersion'";
		$myQry = mysqli_query($koneksidb, $mySql) or die("Error hapus data" . mysqli_error($koneksidb));

		// $mySql = "DELETE FROM document_files_index WHERE document_id='$dataCode' and document_version='$dataVersion'";
		// $myQry = mysqli_query($koneksidb, $mySql) or die("Error hapus data" . mysqli_error($koneksidb));

		$mySql = "DELETE FROM document_index WHERE document_id='$dataCode' and document_version='$dataVersion'";
		$myQry = mysqli_query($koneksidb, $mySql) or die("Error hapus data" . mysqli_error($koneksidb));

		$mySql = "DELETE FROM document_privileges WHERE document_id='$dataCode' and document_version='$dataVersion'";
		$myQry = mysqli_query($koneksidb, $mySql) or die("Error hapus data" . mysqli_error($koneksidb));

		$mySql = "DELETE FROM document WHERE document_id='$dataCode' and document_version='$dataVersion'";
		$myQry = mysqli_query($koneksidb, $mySql) or die("Error hapus data" . mysqli_error($koneksidb));
	} else {
		$mySql = "UPDATE document SET document_status='Request Delete'  WHERE document_id='$dataCode' and document_version='$dataVersion'";
		$myQry = mysqli_query($koneksidb, $mySql) or die("Eror hapus data" . mysqli_error($koneksidb));
		$mySql  	= "INSERT INTO document_status (document_id, document_version, document_status, updated_by, updated_date)
						VALUES ('$dataCode','$dataVersion','Request Delete','$ses_nama',now())";
		$myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
	}



	if ($myQry) {
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?page=Document'>";
	}
} else {
	// Jika tidak ada data Code ditemukan di URL
	echo "<b>Data does not exist!</b>";
}
