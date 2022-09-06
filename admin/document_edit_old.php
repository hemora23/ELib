<?php
include_once "library/inc.seslogin.php";
include "header.php";

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
	if (trim($_POST['txtCategory'])=="") {
		$pesanError[] = "<b>Category</b> data can not be empty !";		
	}
	
	
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	
	
	$dataVersion	= $_POST['txtVersion'];
	$dataVersionOld	= $_POST['txtVersionOld'];
	$dataCategory	= $_POST['txtCategory'];
	$dataDate		= $_POST['txtDate'];
	$dataExpireDate	= $_POST['txtExpireDate'];
	$dataKeyword	= $_POST['txtKeyword'];
	$dataTitleID	= $_POST['txtTitleID'];
	$dataTitleEN	= $_POST['txtTitleEN'];
	$dataDescID		= $_POST['txtDescID'];
	$dataDescEN		= $_POST['txtDescEN'];
	$dataStatus		= 'Updated'; //$_POST['txtStatus'];
	$dataCode		= $_POST['txtCode'];
	$dataChange		= $_POST['txtChange'];

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
		if ($dataStatus		!= "Created") {
		$mySql  	= "INSERT INTO document_archive (select * from document where document_id='$dataCode' and document_version='$dataVersionOld')";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		}
		$mySql  	= "UPDATE document  SET category_id='$dataCategory',document_version='$dataVersion',document_title_id='$dataTitleID',
						document_description_id='$dataDescID',document_title_en='$dataTitleEN', document_description_en='$dataDescEN',
						document_keyword='$dataKeyword', document_status='$dataStatus', document_date='$dataDate', 
						document_expire_date='$dataExpireDate', document_change_history='$dataChange', updated_by='$ses_nama', 
						updated_date=now()
						WHERE document_id='$dataCode' and document_version='$dataVersionOld'";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		
		$mySql  	= "INSERT INTO document_status (document_id, document_version, document_status, updated_by, updated_date)
						VALUES ('$dataCode','$dataVersion','Updated','$ses_nama',now())";
		$myQry=mysqli_query($koneksidb,$mySql) or die ("Error query ".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Document-Files&id=".$dataCode."&v=".$dataVersion."'>";
		}
		exit;
	}	
} // Penutup Tombol Submit


# MASUKKAN DATA KE VARIABEL
$Code	= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtCode']; 
$mySql	= "SELECT * FROM document WHERE document_id='$Code'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$dataCode		= $myData['document_id'];
$dataStatus		= $myData['document_status'];
$dataVersionOld	= $myData['document_version'];
if ($dataStatus	== "Created" || $dataStatus	== "Updated") {
	$dataVersion	= $myData['document_version'];
} else {
	$dataVersion	= $myData['document_version']+1;
}
$dataCategory	= $myData['category_id'];
$dataDate		= $myData['document_date'];
$dataExpireDate	= $myData['document_expire_date'];
$dataKeyword	= $myData['document_keyword'];
$dataTitleID	= $myData['document_title_id'];
$dataTitleEN	= $myData['document_title_en'];
$dataDescID		= $myData['document_description_id'];
$dataDescEN		= $myData['document_description_en'];
$dataChange		= '';

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
	<div class="page-title"><!-- page-title -->
      <div class="title_left">
        <h3>Document</h3>
      </div>
      <div class="title_right">
        <div class="form-group pull-right top_search">
        	<a href="?page=Document" class="btn btn-info btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
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
              <div class="row">             
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label >Document ID</label>
                        <input class="form-control" name="txtCode" type="text" value="<?php echo $dataCode; ?>"  maxlength="10" readonly="readonly"/>
                      </div> 
                  </div>
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label >Ver.</label>
                        <input class="form-control" name="txtVersion" type="text" value="<?php echo $dataVersion; ?>"  maxlength="1" readonly="readonly"/>
                        <input class="form-control" name="txtVersionOld" type="hidden" value="<?php echo $dataVersionOld; ?>"  />
                      </div> 
                  </div>
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label >Document Date *</label>
                        <input id='tanggal'  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDate" type="text" value="<?php echo $dataDate; ?>" maxlength="20" required="required" />
                      </div>
                  </div>
                  <div class="col-lg-3">
                       <div class="form-group">
                        <label >Status</label>
                        <input class="form-control" name="txtStatus" type="text" value="<?php echo $dataStatus; ?>"  maxlength="1" readonly="readonly"/>
                       
                      </div>
                  </div>
              </div>
              <div class="row"> 
              	<div class="col-lg-6">
              	  <div class="form-group">
                    <label >Categories *</label>
                    <select name="txtCategory" class="select2_single form-control" required>
                    
					<?php
                      
                        $mySql = "SELECT * FROM master_category Order by id ";
                        $dataQry = mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error()); 
						  echo '<option value=""></option>';
                          while ($dataRow = mysqli_fetch_array($dataQry)) {
							 	if ($dataRow['category_level_2'] != '') {$dataCategory2='| '.$dataRow['category_level_2']; } else {$dataCategory2='';};
								if ($dataRow['category_level_3'] != '') {$dataCategory3='| '.$dataRow['category_level_3']; } else {$dataCategory3='';};
								if ($dataRow['category_level_4'] != '') {$dataCategory4='| '.$dataRow['category_level_4']; } else {$dataCategory4='';};
								if ($dataRow['category_level_5'] != '') {$dataCategory5='| '.$dataRow['category_level_5']; } else {$dataCategory5='';};
								if ($dataRow['category_level_6'] != '') {$dataCategory6='| '.$dataRow['category_level_6']; } else {$dataCategory6='';};
                              if ($dataRow['category_id'] == $dataCategory) {
                                        $cek = " selected";
                                    } else { $cek=""; }
                              echo "<option value='$dataRow[category_id]' $cek>$dataRow[category_level_1] $dataCategory2 $dataCategory3 $dataCategory4 $dataCategory5 $dataCategory6</option>";
                          }
                    ?>                                               
                     </select> 
                  </div>
                </div>  
              	<div class="col-lg-3">
              	   <div class="form-group">
                        <label >Expire Date *</label>
                        <input id='tanggal2'  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtExpireDate" type="text" value="<?php echo $dataExpireDate; ?>" required="required" />
                    </div>
              	</div>
                <div class="col-lg-3">
              	  <div class="form-group">
                    <label >Keyword</label>
                    <input class="form-control" placeholder="Keyword" name="txtKeyword" type="text" value="<?php echo $dataKeyword; ?>" maxlength="255"  />
                  </div>
              	</div>
              </div>
              <div class="row"> 
              	<div class="col-lg-6">
              	  <div class="form-group">
                    <label >Title (Bahasa) *</label>
                    <input class="form-control" placeholder="Title (Bahasa)" name="txtTitleID" type="text" value="<?php echo $dataTitleID; ?>" maxlength="255"  required="required" />
                  </div>	
              	  <div class="form-group">
                    <label>Description (Bahasa)</label>
                    <textarea class="form-control" placeholder="Description (Bahasa)" name="txtDescID"  rows="5" ><?php echo $dataDescID; ?></textarea>
                 </div>
              	</div>
              	<div class="col-lg-6">
              	  <div class="form-group">
                    <label >Title (English) *</label>
                    <input class="form-control" placeholder="Title (English)" name="txtTitleEN" type="text" value="<?php echo $dataTitleEN; ?>" maxlength="255"  required="required" />
                  </div>	
              		<div class="form-group">
                    <label>Description (English)</label>
                    <textarea class="form-control" placeholder="Description (English)" name="txtDescEN"  rows="5" ><?php echo $dataDescID; ?></textarea>
                 </div>
             	</div>
              </div>
              <div class="row">
              <div class="col-lg-12">
              	  <div class="form-group">
                    <label >Change History *</label>
                    <input class="form-control" placeholder="Change History Desciption" name="txtChange" type="text" value="<?php echo $dataChange; ?>" maxlength="255" required="required" />
                  </div>
              	</div>
              </div>
              
              <div class="row">
                  <div class="col-lg-12">
                      <div class="ln_solid"></div>
                      <a href="?page=Category" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
                      <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-check-square-o fa-fw"></i> Submit</button>
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
            





  
