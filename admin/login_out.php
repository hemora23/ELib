<?php
$_SESSION['SES_LOGIN'] = "";
$_SESSION['SES_USERID'] = "";
$_SESSION['SES_NAMA'] =  "";
$_SESSION['SES_PHOTO'] = "";
$_SESSION['SES_POSITION'] = "";
$_SESSION['SES_GROUP'] = "";
$_SESSION['SES_DIVISION'] = "";
$_SESSION['SES_LANG'] = "";
$_SESSION['SES_TOKEN'] = "";
$_SESSION['SES_TITLE'] = "";
$_SESSION['SES_SUBTITLE'] = "";
session_unset();
session_destroy();
echo "<meta http-equiv='refresh' content='0; url=?page=Login'>";
exit;
