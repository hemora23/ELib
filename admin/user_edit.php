<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=User";
?>
<div class="right_col" role="main">

  <?php
  # Tombol cancel
  if (isset($_POST['btnCancel'])) {
    echo "<meta http-equiv='refresh' content='0; url=?page=User'>";
  }

  # TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
  $Code  = isset($_GET['id']) ?  $_GET['id'] : $_POST['txtCode'];
  $mySql  = "SELECT * FROM master_user WHERE user_id='$Code'";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
  $myData = mysqli_fetch_array($myQry);
  # MASUKKAN DATA KE VARIABEL
  $dataCode    = $myData['user_id'];
  $dataCompany    = isset($_POST['txtCompany']) ? $_POST['txtCompany'] : $myData['company_id'];
  $dataUsergroup  = isset($_POST['txtUsergroup']) ? $_POST['txtUsergroup'] : $myData['user_group'];
  $dataStatus    = isset($_POST['txtStatus']) ? $_POST['txtStatus'] : $myData['user_status'];
  $dataUsername  = isset($_POST['txtUsername']) ? $_POST['txtUsername'] : $myData['username'];
  $dataFullname  = isset($_POST['txtFullname']) ? $_POST['txtFullname'] : $myData['user_fullname'];
  $dataPassword  = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : $myData['password'];
  $dataPhoto    = $myData['user_photo'];
  $dataEmail    = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : $myData['user_email'];
  $dataPhone    = isset($_POST['txtPhone']) ? $_POST['txtPhone'] : $myData['user_phone'];
  $dataDivision  = isset($_POST['txtDivision']) ? $_POST['txtDivision'] : $myData['division'];
  $dataDepartment  = isset($_POST['txtDepartment']) ? $_POST['txtDepartment'] : $myData['department'];
  $dataUnit  = isset($_POST['txtUnit']) ? $_POST['txtUnit'] : $myData['unit'];
  $dataBranch  = isset($_POST['txtBranch']) ? $_POST['txtBranch'] : $myData['branch'];
  $dataPosition  = isset($_POST['txtPosition']) ? $_POST['txtPosition'] : $myData['position'];

  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    if (trim($_POST['txtUsername']) == "") {
      $pesanError[] = "Data <b>User</b> tidak boleh kosong !";
    }

    # upload file 
    $file_photo = $dataPhoto;
    $wmax = 300;
    $hmax = 300;

    //if (isset($_FILES['txtPhoto']['name'])){
    if ($_FILES['txtPhoto']['name'] != "") {
      $file_size   = $_FILES['txtPhoto']['size'];
      $file_tmp   = $_FILES['txtPhoto']['tmp_name'];
      $file_type  = $_FILES['txtPhoto']['type'];
      $file_ext  = strtolower(end(explode('.', $_FILES['txtPhoto']['name'])));
      $file_name   = $_POST['txtCode'] . "." . $file_ext;
      $file_photo = $file_name;
      $expensions = array("jpeg", "jpg", "png", "gif");
      if (in_array($file_ext, $expensions) === false) {
        $pesanError[] = "File hanya bisa format JPEG, GIF atau PNG";
      }
      if ($file_size > 2097152) {
        $pesanError[] = 'Ukuran file maksimum 2 MB';
      }
      if (empty($pesanError) == true) {

        $target_file = "../uploads/user/" . $file_name;
        move_uploaded_file($_FILES["txtPhoto"]["tmp_name"], $target_file);
      }
    }

    # BACA DATA DALAM FORM, masukkan datake variabel
    $txtCompany    = $_POST['txtCompany'];
    $txtUsergroup  = $_POST['txtUsergroup'];
    $txtStatus    = $_POST['txtStatus'];
    $txtUsername  = $_POST['txtUsername'];
    $txtFullname  = $_POST['txtFullname'];
    $txtPassword  = $_POST['txtPassword'];
    $txtPassLama  = $_POST['txtPassLama'];
    //$txtPhoto		= $file_photo;
    $txtEmail    = $_POST['txtEmail'];
    $txtPhone    = $_POST['txtPhone'];
    $txtDivision  = $_POST['txtDivision'];
    $txtDepartment  = $_POST['txtDepartment'];
    $txtUnit     = $_POST['txtUnit'];
    $txtBranch     = $_POST['txtBranch'];
    $txtPosition  = $_POST['txtPosition'];

    # VALIDASI USER LOGIN (USERNAME), jika sudah ada akan ditolak
    //$mySql="SELECT * FROM master_user WHERE user_name='$txtUsername' AND NOT(user_name='".$_POST['txtUsernameLm']."')";
    //$cekQry=mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error()); 
    //if(mysqli_num_rows($cekQry)>=1){
    //	$pesanError[] = "USERNAME<b> $txtUsername </b> sudah ada, ganti dengan yang lain";
    //}

    # Cek Password baru
    if (trim($txtPassword) == "") {
      $sqlPasword = ", password='$txtPassLama'";
    } else {
      $sqlPasword = ",  password ='" . md5($txtPassword) . "'";
      if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $txtPassword)) {
      } else {
        $pesanError[] = "Data <b>Password</b> minimal 8 karakter, ada huruf besar, huruf dan angka !";
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
      $kodeBaru  = $_POST['txtCode'];
      $ses_nama  = $_SESSION['SES_NAMA'];
      $mySql    = "UPDATE master_user SET branch='$txtBranch', division='$txtDivision',department='$txtDepartment',unit='$txtUnit',
						position='$txtPosition',username ='$txtUsername', user_fullname='$txtFullname', user_group='$txtUsergroup', user_email='$txtEmail', 
						user_photo='$file_photo', user_status='$txtStatus', company_id='$txtCompany',updated_by='$ses_nama'  , updated_date=now(),
						user_phone='$txtPhone' 
					    $sqlPasword 
						WHERE user_id = '$kodeBaru'";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());
      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=User'>";
      }
      exit;
    }
  } // Penutup Tombol Submit




  ?>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
    <div class="page-title">
      <!-- page-title -->
      <div class="title_left">
        <h3>User</h3>
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
            <h2>Edit Data</h2>
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
                <label>ID Anggota</label>
                <input class="form-control" name="txtCode" type="text" value="<?php echo $dataCode; ?>" maxlength="20" readonly />
              </div>
              <div class="form-group">
                <label>Access <span class="required">*</span></label>
                <select name="txtCompany" class="form-control">
                  <?php

                  $mySql = "SELECT * FROM master_company ";
                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                  while ($dataRow = mysqli_fetch_array($dataQry)) {
                    if ($dataRow['company_id'] == $dataCompany) {
                      $cek = " selected";
                    } else {
                      $cek = "";
                    }
                    echo "<option value='$dataRow[company_id]' $cek>$dataRow[company_name]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Access Group</label>
                <select name="txtUsergroup" class="form-control" tabindex="-1">
                  <?php

                  $mySql = "SELECT * FROM master_status where status_group='user_group' order by status_name desc";
                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                  while ($dataRow = mysqli_fetch_array($dataQry)) {
                    if ($dataRow['status_name'] == $dataUsergroup) {
                      $cek = " selected";
                    } else {
                      $cek = "";
                    }
                    echo "<option value='$dataRow[status_name]' $cek>$dataRow[status_name]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select name="txtStatus" class="form-control" tabindex="-1">
                  <?php

                  $mySql = "SELECT * FROM master_status WHERE status_group='Data' ";
                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
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
            <div class="col-sm-3">
              <div class="form-group">
                <label>Name <span class="required">*</span></label>
                <input class="form-control" placeholder="Name" name="txtFullname" type="text" value="<?php echo $dataFullname; ?>" maxlength="100" required />
              </div>
              <div class="form-group">
                <label>Phone <span class="required">*</span></label>
                <input class="form-control" placeholder="Phone" name="txtPhone" type="text" value="<?php echo $dataPhone; ?>" maxlength="100" required />
              </div>
              <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <input class="form-control" placeholder="Email" name="txtEmail" type="text" value="<?php echo $dataEmail; ?>" maxlength="100" required />
              </div>
              <div class="form-group">
                <label>Institusi *</label>
                <select name="txtBranch" class="form-control" tabindex="-1">
                  <?php

                  $mySql = "SELECT branch FROM master_organization GROUP By branch ";
                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                  while ($dataRow = mysqli_fetch_array($dataQry)) {
                    if ($dataRow['branch'] == $dataBranch) {
                      $cek = " selected";
                    } else {
                      $cek = "";
                    }
                    echo "<option value='$dataRow[branch]' $cek>$dataRow[branch]</option>";
                  }
                  ?>
                </select>
              </div>


            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Bagian *</label>
                <select name="txtDivision" class="form-control" tabindex="-1">
                  <?php

                  $mySql = "SELECT division FROM master_organization GROUP BY division ORDER BY division ";
                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                  while ($dataRow = mysqli_fetch_array($dataQry)) {
                    if ($dataRow['division'] == $dataDivision) {
                      $cek = " selected";
                    } else {
                      $cek = "";
                    }
                    echo "<option value='$dataRow[division]' $cek>$dataRow[division]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Unit *</label>
                <select name="txtDepartment" class="form-control" tabindex="-1">
                  <?php

                  $mySql = "SELECT department FROM master_organization GROUP BY department ORDER BY department ";
                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                  while ($dataRow = mysqli_fetch_array($dataQry)) {
                    if ($dataRow['department'] == $dataDepartment) {
                      $cek = " selected";
                    } else {
                      $cek = "";
                    }
                    echo "<option value='$dataRow[department]' $cek>$dataRow[department]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Prodi </label>
                <select name="txtUnit" class="form-control" tabindex="-1">
                  <?php

                  $mySql = "SELECT unit FROM master_organization GROUP BY unit ORDER BY unit ";
                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                  while ($dataRow = mysqli_fetch_array($dataQry)) {
                    if ($dataRow['unit'] == $dataUnit) {
                      $cek = " selected";
                    } else {
                      $cek = "";
                    }
                    echo "<option value='$dataRow[unit]' $cek>$dataRow[unit]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Position</label>
                <select name="txtPosition" class="form-control" tabindex="-1">
                  <?php
                  $position = $_SESSION['SES_POSITION'];

                  $mySql = "SELECT position FROM master_position ";
                  if ($position != 'Super Admin') {
                    $mySql .= "where position != 'Super Admin' ";
                  }
                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error());
                  while ($dataRow = mysqli_fetch_array($dataQry)) {
                    if ($dataRow['position'] == $dataPosition) {
                      $cek = " selected";
                    } else {
                      $cek = "";
                    }
                    echo "<option value='$dataRow[position]' $cek>$dataRow[position]</option>";
                  }
                  ?>
                </select>
              </div>


            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Username <span class="required">*</span></label>
                <input class="form-control" placeholder="Username" name="txtUsername" type="text" value="<?php echo $dataUsername; ?>" maxlength="100" required />
              </div>
              <div class="form-group">
                <label>Password <span class="required">*</span></label>
                <input class="form-control" name="txtPassword" type="password" value="" maxlength="100" />
                <input name="txtPassLama" type="hidden" value="<?php echo $dataPassword; ?>" />
              </div>
              <div class="form-group">
                <label>Photo <span class="required">*</span></label>
                <input class="form-control" type="file" name="txtPhoto" id="txtPhoto" value="<?php echo $dataPhoto; ?>" />

              </div>
              <div class="form-group">
                <img src=<?php echo "../uploads/user/" . $myData['user_photo']; ?> alt="..." class="img-circle" height="50px">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="ln_solid"></div>
              <div class="col-xs-6" align="left">
                <a href="?page=User" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
                <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-check-square-o fa-fw"></i> Submit</button>
              </div>
              <div class="col-xs-6" align="right">
                Last updated : <?php echo $myData['updated_by']; ?> ( <?php echo $myData['updated_date']; ?> )
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