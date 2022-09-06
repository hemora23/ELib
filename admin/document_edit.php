<?php
include_once "library/inc.seslogin.php";
include "header.php";
$Code  = isset($_GET['id']) ?  $_GET['id'] : $_POST['txtCode'];
$Version  = isset($_GET['v']) ?  $_GET['v'] : $_POST['txtVersion'];
$_SESSION['SES_PAGE'] = "?page=Document-Edit&id=" . $Code . "&v=" . $Version;
?>
<div class="right_col" role="main">

  <?php
  # MASUKKAN DATA KE VARIABEL
  $Code  = isset($_GET['id']) ?  $_GET['id'] : $_POST['txtCode'];
  $Version  = isset($_GET['v']) ?  $_GET['v'] : $_POST['txtVersion'];
  $mySql  = "SELECT * FROM document WHERE document_id='$Code' and document_version='$Version'";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
  $myData = mysqli_fetch_array($myQry);
  $dataCode    = $myData['document_id'];
  $dataStatus    = $myData['document_status'];
  $dataVersionOld  = $myData['document_version'];

  if ($dataStatus  == "Created" || $dataStatus  == "Updated" || $dataStatus  == "Revised") {
    $dataVersion  = $myData['document_version'];
  } else {
    $mySql2  = "SELECT max(document_version)+1 as version FROM document WHERE document_id='$Code'";
    $myQry2  = mysqli_query($koneksidb, $mySql2)  or die("Query ambil data salah : " . mysqli_error($koneksidb, $mySql));
    $myData2 = mysqli_fetch_array($myQry2);
    $dataVersion  = $myData2['version'];
  }
  $dataCategory  = $myData['category_id'];
  $dataDate    = $myData['document_date'];
  $dataExpireDate  = $myData['document_expire_date'];
  $dataKeyword  = $myData['document_keyword'];
  $dataTitleID  = $myData['document_title_id'];
  $dataTitleEN  = $myData['document_title_en'];
  $dataDescID    = $myData['document_description_id'];
  $dataDescEN    = $myData['document_description_en'];
  $dataChange    = '';
  $dataYear  = $myData['document_year'];
  $dataAuthor  = $myData['document_author'];
  $dataPublisher  = $myData['document_publisher'];
  $dataRack  = $myData['document_rack'];
  $dataCover  = $myData['document_cover'];


  # Tombol cancel
  if (isset($_POST['btnCancel'])) {
    echo "<meta http-equiv='refresh' content='0; url=?page=Category'>";
  }
  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    # BACA DATA DALAM FORM, masukkan datake variabel


    $dataVersion  = $_POST['txtVersion'];
    $dataVersionOld  = $_POST['txtVersionOld'];
    $dataCategory  = $_POST['txtCategory'];
    $dataDate    = $_POST['txtDate'];
    $dataExpireDate  = $_POST['txtExpireDate'];
    $dataKeyword  = $_POST['txtKeyword'];
    $dataTitleID  = $_POST['txtTitleID'];
    $dataTitleEN  = $_POST['txtTitleEN'];
    $dataDescID    = $_POST['txtDescID'];
    $dataDescEN    = $_POST['txtDescEN'];
    $dataStatus    = 'Updated'; //$_POST['txtStatus'];
    $dataStatusOld  = $_POST['txtStatus'];
    $dataCode    = $_POST['txtCode'];
    $dataChange    = $_POST['txtChange'];
    $dataYear  = $_POST['txtYear'];
    $dataAuthor  = $_POST['txtAuthor'];
    $dataPublisher  = $_POST['txtPublisher'];
    $dataRack  = $_POST['txtRack'];

    if (trim($_POST['txtCategory']) == "") {
      $pesanError[] = "<b>Category</b> data can not be empty !";
    }
    if ($dataStatusOld  == "Reviewed") {
      $pesanError[] = "Data sedang direview tidak bisa diedit !";
    }

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

        $dataCover = $file_name;
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



      $ses_nama  = $_SESSION['SES_NAMA'];



      if ($dataStatusOld  == "Created" || $dataStatusOld  == "Updated" || $dataStatusOld  == "Revised") {

        $mySql    = "UPDATE document  SET category_id='$dataCategory',document_version='$dataVersion',document_title_id='$dataTitleID',
						document_description_id='$dataDescID',document_title_en='$dataTitleEN', document_description_en='$dataDescEN',
						document_keyword='$dataKeyword', document_status='$dataStatus', document_date='$dataDate', 
						document_expire_date='$dataExpireDate', document_change_history='$dataChange', updated_by='$ses_nama', 
						updated_date=now()
						WHERE document_id='$dataCode' and document_version='$dataVersionOld'";
        $myQry = mysqli_query($koneksidb, $mySql) or die("Error query 1 " . mysqli_error($koneksidb));
      } else {

        $mySql    = "INSERT INTO document_archive (select * from document where document_id='$dataCode' and document_version='$dataVersionOld')";
        $myQry = mysqli_query($koneksidb, $mySql) or die("Error query 11 " . mysqli_error($koneksidb));

        $mySql    = "INSERT INTO document (document_year, document_rack, document_publisher, document_author, document_cover, document_id, category_id, document_version, document_title_id, document_description_id, document_title_en, document_description_en, document_keyword, document_status, document_date, document_expire_date, document_change_history, updated_by, updated_date)
						VALUES ('$dataYear','$dataRack','$dataPublisher','$dataAuthor','$dataCover','$dataCode','$dataCategory','$dataVersion','$dataTitleID','$dataDescID','$dataTitleEN','$dataDescEN','$dataKeyword', '$dataStatus','$dataDate','$dataExpireDate','$dataChange','$ses_nama',now())";
        $myQry = mysqli_query($koneksidb, $mySql) or die("Error query 2 " . mysqli_error($koneksidb));



        // insert document_files
        $mySql    = "INSERT INTO document_files (document_id, document_version, document_file_name, document_file_title, document_file_ext, document_size, document_bulkid, document_order, updated_by, updated_date)(select document_id, '" . $dataVersion . "', document_file_name, document_file_title, document_file_ext, document_size, document_bulkid, document_order, updated_by, updated_date from document_files where document_id='$dataCode' and document_version='$dataVersionOld')";
        $myQry = mysqli_query($koneksidb, $mySql) or die("Error query 3 " . mysqli_error($koneksidb));

        // insert document_files_index
        // $mySql    = "INSERT INTO document_files_index (document_id, document_version, document_file_name, document_file_title, document_file_ext, document_size, document_bulkid, updated_by, updated_date)(select document_id, '" . $dataVersion . "', document_file_name, document_file_title, document_file_ext, document_size, document_bulkid, updated_by, updated_date from document_files_index where document_id='$dataCode' and document_version='$dataVersionOld')";
        // $myQry = mysqli_query($koneksidb, $mySql) or die("Error query 4 " . mysqli_error($koneksidb));
      }


      $mySql    = "INSERT INTO document_status (document_id, document_version, document_status, updated_by, updated_date)
						VALUES ('$dataCode','$dataVersion','Updated','$ses_nama',now())";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query 5" . mysqli_error($koneksidb));
      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Document-Files&id=" . $dataCode . "&v=" . $dataVersion . "'>";
      }
      exit;
    }
  } // Penutup Tombol Submit




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
            <h2>Add New Data</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="?page=Document>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
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
                  <input class="form-control" name="txtVersionOld" type="hidden" value="<?php echo $dataVersionOld; ?>" />

                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Categories *</label>
                  <select name="txtCategory" class="select2_single form-control" required>

                    <?php

                    $mySql = "SELECT * FROM master_category Order by id ";
                    $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
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
                      if ($dataRow['category_id'] == $dataCategory) {
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
                  <input class="form-control" name="txtStatus" type="text" value="<?php echo $dataStatus; ?>" maxlength="1" readonly="readonly" />

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
                  <p><?php echo $dataCover; ?></p>
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
                <textarea class="form-control" placeholder="Description (English)" name="txtDescEN" rows="5"><?php echo $dataDescEN; ?></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Change History *</label>
                <input class="form-control" placeholder="Change History Desciption" name="txtChange" type="text" value="<?php echo $dataChange; ?>" maxlength="255" required="required" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="ln_solid"></div>
              <a href="?page=Document" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
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