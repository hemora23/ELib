<?php
include_once "library/inc.seslogin.php";
include "header.php";
$Code	= isset($_GET['id']) ?  $_GET['id'] : ''; 
$Code2	= isset($_GET['id2']) ?  $_GET['id2'] : ''; 
$_SESSION['SES_PAGE']="?page=Document-List&id=".$Code."&id2=".$Code2;
$_SESSION['SES_BACK']="?page=Document-List&id=".$Code."&id2=".$Code2;

$mySql	= "SELECT * FROM master_category WHERE category_id='$Code'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
if ($myData['category_level_1']!='') { $level1=$myData['category_level_1']; } else { $level1='';};
if ($myData['category_level_2']!='') { $level2=' / '.$myData['category_level_2']; } else { $level2='';};
if ($myData['category_level_3']!='') { $level3=' / '.$myData['category_level_3']; } else { $level3='';};
if ($myData['category_level_4']!='') { $level4=' / '.$myData['category_level_4']; } else { $level4='';};
if ($myData['category_level_5']!='') { $level5=' / '.$myData['category_level_5']; } else { $level5='';};
if ($myData['category_level_6']!='') { $level6=' / '.$myData['category_level_6']; } else { $level6='';};
$category = $level1.$level2.$level3.$level4.$level5.$level6;
					
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $Code ?></h3>
              </div>
              <div class="title_right">
              	<div class="form-group pull-right">
                	<h6><a href="?page=Main" ><i class="fa fa-home"></i> <?php echo _HOME ?></i></a></a> / <?php echo $Code2; ?> / <a href="?page=Document&id=<?php echo $Code; ?>&id2=<?php echo $Code2; ?>" ><?php echo $Code; ?></a></h6>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <div class="x_content">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-sm" type="button" aria-expanded="false"><?php echo _SELECT.' '._CATEGORY ?><span class="caret"></span>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                      <li><a href="?page=Document-List&id=<?php echo $Code ?>&id2=<?php echo $Code2 ?>"><?php echo _ALL.' '._CATEGORY ?></a></li>
                      <?php
					$mySql 	= "SELECT category_id, category_level_1,category_level_2,category_level_3,category_level_4,category_level_5, category_level_6 
FROM view_document_user where category_level_2='$Code' and category_level_1='$Code2' 
group by category_level_1,category_level_2,category_level_3,category_level_4,category_level_5, category_level_6 
order by id";
					$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
					
					while ($myData = mysqli_fetch_array($myQry)) {
						$dataCategoryID=$myData['category_id'];
						$dataCategory1=$myData['category_level_1'];
						if ($myData['category_level_2'] != '') {$dataCategory2=' / '.$myData['category_level_2']; } else {$dataCategory2='';};
						if ($myData['category_level_3'] != '') {$dataCategory3=''.$myData['category_level_3']; } else {$dataCategory3='';};
						if ($myData['category_level_4'] != '') {$dataCategory4=' / '.$myData['category_level_4']; } else {$dataCategory4='';};
						if ($myData['category_level_5'] != '') {$dataCategory5=' / '.$myData['category_level_5']; } else {$dataCategory5='';};
						if ($myData['category_level_6'] != '') {$dataCategory6=' / '.$myData['category_level_6']; } else {$dataCategory6='';};
						$Category = $dataCategory3.$dataCategory4.$dataCategory5.$dataCategory6;
						echo "<li><a href='?page=Document-List&id=$Code&id2=$Code2&ca=$dataCategoryID'>$Category</a></li>";
					}
					?>
                     
                    </ul>
                    <ul class="nav navbar-right">
                    	<a href="?page=Document&id=<?php echo $Code; ?>&id2=<?php echo $Code2; ?>" class="btn btn-default btn-sm" role="button" title="tree view"><img src="images/treeview.png" height="18" /></a>&nbsp;
                        <a href="?page=Document-List&id=<?php echo $Code; ?>&id2=<?php echo $Code2; ?>" class="btn btn-default btn-sm" role="button" title="list view"><img src="images/list.png" height="18" /></a>&nbsp;
                      	<a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> <?php echo _BACK; ?></a>
                    </ul>
                    
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="x_content table-responsive"> 
                  
                    
                                  
                    <table id="datatable-responsive-<?php echo $lang ?>" class="table table-striped  table-hover " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th></th>
                                            <th><?php echo _TITLE ?></th>                                              
                                            <th><?php echo _DATE ?></th>                                        
                                            <th><?php echo _CATEGORY ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$Categoryid	= isset($_GET['ca']) ?  $_GET['ca'] : '';
									$User =$_SESSION['SES_USERID'];
									$mySql 	= "SELECT * FROM view_document_user where category_level_1='$Code2' and category_level_2='$Code' and category_id like '%$Categoryid%' order by document_date desc";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Docid = $myData['document_id'];
										$dataCategory1=$myData['category_level_1'];
										if ($myData['category_level_2'] != '') {$dataCategory2=' / '.$myData['category_level_2']; } else {$dataCategory2='';};
										if ($myData['category_level_3'] != '') {$dataCategory3=''.$myData['category_level_3']; } else {$dataCategory3='';};
										if ($myData['category_level_4'] != '') {$dataCategory4=' / '.$myData['category_level_4']; } else {$dataCategory4='';};
										if ($myData['category_level_5'] != '') {$dataCategory5=' / '.$myData['category_level_5']; } else {$dataCategory5='';};
										if ($myData['category_level_6'] != '') {$dataCategory6=' / '.$myData['category_level_6']; } else {$dataCategory6='';};
										$Category = $dataCategory3.$dataCategory4.$dataCategory5.$dataCategory6;
										
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php 
												$mySqlf	= "SELECT id FROM document_favourite WHERE document_id='$Docid' and user_id='$User'";
												$myQryf	= mysqli_query($koneksidb,$mySqlf)  or die ("Query ambil data salah : ".mysqli_error());
												$myDataf = mysqli_fetch_array($myQryf);
												if ($myDataf['id']=="") {
													echo "<a href='?page=Document-Favourite-Add&id=".$Docid."' target='_self' title='"._ADDTOFAVOURITE."'><img src='images/fav0.png'  /></a>";
													} 
													else {
														echo "<a href='?page=Document-Favourite-Delete&id=".$Docid."' target='_self' title='"._DELETEFROMFAVOURITE."'><img src='images/fav1.png'  /></a>";
														}
											 ?>
                                             
                                             </td>
                                          <td><a title="<?php echo _VIEWDOCUMENT; ?>"  href="?page=Document-Detail&id=<?php echo $Docid; ?>"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;<u><b><?php echo $myData['document_title_'.$lang]; ?></b></u></a></td>    
                                                                                  
                                            <td><?php echo $myData['document_date']; ?></td>                  
                                            <td><?php echo $Category; ?></td> 
                                           
                                        </tr>
                                        <?php } ?>
                                      </tbody>                                                                        
                                </table>
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


