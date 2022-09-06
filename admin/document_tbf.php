<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE']="?page=Document-TBF";
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>TBF Document <small></small></h3>
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
                  <div class="x-content">
                  <form  role="form" action="?page=Filter" method="POST" name="form1" target="_self" id="form1"> 
                  	<div class="col-sm-2">
                       <label >Status</label>
                        <select name="txtStatus" class="form-control" >
                        <option value="%">All Status</option>";
                        <?php
                          	$st	= isset($_GET['st']) ?  $_GET['st'] : '%'; 
                            $mySql = "SELECT * FROM master_status WHERE status_group='Document' ";
                            $dataQry = mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error()); 
                              while ($dataRow = mysqli_fetch_array($dataQry)) {
                                  if ($dataRow['status_name'] == $st) {
                                            $cek = " selected";
                                        } else { $cek=""; }
                                  echo "<option value='$dataRow[status_name]' $cek>$dataRow[status_name]</option>";
                              }
                        ?>                                               
                         </select> 
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group">
                       <label >Category</label>
                    	<?php // get the users
						
								$data		= isset($_GET['id']) ?  $_GET['id'] : '%'; 
								$select_box = "<select name=\"txtID\" id=\"txtID\"  class=\"select2_single form-control \" >
								<option value=\"%\">All category</option>";
								$mySql = "SELECT category_id, category_level_1, category_level_2, category_level_3, category_level_4, category_level_4
								category_level_5, category_level_6 FROM view_document group by category_id order by category_id";
								$dataQry = mysqli_query($koneksidb,$mySql) or die ("Error Query".mysqli_error($koneksidb)); 
								$result = mysqli_query($koneksidb,$mySql) or die('Query failed: Could not get list of user : ' . mysqli_error($con)); // query
									while ($row = mysqli_fetch_array($result)) {
											foreach ($row as $key => $value){ ${$key} = $value; }
											$space="";  
											if ($row['category_level_2'] != '') {$dataCategory2='| '.$row['category_level_2']; } else {$dataCategory2='';};
											if ($row['category_level_3'] != '') {$dataCategory3='| '.$row['category_level_3']; } else {$dataCategory3='';};
											if ($row['category_level_4'] != '') {$dataCategory4='| '.$row['category_level_4']; } else {$dataCategory4='';};
											if ($row['category_level_5'] != '') {$dataCategory5='| '.$row['category_level_5']; } else {$dataCategory5='';};
											if ($row['category_level_6'] != '') {$dataCategory6='| '.$row['category_level_6']; } else {$dataCategory6='';};
											if ($row['category_id'] == $data) {
												$cek = " selected";
											} else { $cek=""; } 
											$value = $row['category_id'];
											$name = $row['category_level_1'].' '.$dataCategory2.' '.$dataCategory3.' '.$dataCategory4.' '.$dataCategory5.' '. $dataCategory6;
							
											$select_box .= "<option value=\"$value\" $cek>$value $name</option>";                                               
									}
								$select_box .="</select>";
								echo $select_box;   
							?> 
                            </div>
                    </div>
                    <div class="col-sm-2">
                       <div class="form-group">
                       		<label>&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary btn-sm" name="btnDocumentTBF" style="width:100%"><i class="fa fa-filter fa-fw"></i> Filter</button>
                    	</div>
                    </div>
                    </form>
                  
                  </div>
                  <div class="col-xs-12">              
                      <div class="ln_solid"></div>
                   </div>  
                  
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Doc. ID</th>
                                            <th>Ver.</th>                               
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Categories</th>
                                            <th>Change History</th>
                                            <th>Edit</th>
                                            <th>Privileges</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$id	= isset($_GET['id']) ?  $_GET['id'] : '%'; 
									$st	= isset($_GET['st']) ?  $_GET['st'] : '%'; 
									$mySql 	= "SELECT v.* FROM view_document v where (v.document_status<>'Approved' and v.document_status<>'Deleted' ) and v.document_status 
like '$st'  and v.category_id like '$id' and v.document_version = (select max(w.document_version) from view_document w where w.document_id=v.document_id) order  by v.updated_date desc";
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
                                            <td><?php echo $myData['document_title_id']; ?></td>
                                            <td><a href="?page=Document-Status&id=<?php echo $Code;  ?>" alt="View Data"><u><?php echo $myData['document_status']; ?></u></a></td>        
                                            <td><?php echo $Category; ?></td>
                                            <td><?php echo $myData['document_change_history']; ?></td>
                                            <td>
                                            <?php if ($myData['document_status']!='Reviewed') {?>
                                            <a href="?page=Document-Edit&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a>
                                            <?php } ?>
                                            </td>
                                            <td>
                                             <?php if ($myData['document_status']!='Reviewed') {?>
                                             <a href="?page=Document-Privileges-Edit&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" target="_self" alt="Edit Data"><i class="fa fa-check-square-o fa-fw"></i> Privileges</a>
                                            <?php } ?>
                                            </td>
                                            <td>
                                            <?php if ($myData['document_status']!='Reviewed') {?>
                                            <a href="?page=Document-Delete&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
                                            <?php } ?>
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


