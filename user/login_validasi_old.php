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
		# CEK LDAP USER
		$adServer = "LDAP://192.168.88.33"; //"ldap://domaincontroller.mydomain.com";
		$ldap = ldap_connect($adServer);
		$username = $txtUser;
		$password = $txtPassword;	
		$ldaprdn = 'hanabank' . "\\" . $username; //'mydomain' . "\\" . $username;	
		ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);	
		$bind = @ldap_bind($ldap, $ldaprdn, $password);	
		if ($bind) {			
			@ldap_close($ldap);
			# LOGIN CEK KE TABEL USER LOGIN
			$mySql = "SELECT * FROM view_login_user u WHERE u.username='".$txtUser."' ";
			$myQry = mysqli_query($koneksidb,$mySql) or die ("Query Salah : ".mysqli_error());
			$myData= mysqli_fetch_array($myQry);
			
			# JIKA LOGIN SUKSES
			if(mysqli_num_rows($myQry) >=1) {
				$_SESSION['SES_LOGIN'] = $myData['username'];
				$_SESSION['SES_NAMA'] = $myData['user_fullname'];
				$_SESSION['SES_PHOTO'] = $myData['user_photo']; 
				$_SESSION['SES_GROUP'] = $myData['user_group']; 
				$_SESSION['SES_DIVISION'] = $myData['division']; 
				$_SESSION['SES_DEPARTMENT'] = $myData['department']; 
				$_SESSION['SES_UNIT'] = $myData['unit']; 
				$_SESSION['SES_USERID'] = $myData['user_id']; 
				$_SESSION['SES_LANG'] = $myData['language']; 
				
				// Jika yang login Administrator
				if($myData['user_group']=="Admin") {
					$_SESSION['SES_ADMIN'] = "Admin";
				} else {
					$_SESSION['SES_USER'] = "User";
				}
				$web = "web";
				$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) 
	$web = "mobile";

				
				
				$mySql  	= "INSERT INTO log_user (user_id,log_date, log_ipaddress, log_apps)
							VALUES ('".$myData['user_id']."',now(), '$ip','$web')";
				$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
				echo "<meta http-equiv='refresh' content='0; url=?page=Main'>";
							
				// Refresh
				
			}
			else {
				$pesanError[] = "Username atau password salah / <i>Incorrect username or password</i>  !";
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
			
			include "login.php";
			}
			
		} else {
			# LOGIN CEK KE TABEL USER LOGIN
			$mySql = "SELECT * FROM view_login_user u WHERE u.username='".$txtUser."' 
						AND u.password='".md5($txtPassword)."' ";
			$myQry = mysqli_query($koneksidb,$mySql) or die ("Query Salah : ".mysqli_error());
			$myData= mysqli_fetch_array($myQry);
			
			# JIKA LOGIN SUKSES
			if(mysqli_num_rows($myQry) >=1) {
				$_SESSION['SES_LOGIN'] = $myData['username'];
				$_SESSION['SES_DIVISION'] = $myData['division']; 
				$_SESSION['SES_DEPARTMENT'] = $myData['department']; 
				$_SESSION['SES_UNIT'] = $myData['unit']; 
				$_SESSION['SES_USERID'] = $myData['user_id']; 
				$_SESSION['SES_LANG'] = $myData['language']; 
				$_SESSION['SES_NAMA'] = $myData['user_fullname'];
				$_SESSION['SES_PHOTO'] = $myData['user_photo']; 
				$_SESSION['SES_GROUP'] = $myData['user_group']; 
				$_SESSION['SES_LANG'] = $myData['language']; 
				
				// Jika yang login Administrator
				if($myData['user_group']=="Admin") {
					$_SESSION['SES_ADMIN'] = "Admin";
				} else {
					$_SESSION['SES_USER'] = "User";
				}
				
				
				$mySql  	= "INSERT INTO log_user (user_id,log_date, log_ipaddress, log_apps)
							VALUES ('".$myData['user_id']."',now(), '$ip','Web')";
				$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
				echo "<meta http-equiv='refresh' content='0; url=?page=Main'>";
							
				// Refresh
				
			}
			else {
				$pesanError[] = "Username atau password salah / <i>Incorrect username or password</i>  !";
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
			
			include "login.php";
			}
		}
		
		
		
	}
} // End POST
?>
 
