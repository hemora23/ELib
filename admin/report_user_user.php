<?php
$_SESSION['SES_TITLE'] = "Statistic of visitors by user ";
include_once "library/inc.seslogin.php";
include "header.php";

$tgl1  = isset($_GET['fr']) ?  $_GET['fr'] : date('Y-m-d');
$tgl2  = isset($_GET['to']) ?  $_GET['to'] : date('Y-m-d');
$id  = isset($_GET['id']) ?  $_GET['id'] : '%';
$web  = isset($_GET['w']) ?  $_GET['w'] : 'Y';
// $mobile	= isset($_GET['m']) ?  $_GET['m'] : 'Y'; 
$title  = isset($_GET['t']) ?  $_GET['t'] : 'Report of visitors by user';
$_SESSION['SES_SUBTITLE'] = "Date : " . $tgl1 . " - " . $tgl2;
$_SESSION['SES_PAGE'] = "?page=Report-User-User&fr=" . $tgl1 . "&to=" . $tgl2 . "&id=" . $id;
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Statistic of Visitors<small> ( By User )</small></h3>
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
            <form role="form" action="?page=Filter" method="POST" name="form1" target="_self" id="form1">
              <div class="col-sm-2">
                <div class="form-group">
                  <label>From Date</label>
                  <input id="tanggal" class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDateFr" type="text" value="<?php echo $tgl1; ?>" autocomplete="off" required="required" />
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>To Date</label>
                  <input id="tanggal2" class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDateTo" type="text" value="<?php echo $tgl2; ?>" autocomplete="off" required="required" />
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                  <label>Users</label>
                  <?php // get the users
                  $data    = isset($_GET['id']) ?  $_GET['id'] : '%';
                  $select_box = "<select name=\"txtID\" id=\"txtID\"  class=\"select2_single form-control \" >
								<option value=\"%\">All Users</option>";
                  $mySql = "SELECT user_id,user_fullname FROM view_log_user group by user_id, user_fullname order by user_id";
                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Error Query" . mysqli_error($koneksidb));
                  $result = mysqli_query($koneksidb, $mySql) or die('Query failed: Could not get list of data : ' . mysqli_error($con)); // query
                  while ($row = mysqli_fetch_array($result)) {
                    foreach ($row as $key => $value) {
                      ${$key} = $value;
                    }
                    $space = "";
                    if ($row['user_id'] == $data) {
                      $cek = " selected";
                    } else {
                      $cek = "";
                    }
                    $value = $row['user_id'];
                    $name = $row['user_fullname'];

                    $select_box .= "<option value=\"$value\" $cek>$value $name</option>";
                  }
                  $select_box .= "</select>";
                  echo $select_box;
                  ?>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Title</label>
                  <input id="title" class="form-control" name="txtTitle" type="text" value="<?php echo $title; ?>" required="required" />
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Column</label><br>
                  <label class="checkbox-inline"><input type="checkbox" name="txtWeb" value="Y" <?php if ($web == 'Y') {
                                                                                                  echo "checked";
                                                                                                } ?>>Total Visitor (Web)</label>
                  <!-- <label class="checkbox-inline"><input type="checkbox" name="txtMobile" value="Y" <?php if ($mobile == 'Y') {
                                                                                                          echo "checked";
                                                                                                        } ?>  >Total Visitor (Mobile)</label> -->
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>&nbsp;</label><br />
                  <button type="submit" class="btn btn-primary btn-sm" name="btnUserUser" style="width:100%"><i class="fa fa-filter fa-fw"></i> Filter</button>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>&nbsp;</label><br />
                  <button type="submit" class="btn btn-info btn-sm" name="btnUserUserSubmit" style="width:100%"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>

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
                  <th>Date</th>
                  <<?php if ($web == 'Y') {
                      echo "<th>Total Visitor (Web)</th>";
                    } ?> <!-- <?php if ($mobile == 'Y') {
                                echo "<th>Total Visitor (Mobile)</th>";
                              } ?> -->
                </tr>
              </thead>
              <tbody>

                <?php
                $tgl1  = isset($_GET['fr']) ?  $_GET['fr'] : date('Y-m-d');
                $tgl2  = isset($_GET['to']) ?  $_GET['to'] : date('Y-m-d');
                $id    = isset($_GET['id']) ?  $_GET['id'] : '%';
                $mySql   = "SELECT daily, sum(web) as web, sum(mobile) as mobile FROM view_log_user_daily_apps WHERE daily between '$tgl1' and '$tgl2' and user_id like '$id' group by daily ORDER BY daily ";

                $myQry   = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR :  " . mysqli_error($koneksidb));
                $nomor  = 0;
                while ($myData = mysqli_fetch_array($myQry)) {
                  $nomor++;
                ?>

                  <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $myData['daily']; ?></td>
                    <?php if ($web == 'Y') { ?>
                      <td><a href="?page=Report-User-Detail&d=<?php echo $myData['daily']; ?>&a=<?php echo "web";  ?>&id=<?php echo $id; ?>&t=<?php echo $title; ?>" target="_self" alt="Total"><u><?php echo $myData['web']; ?></u></a></td>
                    <?php } ?>
                    <!-- <?php if ($mobile == 'Y') { ?>

                                            <td><a href="?page=Report-User-Detail&d=<?php echo $myData['daily']; ?>&a=<?php echo "mobile";  ?>&id=<?php echo $id; ?>&t=<?php echo $title; ?>" target="_self" alt="Total"><u><?php echo $myData['mobile']; ?></u></a></td>
                                            <?php } ?> -->
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