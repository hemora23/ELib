<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if (isset($_GET['id'])) {
    $dataCode       = $_GET['id'];
    $dataVersion    = $_GET['v'];
    // $mySql    = "SELECT * FROM master_banner WHERE id='$dataCode'";
    // $myQry    = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
    // $myData = mysqli_fetch_array($myQry);
    // $dataStatus        = $myData['document_status'];

    $mySql1 = "INSERT INTO log_deleted  (table_name, table_id, deleted_by, deleted_date) 
		VALUES ('benner','$dataCode','$ses_nama', NOW())";
    $myQry1 = mysqli_query($koneksidb, $mySql1) or die("Eror hapus data" . mysqli_error());

    $mySql = "DELETE FROM master_banner WHERE id='$dataCode'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error hapus data" . mysqli_error());





    if ($myQry) {
        // Refresh halaman
        echo "<meta http-equiv='refresh' content='0; url=?page=Banner'>";
    }
} else {
    // Jika tidak ada data Code ditemukan di URL
    echo "<b>Data does not exist!</b>";
}
