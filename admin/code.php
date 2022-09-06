<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Code";
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Code <small></small></h3>
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
                    <h2>Data <small></small></h2>
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
                                            <th>Code</th>                                            
                                            <th>Table</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "SELECT * FROM master_code";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['code_id'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>                                            
                                            <td><?php echo $myData['code_name']; ?></td>
                                            <td><?php echo $myData['code_table']; ?></td>
                                            <td><a href="?page=Code-Edit&id=<?php echo $Code; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a></td>
                                            <td><a href="?page=Code-Delete&id=<?php echo $Code; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
                                        </tr>
                                        <?php } 
										
										?>
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


