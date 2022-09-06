<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Document-Approval";
?>
<div class="right_col" role="main">
   
<?php        

	$pesanError = array();
	$pesanError[] = "dokumen Sedang di review tidak dapat diedit";
	
	if (count($pesanError)>=1 ){
		echo "&nbsp;<div class='alert alert-warning'>";		
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div>"; 
	}

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
            <h2>&nbsp;</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->
          
          <div class="x_content "><!-- x_content -->
                     
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
            





  
