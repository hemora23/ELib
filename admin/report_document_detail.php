<?php
$_SESSION['SES_TITLE'] = "Statistic of document (detail) ";
include_once "library/inc.seslogin.php";
include "header.php";

$id				= isset($_GET['id']) ?  $_GET['id'] : ''; 
$version		= isset($_GET['v']) ?  $_GET['v'] : '';
$file			= isset($_GET['f']) ?  $_GET['f'] : ''; 
$date	= isset($_GET['d']) ?  $_GET['d'] : ''; 
$doctitle	= isset($_GET['dt']) ?  $_GET['dt'] : ''; 
$title	= isset($_GET['t']) ?  $_GET['t'] : 'Detail report of document'; 
$div	= isset($_GET['div']) ?  $_GET['div'] : 'Y'; 
$dept	= isset($_GET['dept']) ?  $_GET['dept'] : 'Y'; 
$unit	= isset($_GET['unit']) ?  $_GET['unit'] : 'Y'; 
$pos	= isset($_GET['pos']) ?  $_GET['pos'] : 'Y'; 
$_SESSION['SES_SUBTITLE'] = "Document : ".$title." & date : ".$date;
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Statistic of Documents<small> ( Detail )</small></h3>
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
                  	&nbsp;
                    </div>
                    <div class="col-xs-3">
                    <ul class="nav navbar-right panel_toolbox">
                     <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
               <div class="x_content "><!-- x_content -->
                  <br /> 
              <div class="row">             
              <form  role="form" action="?page=Filter" method="POST" name="form1" target="_self" id="form1"> 
                  	<div class="col-sm-2">
                       <div class="form-group">
                         <label >Date</label>
                    	<input id="tanggal"  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDateFr" type="text" value="<?php echo $date; ?>" readonly required="required" />
                      <input id="apps"   name="txtID" type="hidden" value="<?php echo $id; ?>" />
                      <input id="apps"   name="txtVer" type="hidden" value="<?php echo $version; ?>" />
                      <input id="apps"   name="txtDT" type="hidden" value="<?php echo $doctitle; ?>" />
                    	</div>
                    </div>
                    <div class="col-sm-3">
                       <div class="form-group">
                         <label >Document</label>
                    	<input id="tanggal"  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDoc" type="text" value="<?php echo $id.' v'.$version.' '.$doctitle; ?>" readonly required="required" />
                      
                    	</div>
                    </div>
                    <div class="col-sm-3">
                       <div class="form-group">
                         <label >File</label>
                    	<input id="tanggal"  class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtFile" type="text" value="<?php echo $file; ?>" readonly required="required" />
                      
                    	</div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group">
                         <label >Title</label>
                    	 <input id="title"  class="form-control"  name="txtTitle" type="text" value="<?php echo $title; ?>" required="required" />
                         </div>
                    </div>
                    
                    
                    <div class="col-sm-4">
                       <div class="form-group">
                       <label >Column</label><br>
                          <label class="checkbox-inline"><input type="checkbox" name="txtDiv2" value="Y" <?php if ($div == 'Y') { echo "checked"; } ?>  >Division</label>
                          <label class="checkbox-inline"><input type="checkbox" name="txtDept2" value="Y" <?php if ($dept == 'Y') { echo "checked"; } ?>  >Department</label>
                          <label class="checkbox-inline"><input type="checkbox" name="txtUnit" value="Y" <?php if ($unit == 'Y') { echo "checked"; } ?>  >Unit</label>
                          <label class="checkbox-inline"><input type="checkbox" name="txtPos" value="Y" <?php if ($pos == 'Y') { echo "checked"; } ?>  >Position</label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                       <div class="form-group">
                       		<label>&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary btn-sm" name="btnDocumentDetail" style="width:100%"><i class="fa fa-filter fa-fw"></i> Filter</button>
                    	</div>
                    </div>
                    <div class="col-sm-2">
                       <div class="form-group">
                       		<label>&nbsp;</label><br />
                            <button type="submit" class="btn btn-info btn-sm" name="btnDocumentDetailSubmit" style="width:100%"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>
                            
                    	</div>
                    </div>
                    </form>
              </div>
              </div>
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th> 
                                            <th>Name</th> 
                                            <?php if ($div == 'Y') { echo "<th>Diviison</th>"; } ?> 
                                            <?php if ($dept == 'Y') { echo "<th>Department</th>"; } ?> 
                                            <?php if ($unit == 'Y') { echo "<th>Unit</th>"; } ?> 
                                            <?php if ($pos == 'Y') { echo "<th>Position</th>"; } ?> 
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "select * from view_log_document where document_id='$id' and document_version='$version'  and document_file_title='$file' and date(log_date)='$date' order by date(log_date), user_id";
									
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("RENTAS ERP ERROR :  ".mysqli_error($koneksidb));
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['log_date']; ?></td>
                                            <td><?php echo $myData['user_id'].' '.$myData['user_fullname']; ?></td>
                                            <?php if ($div == 'Y') { echo "<td>".$myData['division']."</td>"; } ?>
                                            <?php if ($dept == 'Y') { echo "<td>".$myData['department']."</td>"; } ?>
                                            <?php if ($unit == 'Y') { echo "<td>".$myData['unit']."</td>"; } ?>
                                            <?php if ($pos == 'Y') { echo "<td>".$myData['position']."</td>"; } ?>
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


