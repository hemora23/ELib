<?php
include_once "library/inc.seslogin.php";
include "header.php";

?>
<div class="right_col" role="main">
   
<?php        
# Tombol cancel
if(isset($_POST['btnCancel'])){
	echo "<meta http-equiv='refresh' content='0; url=?page=Approval'>";
}
# Tombol Submit diklik
if(isset($_POST['btnSubmit'])){
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($_POST['txtApproval'])=="") {
		$pesanError[] = "Data <b>Approval</b> tidak boleh kosong !";		
	}
	
	
			
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtApproval= strtoupper($_POST['txtApproval']);
	$txtApprovalAs= strtoupper($_POST['txtApprovalAs']);
	$txtUser= $_POST['txtUser'];
	$txtNumber= $_POST['txtNumber'];	
	$txtStatus = $_POST['txtStatus'];
	
	


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
		$mySql  	= "UPDATE master_approval SET approval_name='$txtApproval', approval_number='$txtNumber', approval_as='$txtApprovalAs', approval_user_id='$txtUser', approval_status='$txtStatus',  updated_by='$ses_nama'   , updated_date=now() WHERE approval_id = '$kodeBaru'";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Approval'>";
		}
		exit;
	}	
} // Penutup Tombol Submit

$Code	= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtCode']; 
$mySql	= "SELECT * FROM master_approval WHERE approval_id='$Code'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
# MASUKKAN DATA KE VARIABEL

$dataApproval	= isset($_POST['txtApproval']) ? $_POST['txtApproval'] : $myData['approval_name'];
$dataNumber	= isset($_POST['txtNumber']) ? $_POST['txtNumber'] : $myData['approval_number'];
$dataApprovalAs = isset($_POST['txtApprovalAs']) ? $_POST['txtApprovalAs'] : $myData['approval_as'];
$dataUser =isset($_POST['txtUser']) ? $_POST['txtUser'] : $myData['approval_user_id'];
$dataStatus	= isset($_POST['txtStatus']) ? $_POST['txtStatus'] : $myData['approval_status'];

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
	<div class="page-title"><!-- page-title -->
      <div class="title_left">
        <h3>Approval</h3>
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
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class=""><i class="fa fa-wrench"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->
          
          <div class="x_content "><!-- x_content -->
              <br />
              <div class="col-sm-4">                                
                  <div class="form-group">
                    <label for="pwd">Approval Name *</label>
                    <input class="form-control" placeholder="Approval Description" name="txtApproval" type="text" value="<?php echo $dataApproval; ?>" maxlength="255" required="required" />
                    <input class="form-control" name="txtCode" type="hidden" value="<?php echo $Code; ?>" readonly="readonly"/>
                  </div>
                   <div class="form-group">
                    <label for="pwd">Sequence *</label>
                    <input class="form-control" placeholder="Ordinal" name="txtNumber" type="number" value="<?php echo $dataNumber; ?>"  required="required" />
                  </div>
                  
              </div>  
              <div class="col-sm-4">
              		
                   <div class="form-group">
                    <label for="pwd">Responsible as *</label>
                    <input class="form-control" placeholder="Approval Responsible as" name="txtApprovalAs" type="text" value="<?php echo $dataApprovalAs; ?>" maxlength="255" required="required" />
                  </div>
                  <div class="form-group">
                    <label >Approver Name *</label>
                    <select name="txtUser" class="select2_single form-control" tabindex="-1">
					<?php
                      
                        $mySql = "SELECT * FROM master_user Order by user_fullname ";
                        $dataQry = mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error()); 
                          while ($dataRow = mysqli_fetch_array($dataQry)) {
                              if ($dataRow['user_id'] == $dataUser) {
                                        $cek = " selected";
                                    } else { $cek=""; }
                              echo "<option value='$dataRow[user_id]' $cek>$dataRow[user_fullname] / $dataRow[user_id]</option>";
                          }
                    ?>                                               
                     </select> 
                  </div>
              </div>
              <div class="col-sm-4">
              	 <div class="form-group">
                    <label >Status *</label>
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
              </div>                
               <div class="col-xs-12">
                  <div class="ln_solid"></div>
                  <div class="col-xs-6" align="left">
                  	<a href="?page=Approval" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
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
            





  
