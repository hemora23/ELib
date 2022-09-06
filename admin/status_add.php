<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Status";
?>
<div class="right_col" role="main">
   
<?php        
# Tombol cancel
if(isset($_POST['btnCancel'])){
	echo "<meta http-equiv='refresh' content='0; url=?page=Status'>";
}
# Tombol Submit diklik
if(isset($_POST['btnSubmit'])){
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($_POST['txtStatus'])=="") {
		$pesanError[] = "Data <b>Status</b> tidak boleh kosong !";		
	}
	
	
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtStatus= $_POST['txtStatus'];
	$txtGroup = $_POST['txtGroup'];
	

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
		

		$ses_nama	= $_SESSION['SES_NAMA'];
		$mySql  	= "INSERT INTO master_status (status_name, status_group,  updated_by ,updated_date)
						VALUES ('$txtStatus','$txtGroup','$ses_nama',now())";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Status'>";
		}
		exit;
	}	
} // Penutup Tombol Submit


# MASUKKAN DATA KE VARIABEL


$dataStatus	= isset($_POST['txtStatus']) ? $_POST['txtStatus'] : '';
$dataGroup	= isset($_POST['txtGroup']) ? $_POST['txtGroup'] : '';

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
	<div class="page-title"><!-- page-title -->
      <div class="title_left">
        <h3>Status</h3>
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
            <h2>Add New Data</h2>
            <ul class="nav navbar-right panel_toolbox">
             <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->
          
          <div class="x_content "><!-- x_content -->
              <br />
              <div class="col-sm-6">
                                   
                  <div class="form-group">
                    <label for="pwd">Status *</label>
                    <input class="form-control" placeholder="Status" name="txtStatus" type="text" value="<?php echo $dataStatus; ?>" maxlength="50" required="required" />
                  </div>
                  
              </div>  
              <div class="col-sm-6">
              		<div class="form-group">
                    <label for="pwd">Group Status *</label>
                    <input class="form-control" placeholder="Group Status" name="txtGroup" type="text" value="<?php echo $dataGroup; ?>" maxlength="50" required="required" />
                  </div>
                 
              </div>
             
                             
              <div class="col-xs-12">
                  <div class="ln_solid"></div>
                  <a href="?page=Status" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
                  <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-check-square-o fa-fw"></i> Submit</button>
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
            





  
