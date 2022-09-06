<?php
$_SESSION['SES_LOGIN'] = ''; 
$_SESSION['SES_NAMA'] = '';
$_SESSION['SES_OUTLET'] = '';
$_SESSION['SES_KODE_OUTLET'] = ''; 
$_SESSION['SES_ADMIN'] = '';
$_SESSION['SES_USER'] = '';
session_unset();
session_destroy();
echo "<meta http-equiv='refresh' content='0; url=?page=Login'>";
exit;
?>