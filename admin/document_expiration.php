<?php
$_SESSION['SES_TITLE'] = "Document Expiration";
include_once "library/inc.seslogin.php";
include "header.php";
$mySql 	= "SELECT status_name FROM master_status where status_group='Document Expiration'";
$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$interval = $myData['status_name'];
$_SESSION['SES_PAGE']="?page=Document-Expiration";
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Expired Document <small>(<?php echo $interval; ?> before expiry date)</small></h3>
              </div>
              <div class="title_right">
              	<div class="form-group pull-right">
                	&nbsp;
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data </h2>
                    <ul class="nav navbar-right panel_toolbox">
                     <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Doc. ID</th>
                                            <th>Ver.</th>                               
                                            <th>Doc. Date</th>
                                            <th>Expire Date</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Extend</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "SELECT * FROM view_document where document_expire_date < DATE(NOW() + INTERVAL $interval) and document_status='Approved' order by  document_expire_date";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['document_id'];
										$Version = $myData['document_version'];
										$dataCategory1=$myData['category_level_1'];
										if ($myData['category_level_2'] != '') {$dataCategory2=' | '.$myData['category_level_2']; } else {$dataCategory2='';};
										if ($myData['category_level_3'] != '') {$dataCategory3=' | '.$myData['category_level_3']; } else {$dataCategory3='';};
										if ($myData['category_level_4'] != '') {$dataCategory4=' | '.$myData['category_level_4']; } else {$dataCategory4='';};
										if ($myData['category_level_5'] != '') {$dataCategory5=' | '.$myData['category_level_5']; } else {$dataCategory5='';};
										if ($myData['category_level_6'] != '') {$dataCategory6=' | '.$myData['category_level_6']; } else {$dataCategory6='';};
										$Category = $dataCategory1.$dataCategory2.$dataCategory3.$dataCategory4.$dataCategory5.$dataCategory6;
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td> 
                                            <td><a href="?page=Document-View&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>"  alt="View Data"><u><?php echo $myData['document_id']; ?></u></a></td>
                                            <td><a href="?page=Document-Version&id=<?php echo $Code;  ?>"  alt="View Data"><u><?php echo $myData['document_version']; ?></u></a></td>                                           
                                            
                                            <td><?php echo $myData['document_date']; ?></td>
                                            <td><?php echo $myData['document_expire_date']; ?></td>
                                            <td><?php echo $myData['document_title_id']; ?></td>
                                            <td><a href="?page=Document-Status&id=<?php echo $Code;  ?>"  alt="View Data"><u><?php echo $myData['document_status']; ?></u></a></td>        
                                            
                                            <td><a href="?page=Document-Expiration-Edit&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO EXTEND THIS DATA?')"><i class="fa fa-calendar fa-fw"></i> Extend</a></td>
                                            <td><a href="?page=Document-Edit&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Update</a></td>
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


