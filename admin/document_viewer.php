<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
date_default_timezone_set("Asia/Jakarta");	
$ip = $_SERVER['REMOTE_ADDR'];
$id			= isset($_GET['id']) ?  $_GET['id'] : ''; 
$version	= isset($_GET['v']) ?  $_GET['v'] : ''; 
$file		= isset($_GET['doc']) ?  $_GET['doc'] : ''; 
$page		= isset($_GET['hal']) ?  $_GET['hal'] : ''; 

$mySql  	= "INSERT INTO log_document (document_id,document_version,document_file_title,user_id,log_date, log_ipaddress, log_apps)
				VALUES ('$id','$version','".$file."',
				'".$_SESSION['SES_USERID']."',now(), '$ip','Web')";
$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());

$mySql	= "select * from view_document_files_admin where document_id='$id' and document_version='$version' and document_file_title='$file' ";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$filename = $myData['document_file_name'];

echo "<div class='watermark'></div><iframe width='100%' height='100%' frameborder='0' marginheight='0' marginwidth='0' style='z-index:-1'
    src='viewer.php?file=".$filename."#page=".$page."'>
</iframe>";			 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Knowledge Management System</title>
	<link rel="shortcut icon" href="images/favicon.ico">
	<style>



.watermark
{
   background-image: url(images/watermark.png);
   background-position: center;
   background-size: 100%; /* CSS3 only, but not really necessary if you make a large enough image */
   background-repeat:no-repeat;
   position: absolute;
   width: 70%;
   height: 50%;
   margin: 100;
   z-index: 10;
}

</style>
    
    
    
  </head>
 

<body topmargin="0"  bottommargin="0" marginheight="0" marginwidth="0" >

</body>
</html>
