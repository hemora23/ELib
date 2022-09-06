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
	if (trim($_POST['txtCategory1'])=="") {
		$pesanError[] = "Data <b>Category</b> tidak boleh kosong !";		
	}
	
	
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtID		 = $_POST['txtID'];
	$txtCategory1= $_POST['txtCategory1'];
	$txtCategory2= $_POST['txtCategory2'];
	$txtCategory3= $_POST['txtCategory3'];
	$txtCategory4= $_POST['txtCategory4'];
	$txtCategory5= $_POST['txtCategory5'];
	$txtCategory6= $_POST['txtCategory6'];
	

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
		
		$mySql	= "SELECT * FROM master_code WHERE code_table='master_category'";
		$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
		$myData = mysqli_fetch_array($myQry);
		$dataCode	= buatCode($myData['code_table'], $myData['code_name']);

		$ses_nama	= $_SESSION['SES_NAMA'];
		$mySql  	= "UPDATE master_category SET id=id+1 WHERE id >= '$txtID'";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());		
		$mySql  	= "INSERT INTO master_category (id, category_id, category_level_1, category_level_2, category_level_3,
						category_level_4,category_level_5,category_level_6, updated_by ,updated_date)
						VALUES ('$txtID','$dataCode','$txtCategory1','$txtCategory2','$txtCategory3', '$txtCategory4', 
						'$txtCategory5', '$txtCategory6', '$ses_nama',now())";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Category'>";
		}
		exit;
	}	
} // Penutup Tombol Submit


# MASUKKAN DATA KE VARIABEL
$mySql	= "SELECT * FROM master_code WHERE code_table='master_category'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$dataCode	= buatCode($myData['code_table'], $myData['code_name']);
$mySql	= "SELECT max(id)+1 as maxid FROM master_category";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$dataID	= isset($_GET['id']) ?  $_GET['id'] : $myData['maxid']; 
$dataCategory1	= isset($_GET['c1']) ?  $_GET['c1'] : ''; 
$dataCategory2	= isset($_GET['c2']) ?  $_GET['c2'] : ''; 
$dataCategory3	= isset($_GET['c3']) ?  $_GET['c3'] : ''; 
$dataCategory4	= isset($_POST['txtCategory4']) ? $_POST['txtCategory4'] : '';
$dataCategory5	= isset($_POST['txtCategory5']) ? $_POST['txtCategory5'] : '';
$dataCategory6	= isset($_POST['txtCategory6']) ? $_POST['txtCategory6'] : '';
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
            <h2>Add New Data</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->
          
          <div class="x_content "><!-- x_content -->
              <br />
              <div class="col-sm-3">
                  <div class="form-group">
                    <label >No.</label>
                    <input class="form-control" name="txtID" type="number" value="<?php echo $dataID; ?>"  maxlength="10" />
                  </div>   
                   <div class="form-group">
                    <label >Code</label>
                    <input class="form-control" name="txtCode" type="text" value="<?php echo $dataCode; ?>"  maxlength="10" readonly="readonly"/>
                  </div>               
                 
              </div>
              <div class="col-sm-3">
                   <div class="form-group">
                    <label for="pwd">Category 1</label>
                    <input class="form-control" placeholder="Category" name="txtCategory1" type="text" value="<?php echo $dataCategory1; ?>" maxlength="100" required="required" />
                  </div>            
                 	<div class="form-group">
                    <label for="pwd">Category 2</label>
                    <input class="form-control" placeholder="Category" name="txtCategory2" type="text" value="<?php echo $dataCategory2; ?>" maxlength="100"  />
                  </div>
              </div>  
              <div class="col-sm-3">
              		<div class="form-group">
                    <label for="pwd">Category 3</label>
                    <input class="form-control" placeholder="Category" name="txtCategory3" type="text" value="<?php echo $dataCategory3; ?>" maxlength="100"  />
                  </div>
              			<div class="form-group">
                    <label for="pwd">Category 4</label>
                    <input class="form-control" placeholder="Category" name="txtCategory4" type="text" value="<?php echo $dataCategory4; ?>" maxlength="100"  />
                  </div>
              </div>
              <div class="col-sm-3">
              		<div class="form-group">
                    <label for="pwd">Category 5</label>
                    <input class="form-control" placeholder="Category" name="txtCategory5" type="text" value="<?php echo $dataCategory5; ?>" maxlength="100"  />
                  </div>
              			<div class="form-group">
                    <label for="pwd">Category 6</label>
                    <input class="form-control" placeholder="Category" name="txtCategory6" type="text" value="<?php echo $dataCategory6; ?>" maxlength="100"  />
                  </div>
              </div>              
              <div class="col-xs-12">
                  <div class="ln_solid"></div>
                  <a href="?page=Category" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
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
            





  
