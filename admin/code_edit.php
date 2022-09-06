<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Code";
?>
<div class="right_col" role="main">
   
<?php        
# Tombol cancel
if(isset($_POST['btnCancel'])){
	echo "<meta http-equiv='refresh' content='0; url=?page=Code'>";
}
# Tombol Submit diklik
if(isset($_POST['btnSubmit'])){
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($_POST['txtCode'])=="") {
		$pesanError[] = "Data <b>Code</b> tidak boleh kosong !";		
	}
	
	
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtCode= $_POST['txtCode'];
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
		
		$kode	=  preg_replace("/[^a-zA-Z0-9]/", "", $_GET['id']);
		$ses_nama	= $_SESSION['SES_NAMA'];
		$mySql  	= "UPDATE master_code SET code_name='$txtCode', code_table='$txtGroup',  updated_by='$ses_nama'   , updated_date=now() WHERE code_id = '$kode'";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Code'>";
		}
		exit;
	}	
} // Penutup Tombol Submit

$Code	= isset($_GET['id']) ?  preg_replace("/[^a-zA-Z0-9]/", "", $_GET['id']) : ''; 
$mySql	= "SELECT * FROM master_code WHERE code_id='$Code'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
# MASUKKAN DATA KE VARIABEL

$dataCode	= isset($_POST['txtCode']) ? $_POST['txtCode'] : $myData['code_name'];
$dataGroup	= isset($_POST['txtGroup']) ? $_POST['txtGroup'] : $myData['code_table'];

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
	<div class="page-title"><!-- page-title -->
      <div class="title_left">
        <h3>Code</h3>
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
              <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->
          
          <div class="x_content "><!-- x_content -->
              <br />
              <div class="col-sm-6">
                                  
                  <div class="form-group">
                    <label for="pwd">Code *</label>
                    <input class="form-control" placeholder="Code" name="txtCode" type="text" value="<?php echo $dataCode; ?>" maxlength="50" required="required" />
                  </div>
                 
              </div>  
              <div class="col-sm-6">
              		<div class="form-group">
                    <label for="pwd">Table *</label>
                    <input class="form-control" placeholder="Group Code" name="txtGroup" type="text" value="<?php echo $dataGroup; ?>" maxlength="50" required="required" />
                  </div>
                 
              </div>
                             
               <div class="col-xs-12">
                  <div class="ln_solid"></div>
                  <div class="col-xs-6" align="left">
                  	<a href="?page=Code" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
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
            





  
