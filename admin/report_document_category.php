<?php
$_SESSION['SES_TITLE'] = "Statistic of documents by category ";
include_once "library/inc.seslogin.php";
include "header.php";

$tgl1	= isset($_GET['fr']) ?  $_GET['fr'] : date('Y-m-d'); 
$tgl2	= isset($_GET['to']) ?  $_GET['to'] : date('Y-m-d'); 
$id		= isset($_GET['id']) ?  $_GET['id'] : '%'; 
$docid	= isset($_GET['di']) ?  $_GET['di'] : 'Y'; 
$docver	= isset($_GET['dv']) ?  $_GET['dv'] : 'Y'; 
$doctitle	= isset($_GET['dt']) ?  $_GET['dt'] : 'Y'; 
$title	= isset($_GET['t']) ?  $_GET['t'] : 'Report of document by category'; 
$_SESSION['SES_SUBTITLE'] = "Category : ".$id." & date : ".$tgl1." - ".$tgl2;
$_SESSION['SES_PAGE'] = "?page=Report-Document-Category&fr=".$tgl1."&to=".$tgl2."&id=".$id; 
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Statistic of Documents<small> ( By Category )</small></h3>
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
                    <div class="col-xs-9">
                  	&nbsp;
                    </div>
                    <div class="col-xs-3">
                    <ul class="nav navbar-right panel_toolbox">
                     <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x-content">
                  
                  <form  role="form" action="?page=Filter" method="POST" name="form1" target="_self" id="form1"> 
                  	<div class="col-sm-2">
                       <div class="form-group">
                         <label >From Date</label>
                    	<input id="tanggal"  autocomplete="off"  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDateFr" type="text" value="<?php echo $tgl1; ?>" required="required" />
                    	</div>
                    </div>
                    <div class="col-sm-2">
                       <div class="form-group">
                         <label >To Date</label>
                    	 <input id="tanggal2"  autocomplete="off"  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDateTo" type="text" value="<?php echo $tgl2; ?>" required="required" />
                         </div>
                    </div>
                    <div class="col-sm-5">
                       <div class="form-group">
                       <label >Category</label>
                    	<?php // get the users
						
								$data		= isset($_GET['id']) ?  $_GET['id'] : '%'; 
								$select_box = "<select name=\"txtID\" id=\"txtID\"  class=\"select2_single form-control \" >
								<option value=\"%\">All category</option>";
								$mySql = "SELECT category_id, category_level_1, category_level_2, category_level_3, category_level_4, category_level_4
								category_level_5, category_level_6 FROM view_log_document group by category_id order by category_id";
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
                    <div class="col-sm-3">
                       <div class="form-group">
                         <label >Title</label>
                    	 <input id="title"  class="form-control"  name="txtTitle" type="text" value="<?php echo $title; ?>" required="required" />
                         </div>
                    </div>
                    
                    <div class="col-sm-4">
                       <div class="form-group">
                       <label >Column</label><br>
                          <label class="checkbox-inline"><input type="checkbox" name="txtDocid" value="Y" <?php if ($docid == 'Y') { echo "checked"; } ?>  >Doc. ID</label>
                          <label class="checkbox-inline"><input type="checkbox" name="txtDocver" value="Y" <?php if ($docver == 'Y') { echo "checked"; } ?>  >Doc. Ver.</label>
                          <label class="checkbox-inline"><input type="checkbox" name="txtDoctitle" value="Y" <?php if ($doctitle == 'Y') { echo "checked"; } ?>  >Doc. Title</label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                       <div class="form-group">
                       		<label>&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary btn-sm" name="btnDocumentCategory" style="width:100%"><i class="fa fa-filter fa-fw"></i> Filter</button>
                    	</div>
                    </div>
                    <div class="col-sm-2">
                       <div class="form-group">
                       		<label>&nbsp;</label><br />
                            <button type="submit" class="btn btn-info btn-sm" name="btnDocumentCategorySubmit" style="width:100%"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>
                            
                    	</div>
                    </div>
                    </form>
                  
                  </div>
                  <div class="col-xs-12">              
                      <div class="ln_solid"></div>
                   </div>  
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <?php if ($docid == 'Y') { echo "<th>Doc. ID</th>"; } ?> 
                                            <?php if ($docver == 'Y') { echo "<th>Doc. Ver.</th>"; } ?>
                                            <?php if ($doctitle == 'Y') { echo "<th>Doc. Title</th>"; } ?>
                                            <th>File</th>                                          
                                            <th>Date</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$tgl1	= isset($_GET['fr']) ?  $_GET['fr'] : ''; 
									$tgl2	= isset($_GET['to']) ?  $_GET['to'] : ''; 
									$id	= isset($_GET['id']) ?  $_GET['id'] : '%'; 
									$mySql 	= "SELECT * FROM view_log_document_percategory WHERE tgl between '$tgl1' and '$tgl2' and category_id like '$id'
									ORDER BY tgl ";
									
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("RENTAS ERP ERROR :  ".mysqli_error($koneksidb));
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <?php if ($docid == 'Y') { ?>
                                              <td><?php echo $myData['document_id']; ?></td>
                                            <?php } ?>
                                            <?php if ($docver == 'Y') { ?>
                                              <td><?php echo $myData['document_version']; ?></td>
                                            <?php } ?>
                                            <?php if ($doctitle == 'Y') { ?>
                                              <td><?php echo $myData['document_title_id']; ?></td>
                                            <?php } ?>
                                            <td><?php echo $myData['document_file_title']; ?></td>
                                            <td><?php echo $myData['tgl']; ?></td>
                                             <td><a href="?page=Report-Document-Detail&id=<?php echo $myData['document_id']; ?>&v=<?php echo $myData['document_version']; ?>&f=<?php echo $myData['document_file_title']; ?>&d=<?php echo $myData['tgl']; ?>&dt=<?php echo $myData['document_title_id']; ?>" target="_self" alt="Total"><u><?php echo $myData['total']; ?></u></a></td>
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


