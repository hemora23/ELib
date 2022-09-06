<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=Organization";
?>
<div class="right_col" role="main">

  <?php
  # Tombol cancel
  if (isset($_POST['btnCancel'])) {
    echo "<meta http-equiv='refresh' content='0; url=?page=Organization'>";
  }
  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();



    # BACA DATA DALAM FORM, masukkan datake variabel
    $txtDivision  = $_POST['txtDivision'];
    $txtDepartment  = $_POST['txtDepartment'];
    $txtUnit     = $_POST['txtUnit'];
    $txtBranch     = $_POST['txtBranch'];


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
      $mySql    = "INSERT INTO master_organization (branch,division,department,unit, updated_by ,updated_date)
						VALUES ('$txtBranch','$txtDivision','$txtDepartment','$txtUnit','$ses_nama',now())";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());
      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Organization'>";
      }
      exit;
    }
  } // Penutup Tombol Submit


  # MASUKKAN DATA KE VARIABEL


  $dataDivision  = isset($_POST['txtDivision']) ? $_POST['txtDivision'] : '';
  $dataDepartment  = isset($_POST['txtDepartment']) ? $_POST['txtDepartment'] : '';
  $dataUnit  = isset($_POST['txtUnit']) ? $_POST['txtUnit'] : '';
  $dataBranch  = isset($_POST['txtBranch']) ? $_POST['txtBranch'] : '';

  ?>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
    <div class="page-title">
      <!-- page-title -->
      <div class="title_left">
        <h3>Organization</h3>
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
              <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div><!-- /x_title -->

          <div class="x_content ">
            <!-- x_content -->
            <br />
            <div class="col-sm-3">

              <div class="form-group">
                <label for="pwd">Institusi</label>
                <input class="form-control" placeholder="Institusi" name="txtBranch" type="text" value="<?php echo $dataBranch; ?>" maxlength="255" />
              </div>

            </div>
            <div class="col-sm-3">

              <div class="form-group">
                <label for="pwd">Bagian</label>
                <input class="form-control" placeholder="Bagian" name="txtDivision" type="text" value="<?php echo $dataDivision; ?>" maxlength="255" />
              </div>

            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="pwd">Unit</label>
                <input class="form-control" placeholder="Unit" name="txtDepartment" type="text" value="<?php echo $dataDepartment; ?>" maxlength="255" />
              </div>

            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="pwd">Jurusan </label>
                <input class="form-control" placeholder="Jurusan" name="txtUnit" type="text" value="<?php echo $dataUnit; ?>" maxlength="244" />
              </div>

            </div>

            <div class="col-xs-12">
              <div class="ln_solid"></div>
              <a href="?page=Organization" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
              <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-check-square-o fa-fw"></i> Submit</button>
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