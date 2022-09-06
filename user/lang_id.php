<?php
$mySql  	= "UPDATE master_user SET language='id'	WHERE user_id = '".$_SESSION['SES_USERID']."'";
$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
$_SESSION['SES_LANG']='id';
echo "<meta http-equiv='refresh' content='0; url=".$_SESSION['SES_PAGE']."'>";
?>