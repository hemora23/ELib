<?php
include_once "library/inc.seslogin.php";
include "header.php";

?>
<div class="right_col" role="main">

  <?php
  $ses_nama    = $_SESSION['SES_NAMA'];
  $Code  = isset($_GET['id']) ?  $_GET['id'] : '';
  $Version  = isset($_GET['v']) ?  $_GET['v'] : '';
  $mySql    = "UPDATE document SET document_status='Reviewed', updated_by='$ses_nama'   , updated_date=now() 
				WHERE document_id = '$Code' and document_version='$Version'";
  $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());


  $mySql  = "SELECT * from view_document WHERE  document_id='$Code' and document_version='$Version' ";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
  $myData = mysqli_fetch_array($myQry);
  # MASUKKAN DATA KE VARIABEL

  $dataCode    = $myData['document_id'];
  $dataID      = $myData['document_id'];
  $dataVersion  = $myData['document_version'];
  $dataDate    = $myData['document_date'];
  $dataExpireDate  = $myData['document_expire_date'];
  $dataStatus    = $myData['document_status'];
  $dataCategory1 = $myData['category_level_1'];
  if ($myData['category_level_2'] != '') {
    $dataCategory2 = ' | ' . $myData['category_level_2'];
  } else {
    $dataCategory2 = '';
  };
  if ($myData['category_level_3'] != '') {
    $dataCategory3 = ' | ' . $myData['category_level_3'];
  } else {
    $dataCategory3 = '';
  };
  if ($myData['category_level_4'] != '') {
    $dataCategory4 = ' | ' . $myData['category_level_4'];
  } else {
    $dataCategory4 = '';
  };
  if ($myData['category_level_5'] != '') {
    $dataCategory5 = ' | ' . $myData['category_level_5'];
  } else {
    $dataCategory5 = '';
  };
  if ($myData['category_level_6'] != '') {
    $dataCategory6 = ' | ' . $myData['category_level_6'];
  } else {
    $dataCategory6 = '';
  };
  $Category = $dataCategory1 . $dataCategory2 . $dataCategory3 . $dataCategory4 . $dataCategory5 . $dataCategory6;
  $dataKeyword  = $myData['document_keyword'];
  $dataTitleID  = $myData['document_title_id'];
  $dataTitleEN  = $myData['document_title_en'];
  $dataDescID    = $myData['document_description_id'];
  $dataDescEN    = $myData['document_description_en'];
  $dataChange    = $myData['document_change_history'];
  $dataNote    = $myData['document_note'];
  $dataYear    = $myData['document_year'];
  $dataRack    = $myData['document_rack'];
  $dataPublisher    = $myData['document_publisher'];
  $dataAuthor    = $myData['document_author'];
  $dataCover    = $myData['document_cover'];


  if (isset($_POST['btnRevisi'])) {
    $dataNote = $_POST['txtNote'];
    $Status = "Revised";

    $mySql    = "UPDATE document SET document_status='$Status', document_note='$dataNote', updated_by='$ses_nama'   , updated_date=now() 
				WHERE document_id = '$dataCode' and document_version='$dataVersion'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());

    $mySql    = "INSERT INTO document_status (document_version, document_id, document_status, updated_by, updated_date) 
				VALUES  ('$dataVersion','$dataCode','$Status','$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Document-Approval'>";
    }
    exit;
  }

  if (isset($_POST['btnApprove'])) {
    $Status = "Approved";
    $dataNote = $_POST['txtNote'];

    $mySql    = "UPDATE document SET document_status='Deleted', updated_by='$ses_nama'   , updated_date=now() 
				WHERE document_id = '$dataCode' and document_version < '$dataVersion'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());

    $mySql    = "UPDATE document SET document_status='$Status', document_note='$dataNote', updated_by='$ses_nama'   , updated_date=now() 
				WHERE document_id = '$dataCode' and document_version='$dataVersion'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());

    $mySql    = "INSERT INTO document_status (document_version, document_id, document_status, updated_by, updated_date) 
				VALUES  ('$dataVersion','$dataCode','$Status','$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Document-Approval'>";
    }
    exit;
  }

  if (isset($_POST['btnReject'])) {
    $Status = "Rejected";
    $dataNote = $_POST['txtNote'];

    $mySql    = "UPDATE document SET document_status='$Status', document_note='$dataNote',updated_by='$ses_nama'   , updated_date=now() 
				WHERE document_id = '$dataCode' and document_version='$dataVersion'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());

    $mySql    = "INSERT INTO document_status (document_version, document_id, document_status, updated_by, updated_date) 
				VALUES  ('$dataVersion','$dataCode','$Status','$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Document-Approval'>";
    }
    exit;
  }

  if (isset($_POST['btnDelete'])) {
    $Status = "Deleted";
    $dataNote = $_POST['txtNote'];

    $mySql    = "UPDATE document SET document_status='$Status', document_note='$dataNote',updated_by='$ses_nama'   , updated_date=now() 
				WHERE document_id = '$dataCode' and document_version='$dataVersion'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());

    $mySql    = "INSERT INTO document_status (document_version, document_id, document_status, updated_by, updated_date) 
				VALUES  ('$dataVersion','$dataCode','$Status','$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Document-Approval'>";
    }
    exit;
  }




  ?>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
    <div class="page-title">
      <!-- page-title -->
      <div class="title_left">
        <h3>Document</h3>
      </div>
      <div class="title_right">
        <div class="form-group pull-right top_search">

        </div>
      </div>
    </div><!-- /page-title -->
    <div class="clearfix"></div>

    <div class="row">
      <!-- row -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <!-- x_panel -->

          <div class="x_title">
            <!-- x_title -->
            <h2>Detail Data</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->

          <div class="x_content ">
            <!-- x_content -->
            <br />
            <div class="col-sm-3">
              <div class="form-group">
                <img alt="center" style="width: 200px; height:auto;display:block; margin:auto; " src=<?php echo "../uploads/cover/" . $dataCover; ?> />
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group" style="margin-top: 225px;">
                <label>Document ID</label><br /><?php echo $dataCode; ?>&nbsp;
                <input class="form-control" name="txtCode" type="hidden" value="<?php echo $dataCode; ?>" maxlength="10" readonly="readonly" />
              </div>
            </div>
            <div class="col-sm-3" style="margin-top: 225px;">
              <div class=" form-group">
                <label>Version No.</label><br /><?php echo $dataVersion; ?>&nbsp;
                <input class="form-control" name="txtVersion" type="hidden" value="<?php echo $dataVersion; ?>" maxlength="10" readonly="readonly" />
              </div>
            </div>
            <div class="col-sm-3" style="margin-top: 225px;">
              <div class=" form-group">
                <label>Categories</label><br /><?php echo $Category; ?>&nbsp;
              </div>
            </div>
            <div class="col-xs-12">
              <div class="ln_solid"></div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Document Year </label><br /><?php echo $dataYear; ?>&nbsp;
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Document Date </label><br /><?php echo $dataDate; ?>&nbsp;
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Expire Date </label><br /><?php echo $dataExpireDate; ?>&nbsp;
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Document Rack </label><br /><?php echo $dataRack; ?>&nbsp;
              </div>
            </div>
            <div class="col-xs-12">
              <div class="ln_solid"></div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Author</label><br /><?php echo $dataAuthor; ?>&nbsp;
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Publisher</label><br /><?php echo $dataPublisher; ?>&nbsp;
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Keyword</label><br /><?php echo $dataKeyword; ?>&nbsp;
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Status </label><br /><?php echo $dataStatus; ?>&nbsp;
              </div>
            </div>

            <div class="col-xs-12">
              <div class="ln_solid"></div>
            </div>
            <div class="col-sm-6">

              <div class="form-group">
                <label>Title (Bahasa)</label><br /><?php echo $dataTitleID; ?>&nbsp;
              </div>
              <div class="form-group">
                <label>Description (Bahasa)</label><br /><?php echo $dataDescID; ?>&nbsp;
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Title (English)</label><br /><?php echo $dataTitleEN; ?>&nbsp;
              </div>
              <div class="form-group">
                <label>Description (English)</label><br /><?php echo $dataDescEN; ?>&nbsp;
              </div>
            </div>
            <div class="col-xs-12">
              <div class="ln_solid"></div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Change History </label><br /><?php echo $dataChange; ?>&nbsp;
              </div>

            </div>

            <div class="col-xs-12">
              <div class="ln_solid"></div>
            </div>
            <div class="col-xs-12">

              <p><b>Document Files (Scan Results / Tampil di user)</b></p>
              <div class="x_content col-xs-12">
                <table id="datatable-responsive-a" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>File Name</th>
                      <th>Type</th>
                      <th>Size</th>
                      <th>Updated By</th>
                      <th>Updated Date</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $mySql   = "SELECT * FROM document_files WHERE document_id='$dataCode' and document_version='$dataVersion' ORDER BY document_order";
                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                    $nomor  = 0;
                    while ($myData = mysqli_fetch_array($myQry)) {
                      $nomor++;
                    ?>

                      <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><a href="<?php echo $myData['document_file_name']; ?>"><?php echo $myData['document_file_title']; ?></a></td>
                        <td><?php echo $myData['document_file_ext']; ?></td>
                        <td><?php echo $myData['document_size']; ?></td>
                        <td><?php echo $myData['updated_by']; ?></td>
                        <td><?php echo $myData['updated_date']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <p><b>Status</b></p>
              <div class="x_content col-xs-12">
                <table id="datatable-responsive-b" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Status</th>
                      <th>Updated By</th>
                      <th>Updated Date</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $mySql   = "SELECT * FROM document_status WHERE document_id='$dataCode' and document_version='$dataVersion' ORDER BY updated_date";
                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                    $nomor  = 0;
                    while ($myData = mysqli_fetch_array($myQry)) {
                      $nomor++;
                    ?>

                      <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $myData['document_status']; ?></td>
                        <td><?php echo $myData['updated_by']; ?></td>
                        <td><?php echo $myData['updated_date']; ?></td>

                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <p><b>Privileges</b></p>
              <div class="x_content col-xs-12">
                <table id="datatable-responsive-c" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Division</th>
                      <th>Department</th>
                      <th>Unit</th>
                      <th>Employee</th>
                      <th>Updated By</th>
                      <th>Updated Date</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $mySql   = "SELECT * FROM view_document_privileges WHERE document_id='$dataCode'  ORDER BY id";
                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                    $nomor  = 0;
                    while ($myData = mysqli_fetch_array($myQry)) {
                      $nomor++;
                      $ID = $myData['id'];
                    ?>

                      <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $myData['division']; ?></td>
                        <td><?php echo $myData['department']; ?></td>
                        <td><?php echo $myData['unit']; ?></td>
                        <td><?php echo $myData['user_id'] . ' ' . $myData['user_fullname']; ?></td>
                        <td><?php echo $myData['updated_by']; ?></td>
                        <td><?php echo $myData['updated_date']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Note *</label>
                    <input class="form-control" placeholder="Note" name="txtNote" type="text" value="<?php echo $dataNote; ?>" maxlength="255" required="required" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="ln_solid"></div>
                  <button type="submit" class="btn btn-warning btn-sm" name="btnRevisi"><i class="fa fa-undo fa-fw"></i> Revised</button>
                  <?php
                  $mySql  = "SELECT count(*) as total from document_status WHERE  document_status='Request Delete' and document_id='$Code' 
						  	and document_version='$Version' ";
                  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
                  $myData = mysqli_fetch_array($myQry);
                  $requestdelete    = $myData['total'];
                  if ($requestdelete < 1) {
                  ?>
                    <button type="submit" class="btn btn-primary btn-sm" name="btnApprove"><i class="fa fa-check-square-o fa-fw"></i> Approved</button>
                    <button type="submit" class="btn btn-danger btn-sm" name="btnReject"><i class="fa fa-ban fa-fw"></i> Rejected</button>
                  <?php } else { ?>
                    <button type="submit" class="btn btn-danger btn-sm" name="btnDelete"><i class="fa fa-trash fa-fw"></i> Deleted</button>
                  <?php } ?>
                </div>
              </div>

            </div>
          </div>
        </div><!-- /x_content -->

      </div><!-- /x_panel -->
    </div>
</div><!-- /row -->
</div>
<!-- /page content -->
</form>
<?php
include "footer.php";
?>