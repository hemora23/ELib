<?php


$sesUSername = $_SESSION['SES_LOGIN'];
$sesToken = $_SESSION['SES_TOKEN'];
$mySql = "SELECT * FROM master_user WHERE username='" . $sesUSername . "'";
$myQry = mysqli_query($koneksidb, $mySql) or die("Query Salah : " . mysqli_error());
$myData = mysqli_fetch_array($myQry);
$dataToken = $myData['user_token'];

if ((empty($_SESSION['SES_ADMIN']) or ($sesToken != $dataToken))) {
	echo "<div class='panel-body'><div class='alert alert-warning ' align='center'>";
	echo "<b>Akses ditolak !</b> Silahkan login terlebih dahulu / Anda tidak memiliki hak akses sebagai administrator<br>
		  <i><b>Access denied !</b> Please log in first / you don't have administrator access rights</i>";
	echo "</div>";
	include_once "login.php";
	exit;
}
$formattedMonthArray = array(
	"1" => "January", "2" => "February", "3" => "March", "4" => "April",
	"5" => "May", "6" => "June", "7" => "July", "8" => "August",
	"9" => "September", "10" => "October", "11" => "November", "12" => "December",
);
$monthArray = range(1, 12);
$yearArray = range(2017, 2021);
// exit;
