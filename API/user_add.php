<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

	
	# UPLOAD FOTO
		
		$file_photo ="photo.png";
		//$wmax = 300;
		//$hmax = 300;
		
		//if($_FILES['txtPhoto']['name']!=""){
		//	$file_size 	= $_FILES['txtPhoto']['size'];
		//	$file_tmp 	= $_FILES['txtPhoto']['tmp_name'];
		//	$file_type	= $_FILES['txtPhoto']['type'];   
		//	$file_ext	= strtolower(end(explode('.',$_FILES['txtPhoto']['name'])));
		//	$file_name 	= $_POST['txtCode'] . "." . $file_ext;	
		//	$file_photo = $file_name;	
		//	$expensions= array("jpeg","jpg","png","gif"); 		
		//	if(in_array($file_ext,$expensions)=== false){
		//		$pesanError[]="File hanya bisa format JPEG, GIF atau PNG";			
		//	}
		//	if($file_size > 2097152){
		//		$pesanError[]='Ukuran file maksimum 2 MB';
		//	}				
		//	if(empty($pesanError)==true){	
		//		$target_file = "uploads/".$file_name;
		//		move_uploaded_file($_FILES["txtPhoto"]["tmp_name"], $target_file);		
		//	}
		//}	
	
	$pesanError 			= array();
	$outlet_name			= 'Toko Zahra'; //$_POST('txt_toutlet_name');
	$outlet_contact			= 'Ibu Zahra'; //$_POST('txt_outlet_contact');
	$outlet_address			= 'ITC BSD Blok A-10'; //$_POST('txt_outlet_address');
	$outlet_city			= 'Tangerang Selatan'; //$_POST('txt_outlet_city');
	$outlet_phone			= '08588776878';//$_POST('txt_outlet_phone');
	$outlet_email			= 'zahra@gmail.com';//$_POST('txt_outlet_email');
	$outlet_photo			= $file_photo;
	$outlet_term_of_payment = '7';// Default 7 Days atau Pilihan ambil dari table master_status
	$outlet_credit_limit    = '3000000';// Default 3000000;
	$outlet_status  		= 'Register';// Deafult Register atau Pilihan ambil dari table master_status
	$username				= 'zahra';
	$password				= 'Zahra2018';
	$user_group				= 'Outlet'; // Deafult Outlet atau Pilihan ambil dari table master_status 	
	$updated_by				= 'Mobile Apps'; //$_SESSION['SES_NAMA'];
	
	
	# VALIDASI DATA, JIKA SUDAH ADA USERNAME AKAN DITOLAK
	$mySql="SELECT * FROM master_user_outlet WHERE username='$username'";
	$cekQry=mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error()); 
	if(mysqli_num_rows($cekQry)>=1){
		$pesanError[] = "data username <b> $username </b> sudah ada, ganti dengan yang lain";
	}
	$mySql="SELECT * FROM master_outlet WHERE outlet_phone='$outlet_phone'";
	$cekQry=mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error()); 
	if(mysqli_num_rows($cekQry)>=1){
		$pesanError[] = "data nomor telepon <b> $outlet_phone </b> sudah terdaftar";
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
	}
	else {
		
		
		
		
		# SIMPAN DATA KE DATABASE. 
		# GENERATE OUTLET_ID
		$mySql	= "SELECT * FROM master_code WHERE code_table='master_outlet'";
		$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
		$myData = mysqli_fetch_array($myQry);
		$outlet_id	= buatKode($myData['code_table'], $myData['code_name']);

		
		# INPUT DATA MASTER_OUTLET
		$mySql  	= "INSERT INTO master_outlet (outlet_id, outlet_name, outlet_contact, outlet_address, outlet_city, outlet_phone, outlet_email,
						outlet_photo, outlet_term_of_payment, outlet_credit_limit, outlet_status, updated_by, updated_date)
						VALUES ('$outlet_id', '$outlet_name', '$outlet_contact', '$outlet_address', '$outlet_city', '$outlet_phone', '$outlet_email',
						'$outlet_photo', '$outlet_term_of_payment', '$outlet_credit_limit', '$outlet_status', '$updated_by', NOW())";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
				
		# INPUT DATA MASTER_USER_OUTLET
		$mySql  	= "INSERT INTO master_user_outlet (outlet_id, username, password, user_group, updated_by, updated_date)
						VALUES ('$outlet_id', '$username', MD5('$password'), '$user_group', '$updated_by', NOW())";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		if($myQry){
			echo "Data ".$outlet_name." berhasil disimpan";
		}
		exit;
	}	

?>
            





  
