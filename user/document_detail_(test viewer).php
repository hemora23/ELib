<?php
include_once "library/inc.seslogin.php";
include "header.php";

$Code	= isset($_GET['id']) ?  $_GET['id'] : ''; 
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
$Title_id = $myData['document_title_id'];
$Title_en = $myData['document_title_en'];	
$Date = date_format(new DateTime($myData['document_date']),"d F Y");
$Key = $myData['document_keyword'];
$Desc_id = $myData['document_description_id'];
$Desc_en = $myData['document_description_en'];		
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
                	<h6><a href="?page=Main" ><i class="fa fa-home"> <?php echo _HOME ?></i></a> / <?php echo $level1 ?> / <?php echo $level2 ?></h6>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <div class="x_content">
                    <ul>
                    </ul>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="" ><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="x_content table-responsive"> 
                  <!-- content -->
                  <div class="">
                    	<h5><?php echo $Date; ?></h5>
                    	<H3 style="color:#009999"><?php echo $Title_id; ?></H3><br><br>
                        <p align="justify"><?php echo $Desc_id; ?></p><br><br>
				 </div>
                 <div class="">	
						
                                    <?php
									$mySql 	= "SELECT * FROM document_files where document_id='$ID' and document_version='$version'";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['document_file_name'];
										$_SESSION['SES_DOCUMENT_FILE']=$myData['document_file_title'];		
										
									?>
                                    <div class="col-sm-3" align="center">
                                      <a href="?page=Document-Viewer&id=<?php echo $myData['id']; ?>&docid=<?php echo $myData['document_id']; ?>" target="_blank"><img src="images/pdf.png"  height="50" longdesc="#"></a><br>
                                      <a href="?page=Document-Viewer&id=<?php echo $myData['id']; ?>&docid=<?php echo $myData['document_id']; ?>" target="_blank"><u><?php echo $myData['document_file_title']; ?></a>
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


