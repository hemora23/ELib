<?php
include_once "library/inc.seslogin.php";
include "header.php";

?>
<div class="right_col" role="main">
<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Code pada URL (alamat browser)

$Code	= isset($_GET['id']) ?  $_GET['id'] : ''; 
$Version	= isset($_GET['v']) ?  $_GET['v'] : ''; 
$mySql	= "SELECT * FROM document WHERE document_id='$Code' and document_version='$Version'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$dataCode		= $myData['document_id'];
$dataVersion	= $myData['document_version'];
$dataExpireDate = date('Y-m-d', strtotime('+1 year', strtotime($myData['document_expire_date'])) );

if(isset($_POST['btnSubmit'])){
	$dataExpireDate	= $_POST['txtExpireDate'];
	$mySql = "UPDATE document SET document_expire_date = '$dataExpireDate' WHERE document_id='$dataCode' and document_version='$dataVersion'";
	$myQry = mysqli_query($koneksidb,$mySql) or die ("Error ".mysqli_error());
	if($myQry){
		echo "<meta http-equiv='refresh' content='0; url=?page=Document-Expiration'>";
	}
}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
	<div class="page-title"><!-- page-title -->
      <div class="title_left">
        <h3>Expired Document <small>(3 months before expiry date)</small></h3>
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
                        <label >Expire Date *</label>
                        <input id='tanggal'  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtExpireDate" type="text" value="<?php echo $dataExpireDate; ?>" required="required" />
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