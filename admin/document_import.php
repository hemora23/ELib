<?php
include_once "library/inc.seslogin.php";
include "header.php";
include 'library/PHPExcel/IOFactory.php';
?>
<!-- page content -->
<div class="right_col" role="main">
<?php        
# Tombol cancel
if(isset($_POST['btnCancel'])){
	echo "<meta http-equiv='refresh' content='0; url=?page=Sales'>";
}
# Tombol Submit diklik
if(isset($_POST['btnSubmit'])){
	
$pesanError = array();
$iddoble = array();
$target_dir = "uploads/files/";
$inputFileName = $target_dir.'salesorder.xlsx'; 
$countupdate = 0;
$countinsert = 0;
$bulkNumber = getDatetimeNow();
$myQry="";
$myQry2="";

$Channel		= explode("|", $_POST['txtChannel']);
$dataCodeChannel= $Channel[0];
$dataChannel	= $Channel[1];

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	$pesanError[] ="Error loading file ".pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage();
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumm);
if ($dataChannel=="CRM") {
	if ($highestColumnIndex!=34) {
		$pesanError[] ="Error loading file : Jumlah kolom di file excel untuk CRM tidak sesuai";
		}
} else {
	if ($highestColumnIndex!=27) {
		$pesanError[] ="Error loading file : Jumlah kolom di file excel untuk non CRM tidak sesuai";
		}	
}
if (count($pesanError)>=1 ){
		echo "&nbsp;<div class='alert alert-warning'>";		
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div>"; 
}
else {
	

for($i=2;$i<=$arrayCount;$i++){

	$dataCode       = trim($allDataInSheet[$i]["A"]);	
	$cell = $objPHPExcel->getActiveSheet()->getCell('B' . $i);
	$dataRequestDate= $cell->getValue();
	if(PHPExcel_Shared_Date::isDateTime($cell)) {
		 $dataRequestDate = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($dataRequestDate)); 
	}
	//$dataRequestDate = date('Y-m-d', strtotime(str_replace('/', '-', trim($allDataInSheet[$i]["B"]))));
	//$dataRequestDate = date('Y-m-d', strtotime(PHPExcel_Shared_Date::ExcelToPHP(trim($allDataInSheet[$i]["B"]))));
	if ($dataChannel=="CRM") {
		$dataName		= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["I"])));
		$dataAddress		= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["J"])));
		$dataKelurahan	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["K"])));
		$dataKecamatan	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["L"])));
		$dataCity		= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["M"])));
		$dataPropinsi	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["O"])));
		$dataCodepos	= mysqli_real_escape_string(trim($allDataInSheet[$i]["N"]));
		$dataTel1		= mysqli_real_escape_string(trim($allDataInSheet[$i]["P"]));
		$dataTel2		= mysqli_real_escape_string(trim($allDataInSheet[$i]["Q"]));
		$dataNote		= mysqli_real_escape_string(trim($allDataInSheet[$i]["R"]));
		$dataAgen		= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["S"])));
		$dataPayment	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["T"])));
		$dataSource		= mysqli_real_escape_string(trim($allDataInSheet[$i]["U"]));
		$dataResult		= mysqli_real_escape_string(trim($allDataInSheet[$i]["V"]));
		$dataVoucher	= mysqli_real_escape_string(trim($allDataInSheet[$i]["W"]));
		$dataEmail		= mysqli_real_escape_string(trim($allDataInSheet[$i]["X"]));
		$dataAFC		= mysqli_real_escape_string(trim($allDataInSheet[$i]["Y"]));
		$dataRefAgen	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["Z"])));	
		$cell2 = $objPHPExcel->getActiveSheet()->getCell('AB' . $i);
		$dataSalesDate= $cell2->getValue();
		if(PHPExcel_Shared_Date::isDateTime($cell)) {
			 $dataSalesDate = date("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($dataSalesDate)); 
			 $dataSalesDate = date("Y-m-d H:i:s", strtotime('-7 hours', strtotime($dataSalesDate)));
		}
		$dataWarehouse  = "3";
		//$dataWarehouse	= mysqli_real_escape_string(trim($allDataInSheet[$i]["AD"]));
		$dataAWB		= mysqli_real_escape_string(trim($allDataInSheet[$i]["AF"]));
		$dataAdminEDC		= "0";
		$dataOngkir			= "0";
		//sales_detail
		$dataProduk			= trim($allDataInSheet[$i]["C"]);
		$dataSellingPrice	= trim($allDataInSheet[$i]["F"]);
		$dataDiscount		= trim($allDataInSheet[$i]["G"]);	
		$dataQty			= trim($allDataInSheet[$i]["E"]);
		
		
	} else {
		$dataName		= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["K"])));
		$dataAddress		= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["L"])));
		$dataKelurahan	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["M"])));
		$dataKecamatan	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["N"])));
		$dataCity		= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["O"])));
		$dataPropinsi	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["Q"])));
		$dataCodepos	= mysqli_real_escape_string(trim($allDataInSheet[$i]["P"]));
		$dataTel1		= mysqli_real_escape_string(trim($allDataInSheet[$i]["R"]));
		$dataTel2		= mysqli_real_escape_string(trim($allDataInSheet[$i]["S"]));
		$dataNote		= mysqli_real_escape_string(trim($allDataInSheet[$i]["T"]));
		$dataAgen		= "";
		$dataPayment	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["U"])));
		$dataSource		= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["V"])));
		$dataResult		= "";
		$dataVoucher	= mysqli_real_escape_string(trim($allDataInSheet[$i]["W"]));
		$dataEmail		= mysqli_real_escape_string(trim($allDataInSheet[$i]["X"]));
		$dataAFC		= "";
		$dataRefAgen	= mysqli_real_escape_string(strtoupper(trim($allDataInSheet[$i]["Y"])));	
		$cell2 = $objPHPExcel->getActiveSheet()->getCell('Z' . $i);
		$dataSalesDate= $cell2->getValue();
		if(PHPExcel_Shared_Date::isDateTime($cell)) {
			 $dataSalesDate = date("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($dataSalesDate)); 
			 $dataSalesDate = date("Y-m-d H:i:s", strtotime('-7 hours', strtotime($dataSalesDate)));
		}
		//$dataWarehouse	= mysqli_real_escape_string(trim($allDataInSheet[$i]["AA"]));
		$dataWarehouse  = "3";
		$dataAWB		= $dataCodeChannel.$dataCode;
		$dataOngkir			= trim($allDataInSheet[$i]["I"]);	
		$dataQty			= trim($allDataInSheet[$i]["E"]);	
		//sales_detail
		$dataProduk			= trim($allDataInSheet[$i]["C"]);
		$dataSellingPrice	= trim($allDataInSheet[$i]["F"]);
		$dataDiscount		= trim($allDataInSheet[$i]["G"]);
		$dataAdminEDC		= trim($allDataInSheet[$i]["H"]);
		

	}
	
	$dataStatus			= "Order";
	$_SESSION['SES_KODE'] = $dataCode;
	$ses_nama	= $_SESSION['SES_NAMA'];
	
		
$mySql="SELECT bulk_number FROM sales WHERE sales_id='$dataCode'";
$cekQry=mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error());
$myData = mysqli_fetch_array($cekQry);
$dataBulkNumber	= $myData['bulk_number'];

//if(mysqli_num_rows($cekQry)>=1){
if($dataBulkNumber!=''){
		
		if ($dataBulkNumber == $bulkNumber) {
			$mySql  	= "UPDATE sales SET sales_date='$dataSalesDate',request_date='$dataRequestDate', customer_name='$dataName', customer_address='$dataAddress', customer_village='$dataKelurahan', customer_subdistrict='$dataKecamatan', customer_province='$dataPropinsi', customer_city='$dataCity', customer_postal='$dataCodepos', customer_phone_1='$dataTel1',customer_phone_2='$dataTel2', customer_email='$dataEmail', sales_note='$dataNote',   agent='$dataAgen', refagent='$dataRefAgen', payment_type='$dataPayment', 	data_source='$dataSource', call_result='$dataResult', voucher='$dataVoucher', afcid='$dataAFC', awb='$dataAWB', 
			warehouse_id='$dataWarehouse', sales_status='$dataStatus', sales_channel='$dataChannel', updated_by='$ses_nama'   , updated_date=now(), bulk_number='$bulkNumber',delivery_cost='$dataOngkir',admin_cost='$dataAdminEDC' WHERE sales_id='$dataCode'";
			$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
			if($myQry){	
			$mySql3  	= "INSERT INTO sales_detail (sales_id, product_id, qty, selling_Price, discount, sales_status, updated_by ,updated_date,bulk_number)
							VALUES ('$dataCode','$dataProduk','$dataQty','$dataSellingPrice','$dataDiscount','$dataStatus', '$ses_nama',now(),'$bulkNumber')";  
			$myQry3=mysqli_query($mySql3, $koneksidb) or die ("Error query ".mysqli_error());		
			$countupdate++;
			$iddoble[]=$dataCode;
			}
		}
	}else {
		$countinsert++;
		$mySql  	= "INSERT INTO sales 
		(sales_id, sales_date,request_date, customer_name, customer_address, customer_village, 
		customer_subdistrict, customer_province, customer_city, customer_postal, customer_phone_1,customer_phone_2, 
		customer_email, sales_note, agent, refagent, payment_type, 
		data_source, call_result, voucher, afcid, awb, 
		warehouse_id, sales_status,  updated_by ,updated_date, sales_channel, bulk_number,delivery_cost,admin_cost)
		VALUES ('$dataCode','$dataSalesDate','$dataRequestDate','$dataName','$dataAddress', '$dataKelurahan',		
		'$dataKecamatan','$dataPropinsi','$dataCity','$dataCodepos','$dataTel1', '$dataTel2',		
		'$dataEmail','$dataNote','$dataAgen','$dataRefAgen', '$dataPayment',		
		'$dataSource','$dataResult','$dataVoucher','$dataAFC', '$dataAWB', 
		'$dataWarehouse', '$dataStatus', '$ses_nama',now(), '$dataChannel', '$bulkNumber', '$dataOngkir', '$dataAdminEDC')";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());	
		if($myQry){	
		$mySql3  	= "INSERT INTO sales_detail (sales_id, product_id, qty, selling_Price, discount, sales_status, updated_by ,updated_date,bulk_number)
						VALUES ('$dataCode','$dataProduk','$dataQty','$dataSellingPrice','$dataDiscount','$dataStatus', '$ses_nama',now(),'$bulkNumber')";  
		$myQry3=mysqli_query($mySql3, $koneksidb) or die ("Error query ".mysqli_error());		
		}
	}
	
	
} // for
$txtdouble="";
$mySql5  	= "delete  from sales_detail where bulk_number NOT IN (select bulk_number from sales)";  
$myQry5=mysqli_query($mySql5, $koneksidb) or die ("Error query ".mysqli_error());	
	
if($myQry5){
		$pesanError[] = "Upload ".$dataChannel." berhasil, Bulk ID : ".$bulkNumber.". Ada  ". $countinsert ." data yang di tambahkan. ";
	}else{
		
		$pesanError[] = "Maaf ! ada masalah pada saat upload data.";
	}

if($countupdate>0){
	foreach ($iddoble as $indeks=>$idouble_tampil) { 
				$txtdouble=$txtdouble." ".$idouble_tampil;
			} 
		//$pesanError[] = "Ada  ". $countupdate ." sales order dengan produk lebih dari satu, yaitu order id :".$txtdouble;
	}

echo "&nbsp;<div class='alert alert-success'>";		
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
			
		echo "</div>";
} // if error



	
	

		
} 


?>
       
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Tambah Data Bulk  <small></small></h3>
              </div>
              <div class="title_right">
              	<div class="form-group pull-right">
                	<a href="?page=Sales" class="btn btn-info btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Upload File <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="" ><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content"> 
                      	
                      	<form  action="upload.php" class="dropzone"></form>
                      	<div class="col-xs-12">
                        	
                          <div class="ln_solid"></div>
                          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                          	<div class="row">
                        <div class="col-xs-4 form-group">
                                <label >Order Channel *</label>
                                <select name="txtChannel" class="form-control" tabindex="-1">
                                <?php
                                  
                                    $mySql = "SELECT * FROM master_status WHERE status_group='Order' ORDER By status_id ";
                                    $dataQry = mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error()); 
                                      while ($dataRow = mysqli_fetch_array($dataQry)) {
                                          if ($dataRow['status_name'] == $dataChannel) {
                                                    $cek = " selected";
                                                } else { $cek=""; }
                                          echo "<option value='$dataRow[status_code]|$dataRow[status_name]' $cek>$dataRow[status_name]</option>";
                                      }
                                ?>                                               
                                 </select> 
                              </div>
                              </div>
                          	<a href="?page=Sales" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
                          	<button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-play fa-fw"></i> Process</button>
                            </form>
                      	</div> 
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php
include "footer.php";
?>


