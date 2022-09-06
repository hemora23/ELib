<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Company";
?>
<div class="right_col" role="main">
   
<?php        
# Tombol cancel
if(isset($_POST['btnCancel'])){
	echo "<meta http-equiv='refresh' content='0; url=?page=Company'>";
}
# Tombol Submit diklik
if(isset($_POST['btnSubmit'])){
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($_POST['txtCompany'])=="") {
		$pesanError[] = "Data <b>Company</b> tidak boleh kosong !";		
	}
	
	
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtCompany= $_POST['txtCompany'];
	$txtAddress = $_POST['txtAddress'];
	$txtCity = $_POST['txtCity'];
	$txtContact = $_POST['txtContact'];
	$txtPhone = $_POST['txtPhone'];
	$txtEmail = $_POST['txtEmail'];
	$txtStatus = $_POST['txtStatus'];
	$txtFax = $_POST['txtFax'];
	$txtNPWP = $_POST['txtNPWP'];
	

	# JIKA ADA PESAN ERROR DARI VALIDASI
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
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database
		$kodeBaru	= $_POST['txtCode'];
		$ses_nama	= $_SESSION['SES_NAMA'];
		$mySql  	= "UPDATE master_company SET company_name='$txtCompany', company_city='$txtCity', company_address='$txtAddress', company_contact='$txtContact', company_phone='$txtPhone', company_email='$txtEmail', company_status='$txtStatus', company_fax='$txtFax', company_npwp='$txtNPWP', updated_by='$ses_nama'   , updated_date=now() WHERE company_id = '$kodeBaru'";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Company'>";
		}
		exit;
	}	
} // Penutup Tombol Submit

$Code	= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtCode']; 
$mySql	= "SELECT * FROM master_company WHERE company_id='$Code'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
# MASUKKAN DATA KE VARIABEL
$dataCode		= $myData['company_id'];
$dataCompany	= isset($_POST['txtCompany']) ? $_POST['txtCompany'] : $myData['company_name'];
$dataAddress	= isset($_POST['txtAddress']) ? $_POST['txtAddress'] : $myData['company_address'];
$dataCity	= isset($_POST['txtCity']) ? $_POST['txtCity'] : $myData['company_city'];
$dataContact	= isset($_POST['txtContact']) ? $_POST['txtContact'] : $myData['company_contact'];
$dataPhone	= isset($_POST['txtPhone']) ? $_POST['txtPhone'] : $myData['company_phone'];
$dataEmail	= isset($_POST['txtEmail']) ? $_POST['txtEmail'] : $myData['company_email'];
$dataStatus	= isset($_POST['txtStatus']) ? $_POST['txtStatus'] : $myData['company_status'];
$dataNPWP	= isset($_POST['txtNPWP']) ? $_POST['txtNPWP'] : $myData['company_npwp'];
$dataFax 	= isset($_POST['txtFax']) ? $_POST['txtFax'] : $myData['company_fax'];

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
	<div class="page-title"><!-- page-title -->
      <div class="title_left">
        <h3>Company</h3>
      </div>
      <div class="title_right">
        <div class="form-group pull-right top_search">
        	
        </div>
      </div>
    </div><!-- /page-title -->
    <div class="clearfix"></div>
    
    <div class="row"><!-- row -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"><!-- x_panel -->
        
          <div class="x_title"><!-- x_title -->
            <h2>Edit Data</h2>
             <ul class="nav navbar-right">
                      	<a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
                    </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->
          
          <div class="x_content "><!-- x_content -->
              <br />
              <div class="col-sm-4">
                  <div class="form-group">
                    <label >Code</label>
                    <input class="form-control" name="txtCode" type="text" value="<?php echo $dataCode; ?>"  maxlength="10" readonly="readonly"/>
                  </div>                  
                  <div class="form-group">
                    <label for="pwd">Company Name *</label>
                    <input class="form-control" placeholder="Company" name="txtCompany" type="text" value="<?php echo $dataCompany; ?>" maxlength="100" required="required" />
                  </div>
                  <div class="form-group">
                    <label >Status</label>
                    <select name="txtStatus" class="form-control" tabindex="-1">
					<?php
                      
                        $mySql = "SELECT * FROM master_status WHERE status_group='Data' ";
                        $dataQry = mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error()); 
                          while ($dataRow = mysqli_fetch_array($dataQry)) {
                              if ($dataRow['status_name'] == $dataStatus) {
                                        $cek = " selected";
                                    } else { $cek=""; }
                              echo "<option value='$dataRow[status_name]' $cek>$dataRow[status_name]</option>";
                          }
                    ?>                                               
                     </select> 
                  </div>
                  <div class="form-group">
                    <label for="pwd">NPWP *</label>
                    <input class="form-control" placeholder="NPWP" name="txtNPWP" type="text" value="<?php echo $dataNPWP; ?>" maxlength="20"  required="required" />
                  </div>
              </div>  
              <div class="col-sm-4">
              		<div class="form-group">
                    <label for="pwd">Contact *</label>
                    <input class="form-control" placeholder="Name Contact" name="txtContact" type="text" value="<?php echo $dataContact; ?>" maxlength="100" required="required" />
                  </div>
                  <div class="form-group">
                    <label for="pwd">Phone *</label>
                    <input class="form-control" placeholder="Phone" name="txtPhone" type="text" value="<?php echo $dataPhone; ?>" maxlength="100" required="required" />
                  </div>
                   <div class="form-group">
                    <label for="pwd">Fax *</label>
                    <input class="form-control" placeholder="Fax" name="txtFax" type="text" value="<?php echo $dataFax; ?>" maxlength="100"  required="required" />
                  </div>
                  <div class="form-group">
                    <label for="pwd">Email *</label>
                    <input class="form-control" placeholder="Email" name="txtEmail" type="text" value="<?php echo $dataEmail; ?>" maxlength="100" required="required" />
                  </div>
              </div>
              <div class="col-sm-4">
              	  <div class="form-group">
                    <label>Address *</label>
                    <textarea class="form-control" placeholder="Address" name="txtAddress"  rows="3" id="comment"><?php echo $dataAddress; ?></textarea>
                 </div>
                 <div class="form-group">
                    <label for="pwd">City *</label>
                    <input class="form-control" placeholder="City" name="txtCity" type="text" value="<?php echo $dataCity; ?>" maxlength="100" required="required" />
                  </div>
              </div>                
               <div class="col-xs-12">
                  <div class="ln_solid"></div>
                  <div class="col-xs-6" align="left">
                  	<a href="?page=Company" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
                  	<button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-check-square-o fa-fw"></i> Submit</button>
                  </div>
                  <div class="col-xs-6" align="right">
                  	Last updated : <?php echo $myData['updated_by']; ?> ( <?php echo $myData['updated_date']; ?> )
                  </div>
              </div>            
          </div><!-- /x_content -->
          
        </div><!-- /x_panel -->
      </div>
    </div><!-- /row -->
</div>        
<!-- /page content -->
 </form>
<?php
include "footer.php";
?>
            





  
