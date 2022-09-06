<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=Document-Add";
?>
<div class="right_col" role="main">

  <?php
  # Tombol cancel
  if (isset($_POST['btnCancel'])) {
    echo "<meta http-equiv='refresh' content='0; url=?page=Category'>";
  }
  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    if (trim($_POST['txtCategory']) == "") {
      $pesanError[] = "<b>Category</b> data can not be empty !";
    }



    # BACA DATA DALAM FORM, masukkan datake variabel
    $mySql  = "SELECT * FROM master_code WHERE code_table='document'";
    $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
    $myData = mysqli_fetch_array($myQry);
    $dataCode  = buatCode($myData['code_table'], $myData['code_name']);

    $dataVersion  = $_POST['txtVersion'];
    $dataYear  = $_POST['txtYear'];
    $dataAuthor  = $_POST['txtAuthor'];
    $dataPublisher  = $_POST['txtPublisher'];
    $dataRack  = $_POST['txtRack'];
    $dataCategory  = $_POST['txtCategory'];
    $dataDate    = $_POST['txtDate'];
    $dataKeyword  = $_POST['txtKeyword'];
    $dataTitleID  = $_POST['txtTitleID'];
    $dataTitleEN  = $_POST['txtTitleEN'];
    $dataDescID    = $_POST['txtDescID'];
    $dataDescEN    = $_POST['txtDescEN'];
    $dataStatus    = "Created";
    if ($_POST['txtExpireDate'] == "") {
      $dataExpireDate = date('Y-m-d', strtotime('+1 year', strtotime($dataDate)));
    } else {
      $dataExpireDate = $_POST['txtExpireDate'];
    }

    $file_cover = "photo.png";
    $wmax = 300;
    $hmax = 300;

    if ($_FILES['cover']['name'] != "") {

      $file_size2   = $_FILES['cover']['size'];
      $file_tmp2   = $_FILES['cover']['tmp_name'];
      $file_type2  = $_FILES['cover']['type'];
      $tmp2 = explode('.', $_FILES['cover']['name']);
      $file_ext2 = end($tmp2);



      // Valid extension
      $valid_ext = array('png', 'jpeg', 'jpg');
      $file_name   = $dataCode . '.' . $file_ext2;
      // Location
      $location = "../uploads/cover/" . $file_name;
      move_uploaded_file($_FILES["cover"]["tmp_name"], $location);
      // file extension
      $file_extension = pathinfo($location, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);

      // Check extension
      if (in_array($file_extension, $valid_ext)) {

        $file_cover = $file_name;
      } else {
        $pesanError[] = "Invalid file type.";
      }
    }

    # JIKA ADA PESAN ERROR DARI VALIDASI
    if (count($pesanError) >= 1) {
      echo "&nbsp;<div class='alert alert-warning'>";
      $noPesan = 0;
      foreach ($pesanError as $indeks => $pesan_tampil) {
        $noPesan++;
        echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
      }
      echo "</div>";
    } else {
      # SIMPAN DATA KE DATABASE. 
      // Jika tidak menemukan error, simpan data ke database

      // echo $file_cover;
      // exit;
      $ses_nama  = $_SESSION['SES_NAMA'];
      $mySql    = "INSERT INTO document (document_year, document_rack, document_publisher, document_author, document_cover, document_id, category_id, document_version, document_title_id, document_description_id, document_title_en, document_description_en, document_keyword, document_status, document_date, document_expire_date, updated_by, updated_date)
						VALUES ('$dataYear','$dataRack','$dataPublisher','$dataAuthor','$file_cover','$dataCode','$dataCategory','$dataVersion','$dataTitleID','$dataDescID','$dataTitleEN','$dataDescEN','$dataKeyword', '$dataStatus','$dataDate','$dataExpireDate','$ses_nama',now())";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query 1 " . mysqli_error($koneksidb));
      $mySql    = "INSERT INTO document_status (document_id, document_version, document_status, updated_by, updated_date)
						VALUES ('$dataCode','$dataVersion','$dataStatus','$ses_nama',now())";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query 2 " . mysqli_error($koneksidb));
      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Document-Files&id=" . $dataCode . "&v=" . $dataVersion . "'>";
      }
      exit;
    }
  } // Penutup Tombol Submit


  # MASUKKAN DATA KE VARIABEL
  $mySql  = "SELECT * FROM master_code WHERE code_table='document'";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
  $myData = mysqli_fetch_array($myQry);
  $dataCode    = buatCode($myData['code_table'], $myData['code_name']);
  $dataVersion  = '1';
  $dataCategory  = '';
  $dataDate    = '';
  $dataExpireDate  = '';
  $dataKeyword  = '';
  $dataTitleID  = '';
  $dataTitleEN  = '';
  $dataDescID  = '';
  $dataDescEN = '';
  ?>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
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
            <h2>Add New Data</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="?page=Document" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->

          <div class="x_content ">
            <!-- x_content -->
            <br />
            <div class="row">
              <div class="col-lg-2">
                <div class="form-group">
                  <label>Document ID</label>
                  <input class="form-control" name="txtCode" type="text" value="<?php echo $dataCode; ?>" maxlength="10" readonly="readonly" />
                </div>
              </div>
              <div class="col-lg-1">
                <div class="form-group">
                  <label>Ver.</label>
                  <input class="form-control" name="txtVersion" type="text" value="<?php echo $dataVersion; ?>" maxlength="1" readonly="readonly" />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Categories *</label>
                  <select name="txtCategory" class="select2_single form-control" required>
                    <?php
                    $mySql = "SELECT * FROM master_category Order by id ";
                    $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                    echo '<option value=""></option>';
                    while ($dataRow = mysqli_fetch_array($dataQry)) {
                      if ($dataRow['category_level_2'] != '') {
                        $dataCategory2 = '| ' . $dataRow['category_level_2'];
                      } else {
                        $dataCategory2 = '';
                      };
                      if ($dataRow['category_level_3'] != '') {
                        $dataCategory3 = '| ' . $dataRow['category_level_3'];
                      } else {
                        $dataCategory3 = '';
                      };
                      if ($dataRow['category_level_4'] != '') {
                        $dataCategory4 = '| ' . $dataRow['category_level_4'];
                      } else {
                        $dataCategory4 = '';
                      };
                      if ($dataRow['category_level_5'] != '') {
                        $dataCategory5 = '| ' . $dataRow['category_level_5'];
                      } else {
                        $dataCategory5 = '';
                      };
                      if ($dataRow['category_level_6'] != '') {
                        $dataCategory6 = '| ' . $dataRow['category_level_6'];
                      } else {
                        $dataCategory6 = '';
                      };
                      if ($dataRow['category_id'] == $dataUser) {
                        $cek = " selected";
                      } else {
                        $cek = "";
                      }
                      echo "<option value='$dataRow[category_id]' $cek>$dataRow[category_level_1] $dataCategory2 $dataCategory3 $dataCategory4 $dataCategory5 $dataCategory6</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-lg-1">
                <div class="form-group">
                  <label>Year *</label>
                  <input class="form-control" name="txtYear" placeholder="Year Book" type="number" value="<?php echo $dataYear; ?>" min="0" max="<?php echo date('Y') + 1; ?>" required />
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <label>Document Date *</label>
                  <input id='tanggal' class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtDate" type="text" value="<?php echo $dataDate; ?>" maxlength="20" required="required" autocomplete="off" />
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <label>Expire Date </label>
                  <input id='tanggal2' class="datetime-picker form-control" placeholder="YYYY-MM-DD" name="txtExpireDate" type="text" value="<?php echo $dataExpireDate; ?>" autocomplete="off" />
                </div>
              </div>
              <div class="col-lg-1">
                <div class="form-group">
                  <label>Rack </label>
                  <input class="form-control" name="txtRack" placeholder="Rack" type="text" value="<?php echo $dataRack; ?>" maxlength="10" />
                </div>
              </div>
              <div hidden class="col-lg-1">
                <div class="form-group">
                  <label>Status</label>
                  <select name="txtStatus" class="form-control">
                    <?php

                    $mySql = "SELECT * FROM master_status WHERE status_group='Document' and status_name='Created' ";
                    $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                    while ($dataRow = mysqli_fetch_array($dataQry)) {
                      if ($dataRow['status_name'] == $dataStatus) {
                        $cek = " selected";
                      } else {
                        $cek = "";
                      }
                      echo "<option value='$dataRow[status_name]' $cek>$dataRow[status_name]</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Author *</label>
                  <input class="form-control" placeholder="Author" name="txtAuthor" type="text" value="<?php echo $dataAuthor; ?>" maxlength="255" required="required" />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Publisher *</label>
                  <input class="form-control" placeholder="Publisher" name="txtPublisher" type="text" value="<?php echo $dataPublisher; ?>" maxlength="255" required="required" />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Keyword</label>
                  <input class="form-control" placeholder="Keyword" name="txtKeyword" type="text" value="<?php echo $dataKeyword; ?>" maxlength="255" />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Cover</label>
                  <input class="form-control" type="file" name="cover">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Title (Bahasa) *</label>
                <input class="form-control" placeholder="Title (Bahasa)" name="txtTitleID" type="text" value="<?php echo $dataTitleID; ?>" maxlength="255" required="required" />
              </div>
              <div class="form-group">
                <label>Description (Bahasa)</label>
                <textarea class="form-control" placeholder="Description (Bahasa)" name="txtDescID" rows="5"><?php echo $dataDescID; ?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Title (English) *</label>
                <input class="form-control" placeholder="Title (English)" name="txtTitleEN" type="text" value="<?php echo $dataTitleEN; ?>" maxlength="255" required="required" />
              </div>
              <div class="form-group">
                <label>Description (English)</label>
                <textarea class="form-control" placeholder="Description (English)" name="txtDescEN" rows="5"><?php echo $dataDescID; ?></textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="ln_solid"></div>
              <a href="?page=Category" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
              <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-check-square-o fa-fw"></i> Submit</button>
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