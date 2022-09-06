<?php 
if(isset($_POST['btnLogin'])){
	$pesanError = array();
	if ( trim($_POST['txtUser'])=="") {
		$pesanError[] = "Data <b> username </b> tidak boleh kosong / <i>Data <b> username </ b> can not be empty</i> !";		
	}
	if (trim($_POST['txtPassword'])=="") {
		$pesanError[] = "Data <b> password </b> tidak boleh kosong / <i>Data <b> password </ b> can not be empty</i> !";		
	}
		
	# Baca variabel form
	$txtUser 		= mysqli_real_escape_string($koneksidb, $_POST['txtUser']);
	$txtPassword	= mysqli_real_escape_string($koneksidb, $_POST['txtPassword']);
	$ip = $_SERVER['REMOTE_ADDR'];
	
	
	#$cmbLevel	=$_POST['cmbLevel'];
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){

		echo "<div class='panel-body'><div class='alert alert-warning' align='center'>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div>"; 
		
		// Tampilkan lagi form login
		include "login.php";
	}
	else {
		# LOGIN CEK KE TABEL USER LOGIN
		$mySql = "SELECT * FROM view_login_user u WHERE u.username='".$txtUser."' 
					AND u.password='".md5($txtPassword)."' ";
		$myQry = mysqli_query($koneksidb,$mySql) or die ("Query Salah : ".mysqli_error());
		$myData= mysqli_fetch_array($myQry);
		
		# JIKA LOGIN SUKSES
		if(mysqli_num_rows($myQry) >=1) {
			$_SESSION['SES_LOGIN'] = $myData['username']; 
			$_SESSION['SES_USERID'] = $myData['user_id']; 
			$_SESSION['SES_NAMA'] = $myData['user_fullname'];
			$_SESSION['SES_PHOTO'] = $myData['user_photo']; 
			$_SESSION['SES_GROUP'] = $myData['user_group']; 
			
			// Jika yang login Administrator
			if($myData['user_group']=="Admin") {
				$_SESSION['SES_ADMIN'] = "Admin";
				
				//$mySql  	= "INSERT INTO log_user (user_id,log_date, log_ipaddress, log_apps)
				//		VALUES ('".$myData['user_id']."',now(), '$ip','Web')";
				//$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
				echo "<meta http-equiv='refresh' content='0; url=?page=Main'>";
				
			} else {
				$pesanError[] = "Hak akses bukan sebagai Admin !";
				echo "<div class='panel-body'><div class='alert alert-warning' align='center'>";
				$noPesan=0;
				foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++;
					echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
				} 
				echo "</div>"; 
				include "login.php";
			}
			
			
			
			
		}
		else {
			$pesanError[] = "Username atau password salah / <i>Incorrect username or password</i> !";
			if (empty($_SESSION['failed_login'])) 
				{$_SESSION['failed_login'] = 1;}
				else 
				{$_SESSION['failed_login']++;}
					
			echo "<div class='panel-body'><div class='alert alert-warning' align='center'>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
			echo "</div>"; 
		
		// Tampilkan lagi form login
		include "login.php";
		}
	}
} // End POST
?>
 
