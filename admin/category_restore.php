<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Category";
?>
<div class="right_col" role="main">
   
<?php        
# Tombol cancel
if(isset($_POST['btnCancel'])){
	echo "<meta http-equiv='refresh' content='0; url=?page=Category'>";
}
# Tombol Submit diklik
if(isset($_POST['btnSubmit'])){
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	
	
	
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtDate		 = $_POST['txtDate'];
	

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
		
		
		$ses_nama	= $_SESSION['SES_NAMA'];
		$mySql  	= "DELETE FROM master_category WHERE 1=1";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());		
		$mySql  	= "INSERT INTO master_category (id, category_id, category_level_1, category_level_2, category_level_3,
						category_level_4,category_level_5,category_level_6, updated_by ,updated_date)
						(select  id, category_id, category_level_1, category_level_2, category_level_3,
						category_level_4,category_level_5,category_level_6,'$ses_nama',now() from master_category_archive where category_bulkid='$txtDate')";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Category'>";
		}
		exit;
	}	
} // Penutup Tombol Submit



?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
	<div class="page-title"><!-- page-title -->
      <div class="title_left">
        <h3>Category</h3>
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
            <h2>Restore Data</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->
          
          <div class="x_content "><!-- x_content -->
              <br />
              <div class="col-sm-4">
                  <div class="form-group">
                  <label >Last changes</label>
                             
                             <?php // get the users
								$select_box = "<select name=\"txtDate\" id=\"txtDate\"  class=\"select2_single  form-control\" >
								<option value=\"\"></option>";
								$mySql = "SELECT category_bulkid FROM master_category_archive  group by category_bulkid order by updated_date desc";
								$dataQry = mysqli_query($koneksidb,$mySql) or die ("Error Query".mysqli_error($koneksidb)); 
								$result = mysqli_query($koneksidb,$mySql) or die('Query failed: Could not get list of data : ' . mysqli_error($con)); // query
									while ($row = mysqli_fetch_array($result)) {
											foreach ($row as $key => $value){ ${$key} = $value; }
											$space="";   
											$id = $row['category_bulkid'];
											$name = $row['category_bulkid'];
							
											$select_box .= "<option value=\"$id\">$name</option>";                                               
									}
								$select_box .="</select>";
								echo $select_box;   
							?> 
                    </div>   
                                
                 
              </div>
                         
              <div class="col-xs-12">
                  <div class="ln_solid"></div>
                  <a href="?page=Category" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
                  <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-check-square-o fa-fw"></i> Restore</button>
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
            





  
