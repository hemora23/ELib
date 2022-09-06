<?php
include_once "library/inc.seslogin.php";
include "header.php";
$title	= isset($_GET['t']) ?  $_GET['t'] : 'Report of document read by user'; 
if(isset($_POST['btnSubmit'])){
	$id = $_POST['txtID'];
  $status = $_POST['txtRead'];
  $title	= $_POST['txtTitle']; 
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Doc-Pdf&id=$id&status=$status&t=$title'>";
	
}
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Report of document read by user</h3>
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
                  
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                  	
                    <div class="col-sm-5">
                       <div class="form-group">
                       <label >Documents</label>
                    	<?php // get the users
								$data		= isset($_GET['id']) ?  $_GET['id'] : '%';
								$select_box = "<select name=\"txtID\" id=\"txtID\"  class=\"select2_single form-control \" >";
								$mySql = "SELECT document_id, document_title_id FROM view_log_document group by document_id, document_title_id order by document_id";
								$dataQry = mysqli_query($koneksidb,$mySql) or die ("Error Query".mysqli_error($koneksidb)); 
								$result = mysqli_query($koneksidb,$mySql) or die('Query failed: Could not get list of data : ' . mysqli_error($con)); // query
									while ($row = mysqli_fetch_array($result)) {
											foreach ($row as $key => $value){ ${$key} = $value; }
											$space=""; 
											if ($row['document_id'] == $data) {
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
                            <label >Read</label>
                            <select name="txtRead" class="select2_single form-control" tabindex="-1">
                            	<option value='Read' >Read</option>
                                <option value='Unread' >Unread</option>  
                             </select> 
                          </div>
                    </div>
                    <div class="col-sm-3">
                       <div class="form-group">
                         <label >Title</label>
                    	 <input id="title"  class="form-control"  name="txtTitle" type="text" value="<?php echo $title; ?>" required="required" />
                         </div>
                    </div>
                    <div class="col-sm-2">
                       <div class="form-group">
                       		<label>&nbsp;</label><br />
                            <button type="submit" class="btn btn-info btn-sm" name="btnSubmit" style="width:100%"><i class="fa fa-file-text-o fa-fw"></i> PDF</button>
                            
                    	</div>
                    </div>
                    </form>
                  
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


