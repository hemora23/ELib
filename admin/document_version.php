<?php
$_SESSION['SES_TITLE'] = "Document Version";
include_once "library/inc.seslogin.php";
include "header.php";


?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Document <small></small></h3>
              </div>
              <div class="title_right">
              	<div class="form-group pull-right">
                	
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="col-xs-9">
                  		<h2>Data Version History</h2> 
                    </div>
                    <div class="col-xs-3">
                    <ul class="nav navbar-right panel_toolbox">
                     <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Doc. ID.</th> 
                                            <th>Ver. No.</th> 
                                             <th>Status</th> 
                                            <th>Updated By</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									
									$mySql 	= "SELECT document_id, document_date, document_status, document_version, updated_by, updated_date FROM document
									WHERE document_id='".$_GET['id']."' ORDER BY document_version, updated_date";
									
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['document_id'];
										$Version = $myData['document_version'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><a href="?page=Document-View&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>"  alt="View Data"><u><?php echo $myData['document_id']; ?></u></a></td>
                                            <td><?php echo $myData['document_version']; ?></td>
                                            <td><?php echo $myData['document_status']; ?></td>
                                            <td><?php echo $myData['updated_by']; ?></td>
                                            <td><?php echo $myData['updated_date']; ?></td>
                                            
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


