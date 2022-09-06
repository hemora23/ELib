<?php
include_once "library/inc.seslogin.php";
include "header.php";

$mySql	= "SELECT count(*)-1 as totalproduk FROM master_product";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$totalproduk	= $myData['totalproduk'];

$mySql	= "SELECT sum(qty) as totalinbound FROM stock WHERE stock_status='IN'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$totalinbound	= $myData['totalinbound'];

$mySql	= "SELECT sum(qty)*-1 as totaloutbound FROM stock WHERE stock_status='OUT'";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$totaloutbound	= $myData['totaloutbound'];

$mySql	= "SELECT sum(qty) as totalsales FROM sales_detail ";
$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query ambil data salah : ".mysqli_error());
$myData = mysqli_fetch_array($myQry);
$totalsales	= $myData['totalsales'];


?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-cube"></i></div>
                  <div class="count"><?php echo $totalproduk ?></div>
                  <h3>Produk </h3>
                  <p>Total Produk</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sign-in"></i></div>
                  <div class="count"><?php echo $totalinbound ?></div>
                  <h3>Inbound</h3>
                  <p>Total Produk Inbound</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sign-out"></i></div>
                  <div class="count"><?php echo $totaloutbound ?></div>
                  <h3>Outbound</h3>
                  <p>Total Produk Outbond</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-usd"></i></div>
                  <div class="count"><?php echo $totalsales ?></div>
                  <h3>Order</h3>
                  <p>Total Produk yg di Order</p>
                </div>
              </div>
            </div>
            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Stok Barang <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="mybarChart"></canvas>
                  </div>
                </div>
              </div>
             </div>
          </div><!-- /row -->
        </div>
        <!-- /page content -->

<?php
include "footer.php";
?>