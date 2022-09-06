<?php
$_SESSION['SES_TITLE'] = "Report of document ";
$_SESSION['SES_SUBTITLE'] = "";
include_once "library/inc.seslogin.php";
include "header.php";

$tgl1	= isset($_GET['fr']) ?  $_GET['fr'] : date('Y-m-d'); 
$tgl2	= isset($_GET['to']) ?  $_GET['to'] : date('Y-m-d'); 
$user		= isset($_GET['user']) ?  $_GET['user'] : '%';
$div		= isset($_GET['div']) ?  $_GET['div'] : '%';
$dept		= isset($_GET['dept']) ?  $_GET['dept'] : '%';
$doc		= isset($_GET['doc']) ?  $_GET['doc'] : '%';
$_SESSION['SES_PAGE'] = "?page=Report-Document&fr=".$tgl1."&to=".$tgl2."&user=".$user."&div=".$div."&dept=".$dept."&doc=".$doc; 



?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Report of Documents <small> </small></h3>
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
                    	<input id="tanggal"  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDateFr" type="text" value="<?php echo $tgl1; ?>" required="required" />
                    	</div>
                    </div>
                    <div class="col-sm-2">
                       <div class="form-group">
                         <label >To Date</label>
                    	 <input id="tanggal2"  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDateTo" type="text" value="<?php echo $tgl2; ?>" required="required" />
                         </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group">
                       <label >Users</label>
                    	<?php // get the users
								$user		= isset($_GET['user']) ?  $_GET['user'] : '%';
								$select_box = "<select name=\"txtUser\" id=\"txtUser\"  class=\"select2_single form-control \" >
								<option value=\"%\">All Users</option>";
								$mySql = "SELECT user_id,user_fullname FROM view_log_document group by user_id, user_fullname order by user_id";
								$dataQry = mysqli_query($koneksidb,$mySql) or die ("Error Query".mysqli_error($koneksidb)); 
								$result = mysqli_query($koneksidb,$mySql) or die('Query failed: Could not get list of data : ' . mysqli_error($con)); // query
									while ($row = mysqli_fetch_array($result)) {
											foreach ($row as $key => $value){ ${$key} = $value; }
											$space=""; 
											if ($row['user_id'] == $user) {
												$cek = " selected";
											} else { $cek=""; } 
											$value = $row['user_id'];
											$name = $row['user_fullname'];
							
											$select_box .= "<option value=\"$value\" $cek>$value $name</option>";                                               
									}
								$select_box .="</select>";
								echo $select_box;   
							?> 
                            </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group">
                       <label >Division</label>
                    	<?php // get the users
								$div		= isset($_GET['div']) ?  $_GET['div'] : '%';
								$select_box = "<select name=\"txtDiv\" id=\"txtDiv\"  class=\"select2_single form-control \" >
								<option value=\"%\">All Division</option>";
								$mySql = "SELECT division FROM view_log_document group by division order by division";
								$dataQry = mysqli_query($koneksidb,$mySql) or die ("Error Query".mysqli_error($koneksidb)); 
								$result = mysqli_query($koneksidb,$mySql) or die('Query failed: Could not get list of data : ' . mysqli_error($con)); // query
									while ($row = mysqli_fetch_array($result)) {
											foreach ($row as $key => $value){ ${$key} = $value; }
											$space=""; 
											if ($row['division'] == $div) {
												$cek = " selected";
											} else { $cek=""; } 
											$value = $row['division'];
											$name = $row['division'];
							
											$select_box .= "<option value=\"$value\" $cek>$name</option>";                                               
									}
								$select_box .="</select>";
								echo $select_box;   
							?> 
                            </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group">
                       <label >Department</label>
                    	<?php // get the users
								$dept		= isset($_GET['dept']) ?  $_GET['dept'] : '%';
								$select_box = "<select name=\"txtDept\" id=\"txtDept\"  class=\"select2_single form-control \" >
								<option value=\"%\">All Department</option>";
								$mySql = "SELECT department FROM view_log_document group by department order by department";
								$dataQry = mysqli_query($koneksidb,$mySql) or die ("Error Query".mysqli_error($koneksidb)); 
								$result = mysqli_query($koneksidb,$mySql) or die('Query failed: Could not get list of data : ' . mysqli_error($con)); // query
									while ($row = mysqli_fetch_array($result)) {
											foreach ($row as $key => $value){ ${$key} = $value; }
											$space=""; 
											if ($row['department'] == $div) {
												$cek = " selected";
											} else { $cek=""; } 
											$value = $row['department'];
											$name = $row['department'];
							
											$select_box .= "<option value=\"$value\" $cek>$name</option>";                                               
									}
								$select_box .="</select>";
								echo $select_box;   
							?> 
                            </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group">
                       <label >Documents</label>
                    	<?php // get the users
								$doc		= isset($_GET['doc']) ?  $_GET['doc'] : '%';
								$select_box = "<select name=\"txtDoc\" id=\"txtDoc\"  class=\"select2_single form-control \" >
								<option value=\"%\">All Documents</option>";
								$mySql = "SELECT document_id, document_title_id FROM view_log_document group by document_id, document_title_id order by document_id";
								$dataQry = mysqli_query($koneksidb,$mySql) or die ("Error Query".mysqli_error($koneksidb)); 
								$result = mysqli_query($koneksidb,$mySql) or die('Query failed: Could not get list of data : ' . mysqli_error($con)); // query
									while ($row = mysqli_fetch_array($result)) {
											foreach ($row as $key => $value){ ${$key} = $value; }
											$space=""; 
											if ($row['document_id'] == $doc) {
												$cek = " selected";
											} else { $cek=""; } 
											$value = $row['document_id'];
											$name = $row['document_title_id'];
							
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
                            <button type="submit" class="btn btn-primary btn-sm" name="btnDocument" style="width:100%"><i class="fa fa-filter fa-fw"></i> Filter</button>
                    	</div>
                    </div>
                    <div class="col-sm-12">
                       <div class="form-group">
                       <label >Column</label><br />
                        <input type="checkbox" name="cbDate" value="Y" > Date
                        &nbsp;<input type="checkbox" name="cbDocID" value="Y"  > Doc ID
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
                                            <?php if (isset($_POST["cbDate"]))  { } else { echo "<th>Date</th>"; } ?>


                                            <th>Doc ID</th> 
                                            <th>Ver.</th> 
                                            <th>Title</th>                                          
                                            <th>Files</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Branch</th>
                                            <th>Division</th>
                                            <th>Department</th>
                                            <th>Unit</th>
                                            <th>Position</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$tgl1	= isset($_GET['fr']) ?  $_GET['fr'] : ''; 
									$tgl2	= isset($_GET['to']) ?  $_GET['to'] : ''; 
									$user	= isset($_GET['user']) ?  $_GET['user'] : '%';
									$div	= isset($_GET['div']) ?  $_GET['div'] : '%';
									$dept	= isset($_GET['dept']) ?  $_GET['dept'] : '%';
									$doc	= isset($_GET['doc']) ?  $_GET['doc'] : '%'; 
									$mySql 	= "SELECT * FROM view_log_document WHERE log_date between '$tgl1' and '$tgl2' and user_id like '$user'
									and division like '$div' and department like '$dept' and document_id like '$doc' ORDER BY log_date ";
									
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("RENTAS ERP ERROR :  ".mysqli_error($koneksidb));
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <?php if (isset($_POST["cbDate"]))  { } else { echo "<td>".$myData['log_date']."</td>"; } ?>
                                            <td><?php echo $myData['document_id']; ?></td>
                                            <td><?php echo $myData['document_version']; ?></td>
                                            <td><?php echo $myData['document_title_id']; ?></td>
                                            <td><?php echo $myData['document_file_title']; ?></td>
                                            <td><?php echo $myData['user_id']; ?></td>
                                            <td><?php echo $myData['user_fullname']; ?></td>
                                            <td><?php echo $myData['branch']; ?></td>
                                            <td><?php echo $myData['division']; ?></td>
                                            <td><?php echo $myData['department']; ?></td>
                                            <td><?php echo $myData['unit']; ?></td>
                                            <td><?php echo $myData['position']; ?></td>
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


