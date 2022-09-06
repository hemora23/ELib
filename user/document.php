<?php
include_once "library/inc.seslogin.php";
include "header.php";
$Code  = isset($_GET['id']) ?  $_GET['id'] : '';
$Code2  = isset($_GET['id2']) ?  $_GET['id2'] : '';
$_SESSION['SES_PAGE'] = "?page=Document&id=" . $Code . "&id2=" . $Code2;
$_SESSION['SES_BACK'] = "?page=Document&id=" . $Code . "&id2=" . $Code2;

$mySql  = "SELECT * FROM master_category WHERE category_id='$Code'";
$myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
$myData = mysqli_fetch_array($myQry);
if ($myData['category_level_1'] != '') {
  $level1 = $myData['category_level_1'];
} else {
  $level1 = '';
};
if ($myData['category_level_2'] != '') {
  $level2 = ' / ' . $myData['category_level_2'];
} else {
  $level2 = '';
};
if ($myData['category_level_3'] != '') {
  $level3 = ' / ' . $myData['category_level_3'];
} else {
  $level3 = '';
};
if ($myData['category_level_4'] != '') {
  $level4 = ' / ' . $myData['category_level_4'];
} else {
  $level4 = '';
};
if ($myData['category_level_5'] != '') {
  $level5 = ' / ' . $myData['category_level_5'];
} else {
  $level5 = '';
};
if ($myData['category_level_6'] != '') {
  $level6 = ' / ' . $myData['category_level_6'];
} else {
  $level6 = '';
};
$category = $level1 . $level2 . $level3 . $level4 . $level5 . $level6;

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php echo $Code ?></h3>
      </div>
      <div class="title_right">
        <div class="form-group pull-right">
          <h6><a href="?page=Main"><i class="fa fa-home"></i> <?php echo _HOME ?></i></a></a> / <?php echo $Code2; ?> / <a href="?page=Document&id=<?php echo $Code; ?>&id2=<?php echo $Code2; ?>"><?php echo $Code; ?></a></h6>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="x_content">
              <ul class="nav navbar-left">

              </ul>

              <ul class="nav navbar-right">
                <a href="?page=Document&id=<?php echo $Code; ?>&id2=<?php echo $Code2; ?>" class="btn btn-default btn-sm" role="button" title="tree view"><img src="images/treeview.png" height="18" /></a>&nbsp;
                <a href="?page=Document-List&id=<?php echo $Code; ?>&id2=<?php echo $Code2; ?>" class="btn btn-default btn-sm" role="button" title="list view"><img src="images/list.png" height="18" /></a>&nbsp;
                <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> <?php echo _BACK; ?></a>
              </ul>

            </div>
            <div class="clearfix"></div>
          </div>

          <div class="x_content table-responsive">
            <div id="default-tree"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php
include "document_footer.php";
?>