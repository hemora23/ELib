<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=Dashboard";
$tgl1  = isset($_GET['fr']) ?  $_GET['fr'] : date('Y-m-01');
$tgl2  = isset($_GET['to']) ?  $_GET['to'] : date('Y-m-d');

$now = date('Y-m-d');

$month1 = date("m", strtotime($tgl1));
$month2 = date("m", strtotime($tgl2));

$mySql   = "select count(*) as total from master_user where  user_status='Active' ";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query 1" . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);
$users  = $myData['total'];

$mySql   = "select count(*) as total from master_category  ";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query 2" . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);
$cats  = $myData['total'];

$mySql  = "SELECT count(*) as total FROM document v where (v.document_status<>'Approved' and v.document_status<>'Deleted' ) and v.document_version = (select max(w.document_version) from view_document w where w.document_id=v.document_id)";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query 3" . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);
$docs  = $myData['total'];

$mySql   = "SELECT status_name FROM master_status where status_group='Document Expiration'";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query 4" . mysqli_error());
$myData = mysqli_fetch_array($myQry);
$interval = $myData['status_name'];

$mySql   = "select count(*) as total from view_document where Date(document_expire_date) < DATE(NOW() + INTERVAL $interval) and document_status='Approved' ";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query 5" . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);
$files  = $myData['total'];
?>





<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="row top_tiles">

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <a href="?page=User">
            <div class="icon"><i class="fa fa-users"></i></div>
            <div class="count"><?php echo $users; ?></div>
            <h3>Total Users</h3>
            <p>&nbsp;</p>
          </a>
        </div>
      </div>

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <a href="?page=Category">
            <div class="icon"><i class="fa fa-list"></i></div>
            <div class="count"><?php echo $cats; ?></div>
            <h3>Total Categories</h3>
            <p>&nbsp;</p>
          </a>
        </div>
      </div>

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <a href="?page=Document-TBF">
            <div class="icon"><i class="fa fa-files-o"></i></div>
            <div class="count"><?php echo $docs; ?></div>
            <h3>Total TBF Documents</h3>
            <p>&nbsp;</p>
          </a>
        </div>
      </div>

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <a href="?page=Document-Expiration">
            <div class="icon"><i class="fa fa-calendar"></i></div>
            <div class="count"><?php echo $files; ?></div>
            <h3>Total Expired Doc.</h3>
            <p>&nbsp;</p>
          </a>
        </div>
      </div>


    </div>


  </div>



  <div class="clearfix"></div>
  <!-- row -->
  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <form role="form" action="?page=Filter" method="POST" name="form1" target="_self" id="form1">
        <div class="x_panel">
          <div class="">
            <div class="row">
              <div class="col-md-1 col-sm-6 col-xs-6" style="padding-top: 15px;">
                <h2>Filter:</h2>
              </div>
              <div class="col-md-5 col-sm-6 col-xs-12">
                <span>From Date</span>
                <input class="form-control" type="date" name="txtDateFr" value="<?php echo $tgl1; ?>" style="width:100%" placeholder="From">
              </div>
              <div class="col-md-5 col-sm-6 col-xs-12">
                <span>To Date</span>
                <input class="form-control" type="date" name="txtDateTo" value="<?php echo $tgl2; ?>" style="width:100%" placeholder="To">
              </div>
              <div class="col-md-1 col-sm-6 col-xs-6" style="padding-top: 20px;">
                <button class="btn btn-primary btn-sm" type="submit" name="btnDashboardFilter"> Filter</button>
              </div>

            </div>

          </div>
        </div>
      </form>
    </div>
    <!-- <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Top 10 Visitor </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <canvas id="bar-chart-horizontal"></canvas>
        </div>
      </div>
    </div> -->

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Top 5 Visitor</h2>
          <div class="clearfix"></div>
        </div>
        <ul class="list-unstyled top_profiles scroll-view">

          <?php
          $mySql   = "select *, sum(total) as total_sum from view_log_user_top10 where log_date >= '$tgl1' and log_date <= '$tgl2' group by user_id order by sum(total) desc limit 5";
          $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
          while ($myData = mysqli_fetch_array($myQry)) {
            $datauser = $myData['user_fullname'];
            $datatotal = $myData['total_sum'];
            $dataid = $myData['user_id'];
            $department = $myData['department'];
            $user_photo = $myData['user_photo'];
          ?>

            <li class="media event">

              <img class="pull-left border-aero profile_thumb" src="../uploads/user/<?php echo $user_photo ?> " alt="slide" />
              <!-- <i class="fa fa-user aero"></i> -->
              <?php
              $now = date('Y-m-d');
              ?>
              <div class="media-body">
                <a class="title" href="?page=Report-User-User&fr=2021-01-01&to=<?php echo $now; ?>&id=<?php echo $dataid; ?>&w=Y&t=Report%20of%20visitors%20by%20user"><?php echo $datauser; ?></a>
                <p><strong>Unit</strong> : <?php echo $department  ?> </p>
                <p> <small>Total Akses</small> : <?php echo $datatotal; ?>
                </p>
              </div>
            </li>
          <?php }
          ?>
        </ul>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Top 5 Reader</h2>
          <div class="clearfix"></div>
        </div>
        <ul class="list-unstyled top_profiles scroll-view">

          <?php
          $mySql   = "select *, sum(total) as total_sum from view_log_document_user_top10 where log_date >= '$tgl1' and log_date <= '$tgl2' group by user_id order by sum(total) desc limit 5";
          // $mySql   = "select* from view_log_document_user_top10 order by total desc limit 10";
          $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
          while ($myData = mysqli_fetch_array($myQry)) {
            $datauser = $myData['user_fullname'];
            $datatotal = $myData['total_sum'];
            $dataid = $myData['user_id'];
            $department = $myData['department'];
            $user_photo = $myData['user_photo'];
          ?>

            <li class="media event">

              <img class="pull-left border-aero profile_thumb" src="../uploads/user/<?php echo $user_photo ?> " alt="slide" />
              <!-- <i class="fa fa-user aero"></i> -->

              <div class="media-body">
                <a class="title" href="?page=Report-Document-User&fr=2021-01-01&to=<?php echo $now; ?>&id=<?php echo $dataid; ?>&di=Y&dv=Y&dt=Y&t=Report%20of%20document%20by%20user"><?php echo $datauser; ?></a>
                <p><strong>Unit</strong> : <?php echo $department  ?> </p>
                <p> <small>Total Read</small> : <?php echo $datatotal; ?>
                </p>
              </div>
            </li>
          <?php }
          ?>
        </ul>
      </div>
    </div>



    <!-- <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Top 10 Reader </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <canvas id="bar-chart-horizontal-3"></canvas>
        </div>
      </div>
    </div> -->

  </div><!-- /row -->
  <div class="clearfix"></div>


  <div class="row">

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Top 10 Documents </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <canvas id="bar-chart-horizontal-2"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Total Documents Read</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <!-- <canvas id="mybarChart"></canvas> -->
          <canvas id="lineChart03"></canvas>

        </div>
      </div>
    </div>


  </div><!-- /row -->
  <div class="clearfix"></div>


  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2 style=" text-align: center;">Total Visitor (daily) </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <canvas id="lineChart02"></canvas>
          <!-- <canvas id="mybarChart2"></canvas> -->
        </div>
      </div>
    </div>


    <!-- 
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Total Visitor (Monthly)</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <canvas id="lineChart"></canvas>
        </div>
      </div>
    </div> -->




  </div><!-- /row -->
  <div class="clearfix"></div>


  <form method="post" accept-charset="utf-8" name="form1">
    <input name="hidden_data" id='hidden_data' type="hidden" />
  </form>



  <!-- /page content -->
</div>



<?php
include "dashboard_footer.php";
?>