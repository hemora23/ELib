<?php
include_once "library/inc.seslogin.php";
include "header.php";
$dataCode  = isset($_GET['id']) ?  $_GET['id'] : '';
$dataVersion  = isset($_GET['v']) ?  $_GET['v'] : '';
$_SESSION['SES_PAGE'] = "?page=Document-Edit&id=" . $dataCode . "&v=" . $dataVersion;
?>
<!-- page content -->
<div class="right_col" role="main">
  <?php
  # Tombol cancel
  if (isset($_POST['btnCancel'])) {
    echo "<meta http-equiv='refresh' content='0; url=?page=Document'>";
  }
  $dataCode  = isset($_GET['id']) ?  $_GET['id'] : '';
  $dataVersion  = isset($_GET['v']) ?  $_GET['v'] : '';
  $mySql  = "SELECT document_status, document_version FROM document WHERE document_id='$dataCode' and document_version='$dataVersion'";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
  $myData = mysqli_fetch_array($myQry);
  $dataStatus    = $myData['document_status'];
  $dataVersionOld  = $myData['document_version'];
  if ($dataStatus  == "Reviewed") {
    echo "<meta http-equiv='refresh' content='0; url=?page=Document-Review'>";
  }
  ?>

  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Upload Document<small></small></h3>
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

            <div class="col-xs-12">
              <h4>upload files (text based)</h4>
              <form action="upload_index.php" class="dropzone">
                <input name="txtCode" type="hidden" value="<?php echo $dataCode; ?>" />
                <input name="txtVersion" type="hidden" value="<?php echo $dataVersion; ?>" />
                <input name="txtName" type="hidden" value="<?php echo $_SESSION['SES_NAMA']; ?>" />
              </form>
            </div>
            <div class="col-xs-12">
              <br /><br />
              <h4>Files (<a href="?page=Document-Files&id=<?php echo $dataCode; ?>&v=<?php echo $dataVersion; ?>" role="button"><i class="fa fa-undo fa-fw"></i> <u>Refresh</u></a>)</h4>
            </div>
            <!-- <?php
                  echo $dataVersion; ?>
            <br>
            <?php echo $dataCode; ?>
            <br>
            <?php echo $_SESSION['SES_NAMA'];
            ?> -->
            <div class="col-xs-12">
              <table id="datatable-responsive-x" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>File Name</th>
                    <th>Up</th>
                    <th>Dw</th>
                    <th>Del</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $mySql   = "SELECT * FROM document_files WHERE document_id='$dataCode' and document_version='$dataVersion' ORDER BY document_order,id";
                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                    $Code = $myData['id'];
                    $string = $myData['document_file_title'];
                    $title = (strlen($string) > 35) ? substr($string, 0, 32) . '...' : $string;
                    if ($Code <> '') {
                      $mySqlupdate    = "UPDATE document_files SET document_order='$nomor' WHERE id = '$Code'";
                      $myQryupdate = mysqli_query($koneksidb, $mySqlupdate) or die("Error query " . mysqli_error());
                    }
                  ?>

                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><a href="<?php echo $myData['document_file_name']; ?>"><?php echo $title; ?></a></td>
                      <td><a href="?page=Document-Files-Order&id=<?php echo $Code; ?>&id2=<?php echo $dataCode; ?>&v=<?php echo $dataVersion; ?>&o1=<?php echo $nomor; ?>&o2=<?php echo $nomor - 1; ?>" target="_self" alt="Up"><i class="fa fa-arrow-up fa-fw"></i></a></td>
                      <td><a href="?page=Document-Files-Order&id=<?php echo $Code; ?>&id2=<?php echo $dataCode; ?>&v=<?php echo $dataVersion; ?>&o1=<?php echo $nomor; ?>&o2=<?php echo $nomor + 1; ?>" target="_self" alt="Down"><i class="fa fa-arrow-down fa-fw"></i></a></td>
                      <td><a href="?page=Document-Files-Delete&id=<?php echo $Code; ?>&id2=<?php echo $dataCode; ?>&v=<?php echo $dataVersion; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i></a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

            <div class="col-xs-12">
              <div class="ln_solid"></div>
              <a href="?page=Document" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
              <a href="?page=Document" class="btn btn-primary btn-sm" role="button"><i class="fa fa-check-square-o fa-fw"></i> Submit</a>
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