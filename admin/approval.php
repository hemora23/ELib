<?php
include_once "library/inc.seslogin.php";
include "header.php";


?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Approval <small></small></h3>
              </div>
              <div class="title_right">
              	<div class="form-group pull-right">
                	<a href="?page=Approval-Add" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus-square fa-fw"></i> Add New Data</a>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="" ><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                    
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Approval</th> 
                                            <th>Sequence</th>                                            
                                            <th>Responsible as</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "SELECT * FROM view_master_approval order by approval_name, approval_number ";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['approval_id'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['approval_name']; ?></td>
                                            <td><?php echo $myData['approval_number']; ?></td>
                                            <td><?php echo $myData['approval_as']; ?></td>
                                            <td><?php echo $myData['user_fullname']; ?></td>                                            
                                            <td style="color:<?php if ($myData['approval_status']=="Not Active") {echo "#FF0000";} ?>" ><?php echo $myData['approval_status']; ?></td>
                                            <td><a href="?page=Approval-Edit&id=<?php echo $Code; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a></td>
                                            <td><a href="?page=Approval-Delete&id=<?php echo $Code; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
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


