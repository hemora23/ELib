<?php
$_SESSION['SES_TITLE'] = "Category";
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Category";
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Category <small></small></h3>
              </div>
              <div class="title_right">
              	<div class="form-group pull-right">
                	<a href="?page=Category-Add" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus-square fa-fw"></i> Add New Data</a>
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
                                            <th>No.</th>
                                            <th>Category ID</th>
                                            <th>Category 1</th>                                            
                                            <th>Category 2</th>
                                            <th>Category 3</th>
                                            <th>Category 4</th>
                                            <th>Category 5</th>
                                            <th>Category 6</th>
                                            <th>Insert</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "SELECT * FROM master_category order by id";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['category_id'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $myData['id']; ?></td> 
                                            <td><?php echo $myData['category_id']; ?></td>                                            
                                            <td><?php echo $myData['category_level_1']; ?></td>
                                            <td><?php echo $myData['category_level_2']; ?></td>
                                            <td><?php echo $myData['category_level_3']; ?></td>
                                            <td><?php echo $myData['category_level_4']; ?></td>
                                            <td><?php echo $myData['category_level_5']; ?></td>
                                            <td><?php echo $myData['category_level_6']; ?></td>
                                            <td><a href="?page=Category-Add&id=<?php echo $myData['id']; ?>&c1=<?php echo $myData['category_level_1']; ?>&c2=<?php echo $myData['category_level_2']; ?>&c3=<?php echo $myData['category_level_3']; ?>" target="_self" alt="Insert Data"><i class="fa fa-plus-square-o fa-fw"></i> Insert</a></td>
                                            <td><a href="?page=Category-Edit&id=<?php echo $myData['id']; ?>&id2=<?php echo $myData['category_id']; ?>"  target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a></td>
                                            <td><a href="?page=Category-Delete&id=<?php echo $myData['id']; ?>&id2=<?php echo $myData['category_id']; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
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


