<?php
include_once "library/inc.seslogin.php";
include "header.php";



?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Help</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Help <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view " src="images/logo_rentas.png" alt="Avatar" title="Change the avatar"><br />
                          <div align="center"><a href="http://www.rentas.co.id" target="_blank"><h2>www.rentas.co.id</h2></a></div>
                          
                        </div>
                      </div>
                      

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    	<div class="x_panel">
                    	<div class="row">
                        <h2>About RENTAS KMS</h2>
                        	<div class="ln_solid"></div>
                            <div class="col-xs-12">
                            <h2>RENTAS Knowledge Management System (KMS)</h2>
                            Version : 2018.2.0<br /><br />
                            <p style="text-align:justify">A knowledge management system (KMS) is a system for applying, creating, sharing, using and managing the knowledge and information of an organisationand using knowledge management principles. the process of These include data-driven objectives around business productivity, a competitive business model, business intelligence analysis and more. </p>
                            <div class="ln_solid"></div>
                            <p><b>For any inquiries or questions regarding this application, please contact us via email to :<br />
                    <i class='fa fa-envelope-o fa-fw'></i>&nbsp;email&nbsp;:&nbsp;<a href="mailto:support@rentas.co.id">support@rentas.co.id</a><br /></b></p>
                            <div class="ln_solid"></div>
                            <p>Copyright © 2018 PT Rentas Media Indonesia. All rights reserved.</p>
                            </div>
                        </div>	
                        
                        
                      

                      

                      
                          
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        
        <!-- /page content -->
 </form>
<?php
include "footer.php";
?>