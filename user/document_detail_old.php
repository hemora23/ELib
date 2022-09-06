<?php
include_once "library/inc.seslogin.php";
include "header.php";
$User =$_SESSION['SES_USERID'];
$Code	= isset($_GET['id']) ?  $_GET['id'] : ''; 
$_SESSION['SES_PAGE']="?page=Document-Detail&id=".$Code;

$mySql	= "select * from view_document_user where document_id='$Code'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
//if ($myData['category_level_1']!='') { $level1=$myData['category_level_1']; } else { $level1='';};
//if ($myData['category_level_2']!='') { $level2=' / '.$myData['category_level_2']; } else { $level2='';};
//if ($myData['category_level_3']!='') { $level3=' / '.$myData['category_level_3']; } else { $level3='';};
//if ($myData['category_level_4']!='') { $level4=' / '.$myData['category_level_4']; } else { $level4='';};
//if ($myData['category_level_5']!='') { $level5=' / '.$myData['category_level_5']; } else { $level5='';};
//if ($myData['category_level_6']!='') { $level6=' / '.$myData['category_level_6']; } else { $level6='';};
//$category = $level1.$level2.$level3.$level4.$level5.$level6;
$level1 = $myData['category_level_1'];
$level2 = $myData['category_level_2'];
$category = $myData['category_level_2'];
$ID = $myData['document_id'];
$version = $myData['document_version'];
$Title = $myData['document_title_'.$lang];
$Date = date_format(new DateTime($myData['document_date']),"d F Y");
$Key = $myData['document_keyword'];
$Desc = $myData['document_description_'.$lang];	
$UpdatedDate = date_format(new DateTime($myData['updated_date']),"d F Y, H:i:s");
$UpdatedBy = $myData['updated_by'];	
$_SESSION['SES_DOCUMENTID']=$myData['document_id'];	
$_SESSION['SES_DOCUMENT_VERSION']=$myData['document_version'];

?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $category ?></h3>
              </div>
              <div class="title_right">
              	<div class="form-group pull-right">
                	<h6><a href="?page=Main" ><i class="fa fa-home"> <?php echo _HOME ?></i></a> / <?php echo $level1 ?> / <a href="?page=Document&id=<?php echo $level2; ?>&id2=<?php echo $level1; ?>" ><?php echo $level2 ?></a></h6>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <div class="x_content">
                    <ul class="nav navbar-left">
                    	 <?php 
												$mySqlf	= "SELECT id FROM document_favourite WHERE document_id='$Code' and user_id='$User'";
												$myQryf	= mysqli_query($koneksidb,$mySqlf)  or die ("Query ambil data salah : ".mysqli_error());
												$myDataf = mysqli_fetch_array($myQryf);
												if ($myDataf['id']=="") {
													echo "<a href='?page=Document-Favourite-Add&id=$Code' class='btn btn-default btn-sm' target='_self' title='"._ADDTOFAVOURITE."'><img src='images/fav0.png'  />&nbsp;&nbsp;&nbsp;"._ADDTOFAVOURITE."</a>";
													} 
													else {
														echo "<a href='?page=Document-Favourite-Delete&id=$Code' class='btn btn-default btn-sm' target='_self' title='"._DELETEFROMFAVOURITE."'><img src='images/fav1.png'  />&nbsp;&nbsp;&nbsp;"._DELETEFROMFAVOURITE."</a>";
														}
											 ?>
                    </ul>
                   <ul class="nav navbar-right">
                      	<a href="<?php echo $_SESSION['SES_BACK'];?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> <?php echo _BACK; ?></a>
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="x_content table-responsive"> 
                  <!-- content -->
                  <div class="">
                  		
                    	<h5><?php echo $Date; ?></h5>
                        
                    	<H3 style="color:#009999"><?php echo $Title; ?></H3>
                        <p align="justify"><?php echo $Desc; ?></p><br><br>
                        
				 </div>
                 <div class="">	
						<table id="datatable-responsive-x" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                    <?php
									$mySql 	= "SELECT * FROM document_files where document_id='$ID' and document_version='$version' order by document_order";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['document_file_name'];
										$_SESSION['SES_DOCUMENT_FILE']=$myData['document_file_title'];		
										
									?>
                                    <div class="col-sm-3" align="left">
                                    	
                                      		<a href="?page=Document-Viewer&id=<?php echo $myData['document_id']; ?>&v=<?php echo $myData['document_version']; ?>&doc=<?php echo $myData['document_file_title']; ?>&hal=1" ><img src="images/pdf.png"  height="30" longdesc="#"></a><br /><br />
                                         
                                      		<a href="?page=Document-Viewer&id=<?php echo $myData['document_id']; ?>&v=<?php echo $myData['document_version']; ?>&doc=<?php echo $myData['document_file_title']; ?>&hal=1" ><u><?php echo $myData['document_file_title']; ?></a></u>&nbsp;&nbsp;<?php echo $myData['document_size']; ?><br /><br />
                                      	
                                    </div>
                                   
                                        
                                        <?php } ?>
                                      
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


