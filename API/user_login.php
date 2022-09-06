<?php 
include_once "library/inc.connection.php";

	$pesanError = array();
	$ip 		= $_SERVER['REMOTE_ADDR'];
	$location	= '-6.285799,106.664323';//Ambil dari GPS Apps
	$username	= 'zahra';
	$password	= md5('Zahra2018');


		# LOGIN CEK KE TABEL USER LOGIN
		$mySql = "SELECT * FROM view_login WHERE username='$username' and password='$password' ";
		$myQry = mysqli_query($koneksidb,$mySql) or die ("Query Salah : ".mysqli_error());
		$myData= mysqli_fetch_array($myQry);
		
		# JIKA LOGIN SUKSES
		if(mysqli_num_rows($myQry) >=1) {
			echo "Login berhasil !";
			# INPUT LOG LOGIN
			$mySql  	= "INSERT INTO log_user_outlet (username,logindate, ip, location) VALUES ('$username',now(),'$ip','$location')";
			$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		}
		# JIKA LOGIN GAGAL
		else {
			echo "Login gagal ! Username / password yang dimasukan salah atau user di blokir";
		}

?>
 
