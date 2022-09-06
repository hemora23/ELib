<?php
include_once "library/inc.seslogin.php";
include "header.php";

?>
		


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          	<div class="page-title">
              <div class="title_left">
                <h3>Dashboard</h3>
              </div>
            </div>
          </div>
                  
          <div class="clearfix"></div>
          <div class="row">
             
             <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Total dokumen yang dibaca <?php echo $_SESSION['SES_NAMA']; ?></h5>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="mybarChart"></canvas>
                  </div>
                </div>
             </div>
             
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Top 5 dokumen sering dibaca <?php echo $_SESSION['SES_NAMA']; ?></h5>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="pieChart"></canvas>
                  </div>
                </div>
             </div>
             
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Top 5 dokumen sering dibaca seluruh karyawan</h5>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="bar-chart-horizontal-2"></canvas>
                  </div>
                </div>
             </div>
             
             
          </div><!-- /row -->
          <div class="clearfix"></div>
          
          
          
        
        <!-- /page content -->
		</div>
        
        

<?php
include "dashboard_footer.php";
?>