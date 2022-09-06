<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=Banner";
?>
<!-- page content -->
<div class="right_col" role="main">
  <?php
  # Tombol cancel
  if (isset($_POST['btnCancel'])) {
    echo "<meta http-equiv='refresh' content='0; url=?page=Sales'>";
  }
  $dataCode  = isset($_GET['id']) ?  $_GET['id'] : '';
  $dataVersion  = isset($_GET['v']) ?  $_GET['v'] : '';

  ?>

  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Upload Banner<small></small></h3>
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
            <h2>Upload PDF Files</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-xs-6">
              <h4>upload banner ( .jpg / min 1200 x 250 )</h4>
              <form action="upload_banner.php" class="dropzone">
                <input name="txtCode" type="hidden" value="<?php echo $dataCode; ?>" />
                <input name="txtVersion" type="hidden" value="<?php echo $dataVersion; ?>" />
                <input name="txtName" type="hidden" value="<?php echo $_SESSION['SES_NAMA']; ?>" />
              </form>
            </div>
            <div class="col-xs-6">
              <h4>Files (<a href="?page=Banner" role="button"><i class="fa fa-undo fa-fw"></i> <u>Refresh</u></a>)</h4>
              <table id="datatable-responsive-x" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Banner</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $mySql   = "SELECT * FROM master_banner ";
                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $code = $myData['id'];
                  ?>

                    <tr>
                      <td>
                        <img src="../uploads/<?php echo $myData['logo']; ?>" width="100%" />
                        <br /><br />
                        Updated By : <?php echo $myData['updated_by']; ?><br />
                        Updated Date : <?php echo $myData['updated_date']; ?><br />
                        <a href="?page=Banner-Delete&id=<?php echo $code; ?>" class="btn btn-danger btn-sm" role="button"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
                      </td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="col-xs-12">
              <br /><br />

            </div>

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