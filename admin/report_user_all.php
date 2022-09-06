<?php

include_once "library/inc.seslogin.php";
include "header.php";
$title	= isset($_GET['t']) ?  $_GET['t'] : 'Report of All Visitors'; 

$_SESSION['SES_PAGE']="?page=Report-User-All";
$columntitle='Visitor';
$canvas = "bar-chart-horizontal";
       
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Statistic of All Visitors<small></small></h3>
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
                  <div class="row">
                  <form  role="form" action="?page=Filter" method="POST" name="form1" target="_self" id="form1"> 
                    <div class="col-sm-3">
                       <div class="form-group">
                         <label >Title</label>
                    	 <input id="title"  class="form-control"  name="txtTitle" type="text" value="<?php echo $title; ?>" required="required" />
                         </div>
                    </div>
                    <div class="col-sm-2">
                       <div class="form-group">
                       		<label>&nbsp;</label><br />
                            <button type="submit" class="btn btn-info btn-sm" name="btnUserAll" style="width:100%"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>
                            
                    	</div>
                    </div>
                    </form>       
                  </div> 
                  



                  <div class="x_content table-responsive"> 
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th><?php echo $columntitle; ?></th> 
                                            <th>Bagian - Unit</th> 
                                            <th>Last Login</th> 
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
                                    
                                    
                                    $mySql = "SELECT u.user_id, u.user_fullname, u.division, u.department, u.unit, (select max(log_date) from view_log_user where user_id=u.user_id) as last_login, count(*) as total 
                                    from view_log_user u group by u.user_id, u.user_fullname, u.division, u.department, u.unit order by u.user_fullname";
                                            
                                    $myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['user_fullname'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>                                            
                                            <td><?php echo $myData['user_fullname']; ?></td>
                                            <td><?php echo $myData['division'].' - '.$myData['department']; ?></td>
                                            <td><?php echo $myData['last_login']; ?></td>
                                            <?php 
                                                    echo "<td><a href='?page=Report-User-All-Detail&id=1&id2=".urlencode($Code)."' target='_self'><u> ".$myData['total']." </u></a></td>";
                                                       
                                             ?>
                                                
                                            
                                            
                                           
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


