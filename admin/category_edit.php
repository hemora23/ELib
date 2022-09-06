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
	$txtIDOld	 = $_POST['txtIDOld'];
	$txtCode		= $_POST['txtCode'];
	$txtCodeOld		= $_POST['txtCodeOld'];
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
		// Jika tidak menemukan error, simpan data ke database
		$kodeBaru	= $_POST['txtCode'];
		$ses_nama	= $_SESSION['SES_NAMA'];
		if ($txtIDOld < $txtID) {
			$mySql  	= "UPDATE master_category SET id=id-1 WHERE id > '$txtIDOld' and id <= $txtID ";
			$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		}
		if ($txtIDOld > $txtID) {
			$mySql  	= "UPDATE master_category SET id=id+1 WHERE id >= '$txtID' and id < $txtIDOld ";
			$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		}
		
		$mySql  	= "UPDATE master_category SET id='$txtID' ,category_id='$txtCode', category_level_1='$txtCategory1', category_level_2='$txtCategory2',category_level_3='$txtCategory3',category_level_4='$txtCategory4',category_level_5='$txtCategory5',category_level_6='$txtCategory6', updated_by='$ses_nama'   , updated_date=now() WHERE id = '$txtIDOld' and category_id='$txtCodeOld'";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Category'>";
		}
		exit;
	}	
} // Penutup Tombol Submit
$ID		= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtID']; 
$Code	= isset($_GET['id2']) ?  $_GET['id2'] : $_POST['txtCode']; 
$mySql	= "SELECT * FROM master_category WHERE id='$ID' and category_id='$Code'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
# MASUKKAN DATA KE VARIABEL
$dataCode		= $myData['category_id'];
$dataID			= $myData['id'];
$dataCategory1	= isset($_POST['txtCategory1']) ? $_POST['txtCategory1'] : $myData['category_level_1'];
$dataCategory2	= isset($_POST['txtCategory2']) ? $_POST['txtCategory2'] : $myData['category_level_2'];
$dataCategory3	= isset($_POST['txtCategory3']) ? $_POST['txtCategory3'] : $myData['category_level_3'];
$dataCategory4	= isset($_POST['txtCategory4']) ? $_POST['txtCategory4'] : $myData['category_level_4'];
$dataCategory5	= isset($_POST['txtCategory5']) ? $_POST['txtCategory5'] : $myData['category_level_5'];
$dataCategory6	= isset($_POST['txtCategory6']) ? $_POST['txtCategory6'] : $myData['category_level_6'];
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
            <h2>Edit Data</h2>
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
                    <input class="form-control" name="txtIDOld" type="hidden" value="<?php echo $dataID; ?>"   />
                  </div>   
                   <div class="form-group">
                    <label >Code</label>
                    <input class="form-control" name="txtCode" type="text" value="<?php echo $dataCode; ?>"  maxlength="10" />
                    <input class="form-control" name="txtCodeOld" type="hidden" value="<?php echo $dataCode; ?>"  maxlength="10" />
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
                  <div class="col-xs-6" align="left">
                  	<a href="?page=Category" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
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
            





  
