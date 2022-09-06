<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Document-Link";

?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Document Link</small></h3>
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
                  		<h2>Data </h2>
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
                                            <th>Doc ID.</th> 
                                            <th>Doc Title</th>
                                            <th>File Name</th>
                                            <th>Link</th>
                                            <th>Updated By</th>
                                            <th>Updated Date</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									
									$mySql 	= "SELECT * FROM view_document_link ORDER BY updated_date desc";
									
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['document_link_id'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['document_id']; ?></td>
                                            <td><?php echo $myData['document_title_id']; ?></td>
                                            <td><?php echo $myData['document_file_title']; ?></td>
                                            <td><a href="<?php echo $myData['document_link']; ?>" target="_blank"><?php echo $myData['document_link']; ?></a></td>
                                            <td><?php echo $myData['updated_by']; ?></td>
                                            <td><?php echo $myData['updated_date']; ?></td>
                                             <td>
                                            
                                            <a href="?page=Document-Link-Delete&id=<?php echo $Code; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
                                            
                                            </td>
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


