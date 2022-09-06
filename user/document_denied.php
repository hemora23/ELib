<?php
include_once "library/inc.seslogin.php";
include "header.php";
?>
<!-- page content -->
        <div class="right_col" role="main">
         <div class="">
            <div class="clearfix"></div>

<?php
$id	= isset($_GET['id']) ?  $_GET['id'] : '';
if ($id=="Document") {
	if ($lang=="id") {
		$pesan_tampil = "Akses dokumen ditolak, Anda perlu izin untuk mengakses dokumen ini";
	} else {
		$pesan_tampil = "Document access denied, you need permission to access this document";
	}
} else {
	if ($lang=="id") {
		$pesan_tampil = "Akses file ditolak, Anda perlu izin untuk mengakses file ini";
	} else {
		$pesan_tampil = "File access denied, you need permission to access this file";
	}
}

echo "<div class='alert alert-warning' align='center'>";
echo "&nbsp;&nbsp; $pesan_tampil<br>";	
echo "</div>"; 

?>

         

        

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <div class="x_content">
                    <ul class="nav navbar-left">
                    	 
                    </ul>
                   <ul class="nav navbar-right">
                      	<a href="<?php if ($id=="Document") {echo $_SESSION['SES_BACK'];} else {echo $_SESSION['SES_PAGE'];}?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> <?php echo _BACK; ?></a>
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="x_content table-responsive"> 
                  <!-- content -->
                  <div class="">
                  	
                        
				 </div>
                 <div class="">	
						
                                      
                   </div>
                  <!-- content -->
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


