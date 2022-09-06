<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

	
	$pesanError 			= array();
	
	$outlet_id				='OT-0000002';
	$order_discount			='0'; // pilihan ambil dari master_discount
	$order_payment_type		='Bank Transfer' ;// pilihan ambil dari master status
	$order_note				='';
	$updated_by				= 'zahra'; //$_SESSION['SES_NAMA']; <--diisi username outlet
	
	//data dibawah ambil dari view_product
	$product_id				= 'PR-0000002' ;
	$product_qty			= '1'; // quntity sesuai yg diorder
	$product_pricelist		= '48600'; 
	$product_discount		= '9';
	$product_selling_price	= '43800';
	$status					= 'Order'; // default status order
	
	

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
		# GENERATE KODE ORDER_ID
		$mySql	= "SELECT * FROM master_code WHERE code_table='order_header'";
		$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
		$myData = mysqli_fetch_array($myQry);
		$order_id	= buatKode($myData['code_table'], $myData['code_name']);

		
		# INPUT DATA ORDER
		$mySql  	= "INSERT INTO order_header(order_id, order_date, outlet_id, order_discount, order_payment_type, order_note, updated_by, updated_date)
						VALUES ('$order_id', NOW(), '$outlet_id', '$order_discount', '$order_payment_type', '$order_note', '$updated_by', NOW())";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
				
		# INPUT DATA DETAIL PRODUK YG DIORDER (DI LOOPING UNTUK ORDER LEBIH DARI 1 ITEM BARANG)
		$mySql  	= "INSERT INTO order_detail (order_id, product_id, product_qty, product_pricelist, product_discount, product_selling_price,
						 product_status, updated_by, updated_date)
						VALUES ('$order_id', '$product_id', '$product_qty', '$product_pricelist', '$product_discount', '$product_selling_price',
						 '$status', '$updated_by', NOW())";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		
		# INPUT DATA STATUS ORDER
		$mySql  	= "INSERT INTO order_status (order_id, order_status, updated_by, updated_date)
						VALUES ('$order_id', '$status','$updated_by', NOW())";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		
		if($myQry){
			echo "Data ".$order_id." berhasil disimpan !";
		}
		exit;
	}	

?>
            





  
