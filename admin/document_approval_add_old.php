<?php 
if(isset($_GET['id'])){
$Status		= $_GET['status'];
$Code		= $_GET['id'];
$Version	= $_GET['v'];
$ses_nama	= $_SESSION['SES_NAMA'];

if ($Status	== "Approved") {
	$mySql  	= "UPDATE document SET document_status='Deleted', updated_by='$ses_nama'   , updated_date=now() 
					WHERE document_id = '$Code' and document_version < '$Version'";
	$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
} else {
	
}
		
$mySql  	= "UPDATE document SET document_status='$Status', updated_by='$ses_nama'   , updated_date=now() 
WHERE document_id = '$Code' and document_version='$Version'";
$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());

	$mySql  	= "INSERT INTO document_status (document_version, document_id, document_status, updated_by, updated_date) 
	VALUES  ('$Version','$Code','$Status','$ses_nama',now())";
	$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());


if($myQry){
	echo "<meta http-equiv='refresh' content='0; url=?page=Document-Approval'>";
}
exit;
}
?>
 
