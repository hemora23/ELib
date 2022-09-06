<?php 

$datafile=array();
$datatotal=array();
$mySql 	= "select document_file_title, persen from view_log_document_percentage where user_id='".$_SESSION['SES_USERID']."' limit 5";
$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error($koneksidb));
while ($myData = mysqli_fetch_array($myQry)) {
	$datafile[]=$myData['document_file_title'];
	$datatotal[]=$myData['persen'];
}

foreach ($datafile as $bulan) {echo "".$bulan . ",";}
foreach ($datatotal as $total) {echo "".$total . ","; } 
 
 ?>
 
