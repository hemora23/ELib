<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Document-Files-Privileges";
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>File Privileges<small></small></h3>
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
                                            <th>Title</th>
                                            <th>File</th>
                                            <th>Division</th>
                                            <th>Department</th>
                                            <th>Unit</th>
                                            <th>Employee</th>
                                            <th>Updated By</th>
                                            <th>Updated Date</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "SELECT * FROM view_document_files_privileges order by updated_date desc";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$ID = $myData['id'];
										$Code = $myData['document_id'];
										
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td> 
                                            <td><?php echo $myData['document_id']; ?></td>
                                            
                                            <td><?php echo $myData['document_title_id']; ?></td>
                                            <td><?php echo $myData['document_file_title']; ?></td>
                                             <td><?php echo $myData['division']; ?></td>
                                            <td><?php echo $myData['department']; ?></td>
                                            <td><?php echo $myData['unit']; ?></td>
                                            <td><?php echo $myData['user_id'].' '.$myData['user_fullname']; ?></td>
                                            <td><?php echo $myData['updated_by']; ?></td>
                                            <td><?php echo $myData['updated_date']; ?></td>
                                            <td><a href="?page=Document-Privileges-Edit&id=<?php echo $Code; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a></td>
                                            
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


