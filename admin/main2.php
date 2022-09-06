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
            <div class="col-xs-12">
                <div class="x_panel ">
                  <div class="x_title">
                    <h2>Task Tracking <small>Monthly Progress</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                    <img src="uploads/dashaboard.jpg" width="991"  class="img-responsive"/> </div>
                  </div>
                </div>
              </div>
              </div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Total Delivery<small>Weekly progress</small></h2>
                    <div class="filter">
                      <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>September 01, 2017 - September 31, 2017</span> <b class="caret"></b>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                      <div class="demo-container" ">
                        <div id="placeholder33x" class="demo-placeholder"></div>
                      </div>
                      

                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                      <div>
                        <div class="x_title">
                          <h2>3 Stok Terendah</h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                              </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">
                          <li class="media event">
                          <a class="pull-left border-green profile_thumb">
                            <img src="uploads/ps-01.jpg" width="30"  class="circle-image"/></a>
<div class="media-body">

                              <a class="title" href="#">Pediasure Choco 400gr</a>
                              <p><strong>18 </strong> Unit </p>
                              <p> <small>12 Penjualan bulan Ini</small>
                              </p>
                              </div>
                          </li>
                          <li class="media event">
                            <a class="pull-left border-green profile_thumb">
                              <img src="uploads/ps-02.jpg" width="30"  class="circle-image"/></a>
<div class="media-body">
                            </a>
                            <div class="media-body">
                              <a class="title" href="#">Pediasure Choco 850gr</a>
                              <p><strong>50 </strong> Unit </p>
                              <p> <small>10 Penjualan bulan ini</small>
                              </p>
                            </div>
                          </li>
                          <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                              <img src="uploads/ps-02.jpg" width="30"  class="circle-image"/></a>
                            </a>
                            <div class="media-body">
                              <a class="title" href="#">Pediasure Honey 400gr</a>
                              <p><strong>67 </strong> Unit </p>
                              <p> <small>15 Penjualan bulan ini</small>
                              </p>
                            </div>
                          </li>
                          
                        </ul>
                      </div>
                    </div>

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