<?php
include_once "library/inc.seslogin.php";
include "header.php";

?>
<div class="right_col" role="main">

  <?php

  $Code  = isset($_GET['id']) ?  $_GET['id'] : '';
  $Version  = isset($_GET['v']) ?  $_GET['v'] : '';
  $mySql  = "SELECT * from view_document WHERE  document_id='$Code' and document_version=(select max(document_version) from view_document where  document_id='$Code' )";
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

  if (isset($_POST['btnTambah'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();

    # BACA DATA DALAM FORM, masukkan datake variabel
    $dataCode           = $_POST['txtCode'];
    //$dataVersion       		= '';
    if ($_POST['txtDivision'] == "") {
      $dataDivision = '{null}';
    } else {
      $dataDivision = $_POST['txtDivision'];
    }
    if ($_POST['txtDepartment'] == "") {
      $dataDepartment = '{null}';
    } else {
      $dataDepartment = $_POST['txtDepartment'];
    }
    if ($_POST['txtUnit'] == "") {
      $dataUnit = '{null}';
    } else {
      $dataUnit = $_POST['txtUnit'];
    }
    if ($_POST['txtEmployee'] == "") {
      $dataEmployee = '{null}';
    } else {
      $dataEmployee = $_POST['txtEmployee'];
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
      $_SESSION['SES_KODE'] = $dataCode;
      $ses_nama  = $_SESSION['SES_NAMA'];
      if ($dataDivision == '{null}' && $dataDepartment == '{null}' && $dataUnit == '{null}' && $dataEmployee == '{null}') {
      } else {
        $mySql    = "INSERT INTO document_privileges(document_id, document_version, division, department, unit, user_id, updated_by, updated_date)
							VALUES ('$dataCode','$dataVersion','$dataDivision','$dataDepartment','$dataUnit','$dataEmployee', '$ses_nama',now())";
        $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
        if ($myQry) {
          echo "<meta http-equiv='refresh' content='0; url=?page=Document-Privileges-Edit&id=" . $dataCode . "'>";
        }
        exit;
      }
    }
  } // Penutup Tombol Submit Document

  if (isset($_POST['btnTambahFiles'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();

    # BACA DATA DALAM FORM, masukkan datake variabel
    $dataCode           = $_POST['txtCode'];
    $dataVersion           = '';
    $dataFiles          = $_POST['txtFiles'];
    if ($_POST['txtFilesDivision'] == "") {
      $dataFilesDivision = '{null}';
    } else {
      $dataFilesDivision = $_POST['txtFilesDivision'];
    }
    if ($_POST['txtFilesDepartment'] == "") {
      $dataFilesDepartment = '{null}';
    } else {
      $dataFilesDepartment = $_POST['txtFilesDepartment'];
    }
    if ($_POST['txtFilesUnit'] == "") {
      $dataFilesUnit = '{null}';
    } else {
      $dataFilesUnit = $_POST['txtFilesUnit'];
    }
    if ($_POST['txtFilesEmployee'] == "") {
      $dataFilesEmployee = '{null}';
    } else {
      $dataFilesEmployee = $_POST['txtFilesEmployee'];
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
      $_SESSION['SES_KODE'] = $dataCode;
      $ses_nama  = $_SESSION['SES_NAMA'];
      if ($dataFiles != "") {
        $mySql    = "INSERT INTO document_files_privileges(document_id, document_version, document_file_title, division, department, unit, user_id, updated_by, updated_date)
						VALUES ('$dataCode','$dataVersion','$dataFiles','$dataFilesDivision','$dataFilesDepartment','$dataFilesUnit','$dataFilesEmployee', '$ses_nama',now())";
        $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
        if ($myQry) {
          echo "<meta http-equiv='refresh' content='0; url=?page=Document-Privileges-Edit&id=" . $dataCode . "'>";
        }
        exit;
      }
    }
  } // Penutup Tombol Submit Files



  ?>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
    <div class="page-title">
      <!-- page-title -->
      <div class="title_left">
        <h3>Document Privileges</h3>
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
            <div class="col-sm-2">
              <div class="form-group">
                <label>Document ID</label><br /><?php echo $dataCode; ?>&nbsp;
                <input class="form-control" name="txtCode" type="hidden" value="<?php echo $dataCode; ?>" maxlength="10" readonly="readonly" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Title (Bahasa)</label><br /><?php echo $dataTitleID; ?>&nbsp;
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Categories</label><br /><?php echo $Category; ?>&nbsp;
              </div>
            </div>





            <div class="col-xs-12">
              <div class="ln_solid"></div>
            </div>
            <div class="col-xs-12">

              <h4><b>Document Privileges</b></h4>
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Bagian *</label>
                    <select name="txtDivision" class="select2_single  form-control" tabindex="-1">
                      <?php
                      echo '<option value=""></option>';
                      $mySql = "SELECT division FROM master_organization group by division order by division ";
                      $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                      while ($dataRow = mysqli_fetch_array($dataQry)) {
                        if ($dataRow['division'] == $datadivision) {
                          $cek = " selected";
                        } else {
                          $cek = "";
                        }
                        echo "<option value='$dataRow[division]' $cek>$dataRow[division]</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label>Unit *</label>
                    <select name="txtDepartment" class="select2_single  form-control" tabindex="-1">
                      <?php
                      echo '<option value=""></option>';
                      $mySql = "SELECT department FROM master_organization group by department order by department ";
                      $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                      while ($dataRow = mysqli_fetch_array($dataQry)) {
                        if ($dataRow['department'] == $datadepartment) {
                          $cek = " selected";
                        } else {
                          $cek = "";
                        }
                        echo "<option value='$dataRow[department]' $cek>$dataRow[department]</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label>Prodi *</label>
                    <select name="txtUnit" class="select2_single  form-control" tabindex="-1">
                      <?php
                      echo '<option value=""></option>';
                      $mySql = "SELECT unit FROM master_organization group by unit order by unit ";
                      $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                      while ($dataRow = mysqli_fetch_array($dataQry)) {
                        if ($dataRow['unit'] == $dataunit) {
                          $cek = " selected";
                        } else {
                          $cek = "";
                        }
                        echo "<option value='$dataRow[unit]' $cek>$dataRow[unit]</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Employee *</label>

                    <?php // get the users
                    $select_box = "<select name=\"txtEmployee\" id=\"txtemployee\"  class=\"select2_single  form-control\" >
								<option value=\"\"></option>";
                    $mySql = "SELECT user_id, user_fullname FROM master_user where user_status='Active' order by user_id";
                    $dataQry = mysqli_query($koneksidb, $mySql) or die("Error Query" . mysqli_error($koneksidb));
                    $result = mysqli_query($koneksidb, $mySql) or die('Query failed: Could not get list of user : ' . mysqli_error($con)); // query
                    while ($row = mysqli_fetch_array($result)) {
                      foreach ($row as $key => $value) {
                        ${$key} = $value;
                      }
                      $space = "";
                      $id = $row['user_id'];
                      $name = $row['user_fullname'];

                      $select_box .= "<option value=\"$id\">$id $name</option>";
                    }
                    $select_box .= "</select>";
                    echo $select_box;
                    ?>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label>&nbsp;</label><br />
                    <button type="submit" class="btn btn-primary btn-sm" name="btnTambah" style="width:100%"><i class="fa fa-plus-square fa-fw"></i> Add Data</button>
                  </div>
                </div>
              </div>
              <div class="x_content col-xs-12">
                <table id="datatable-responsive-x" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Bagian</th>
                      <th>Unit</th>
                      <th>Prodi</th>
                      <th>Employee</th>
                      <th>Updated By</th>
                      <th>Updated Date</th>
                      <th>Delete</th>
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
                        <td><a href="?page=Document-Privileges-Delete&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>&id2=<?php echo $ID; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!--- Files --->
              <div class="col-xs-12">
                <div class="ln_solid"></div>
              </div>
              <div class="col-xs-12">

                <h4><b>File Privileges</b></h4>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>File *</label>
                      <select name="txtFiles" class="select2_single  form-control" tabindex="-1">
                        <?php
                        echo '<option value=""></option>';
                        $mySql = "SELECT document_file_title FROM view_document_files WHERE  document_id='$Code' and document_version=(select max(document_version) from view_document where  document_id='$Code' ) group by document_file_title order by document_file_title";
                        $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                        while ($dataRow = mysqli_fetch_array($dataQry)) {
                          if ($dataRow['document_file_title'] == $dataFiles) {
                            $cek = " selected";
                          } else {
                            $cek = "";
                          }
                          echo "<option value='$dataRow[document_file_title]' $cek>$dataRow[document_file_title]</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Bagian *</label>
                      <select name="txtFilesDivision" class="select2_single  form-control" tabindex="-1">
                        <?php
                        echo '<option value=""></option>';
                        $mySql = "SELECT division FROM master_organization group by division order by division ";
                        $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                        while ($dataRow = mysqli_fetch_array($dataQry)) {
                          if ($dataRow['division'] == $datadivision) {
                            $cek = " selected";
                          } else {
                            $cek = "";
                          }
                          echo "<option value='$dataRow[division]' $cek>$dataRow[division]</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Unit *</label>
                      <select name="txtFilesDepartment" class="select2_single  form-control" tabindex="-1">
                        <?php
                        echo '<option value=""></option>';
                        $mySql = "SELECT department FROM master_organization group by department order by department ";
                        $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                        while ($dataRow = mysqli_fetch_array($dataQry)) {
                          if ($dataRow['department'] == $datadepartment) {
                            $cek = " selected";
                          } else {
                            $cek = "";
                          }
                          echo "<option value='$dataRow[department]' $cek>$dataRow[department]</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Prodi *</label>
                      <select name="txtFilesUnit" class="select2_single  form-control" tabindex="-1">
                        <?php
                        echo '<option value=""></option>';
                        $mySql = "SELECT unit FROM master_organization group by unit order by unit ";
                        $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                        while ($dataRow = mysqli_fetch_array($dataQry)) {
                          if ($dataRow['unit'] == $dataunit) {
                            $cek = " selected";
                          } else {
                            $cek = "";
                          }
                          echo "<option value='$dataRow[unit]' $cek>$dataRow[unit]</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Employee *</label>

                      <?php // get the users
                      $select_box = "<select name=\"txtFilesEmployee\" id=\"txtFilesEmployee\"  class=\"select2_single  form-control\" >
								<option value=\"\"></option>";
                      $mySql = "SELECT user_id, user_fullname FROM master_user where user_status='Active' order by user_id";
                      $dataQry = mysqli_query($koneksidb, $mySql) or die("Error Query" . mysqli_error($koneksidb));
                      $result = mysqli_query($koneksidb, $mySql) or die('Query failed: Could not get list of user : ' . mysqli_error($con)); // query
                      while ($row = mysqli_fetch_array($result)) {
                        foreach ($row as $key => $value) {
                          ${$key} = $value;
                        }
                        $space = "";
                        $id = $row['user_id'];
                        $name = $row['user_fullname'];

                        $select_box .= "<option value=\"$id\">$id $name</option>";
                      }
                      $select_box .= "</select>";
                      echo $select_box;
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>&nbsp;</label><br />
                      <button type="submit" class="btn btn-primary btn-sm" name="btnTambahFiles" style="width:100%"><i class="fa fa-plus-square fa-fw"></i> Add Data</button>
                    </div>
                  </div>
                </div>
                <div class="x_content col-xs-12">
                  <table id="datatable-responsive-x" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>File</th>
                        <th>Bagian</th>
                        <th>Unit</th>
                        <th>Prodi</th>
                        <th>Employee</th>
                        <th>Updated By</th>
                        <th>Updated Date</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $mySql   = "SELECT * FROM view_document_files_privileges WHERE document_id='$dataCode'  ORDER BY id";
                      $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                      $nomor  = 0;
                      while ($myData = mysqli_fetch_array($myQry)) {
                        $nomor++;
                        $ID = $myData['id'];
                      ?>

                        <tr>
                          <td><?php echo $nomor; ?></td>
                          <td><?php echo $myData['document_file_title']; ?></td>
                          <td><?php echo $myData['division']; ?></td>
                          <td><?php echo $myData['department']; ?></td>
                          <td><?php echo $myData['unit']; ?></td>
                          <td><?php echo $myData['user_id'] . ' ' . $myData['user_fullname']; ?></td>
                          <td><?php echo $myData['updated_by']; ?></td>
                          <td><?php echo $myData['updated_date']; ?></td>
                          <td><a href="?page=Document-Files-Privileges-Delete&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>&id2=<?php echo $ID; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
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