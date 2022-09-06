<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=Profile";

$Code  = $_SESSION['SES_LOGIN'];
$mySql  = "SELECT * FROM master_user u, master_company c WHERE u.company_id=c.company_id AND u.username='$Code'";
$myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
$myData = mysqli_fetch_array($myQry);
# MASUKKAN DATA KE VARIABEL
$dataCode    = $myData['user_id'];
$dataCompanyName = isset($_POST['txtCompany']) ? $_POST['txtCompany'] : $myData['company_name'];
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

?>
<div class="right_col" role="main">
  <div class="">
    <?php
    # Tombol Submit diklik
    if (isset($_POST['btnSubmit'])) {
      # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
      $pesanError = array();
      if (trim($_POST['txtPassword']) != trim($_POST['txtPassword'])) {
        $pesanError[] = "Data <b>Password Baru</b> tidak sama !";
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

      $txtPassword  = $_POST['txtPassword'];
      $txtPassLama  = $_POST['txtPassLama'];
      //$txtPhoto		= $file_photo;	
      $txtEmail    = $_POST['txtEmail'];
      $txtPhone    = $_POST['txtPhone'];
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
        $sqlPasword = ",  password='" . md5($txtPassword) . "'";
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


        // echo $sqlPasword;
        // exit;
        # SIMPAN DATA KE DATABASE. 
        // Jika tidak menemukan error, simpan data ke database
        $kodeBaru  = $_POST['txtCode'];
        $ses_nama  = $_SESSION['SES_NAMA'];
        $mySql    = "UPDATE master_user SET user_email='$txtEmail', user_photo='$file_photo', updated_by='$ses_nama'  , updated_date=now(),  user_phone='$txtPhone' 
					    $sqlPasword 
						WHERE user_id = '$kodeBaru'";
        $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());
        if ($myQry) {
          echo "<meta http-equiv='refresh' content='0; url=?page=Profile'>";
        }
        exit;
      }
    } // Penutup Tombol Submit

    ?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
      <!-- page content -->

      <div class="page-title">
        <div class="title_left">
          <h3><?php echo _USERPROFILE; ?></h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              &nbsp;
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2><?php echo _USERPROFILE; ?><small></small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content table-responsive">
              <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                <div class="profile_img">
                  <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive avatar-view img-circle " src=<?php echo "../uploads/user/" . $dataPhoto; ?> alt="Avatar" title="Change the avatar">

                  </div>
                </div>
                <h3><?php echo $dataFullname; ?></h3>

                <ul class="list-unstyled user_data">
                  <li><?php echo $dataCompanyName; ?></li>
                  <li><?php echo $dataBranch; ?></li>
                  <li><?php echo $dataDivision; ?></li>
                  <li><?php echo $dataDepartment; ?></li>
                  <li><?php echo $dataUnit; ?></li>
                  <li><?php echo $dataPosition; ?></li>
                  <li><i class="fa fa-phone-square"></i> <?php echo $dataPhone; ?></li>
                  <li><i class="fa fa-envelope"></i> <?php echo $dataEmail; ?></li>

                </ul>

              </div>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="x_panel">
                  <div class="row">
                    <h2>User Update</h2>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Phone <span class="required">*</span></label>
                        <input class="form-control" placeholder="Phone" name="txtPhone" type="text" value="<?php echo $dataPhone; ?>" maxlength="100" required />
                        <input class="form-control" name="txtCode" type="hidden" value="<?php echo $dataCode; ?>" maxlength="10" readonly="readonly" />
                      </div>
                    </div>
                    <div class="col-md-4">

                      <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input class="form-control" placeholder="Email" name="txtEmail" type="text" value="<?php echo $dataEmail; ?>" maxlength="100" required />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <label>Photo <span class="required">*</span></label>
                      <input class="form-control" type="file" name="txtPhoto" id="txtPhoto" value="<?php echo $dataPhoto; ?>" />
                    </div>
                  </div>
                  <div class="row">
                    <h2>Edit Password</h2>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>New Password<span class="required"></span></label>
                        <input class="form-control" name="txtPassword" type="password" maxlength="100" />
                        <input name="txtPassLama" type="hidden" value="<?php echo $dataPassword; ?>" />
                      </div>
                    </div>
                    <div class="col-md-4">

                      <div class="form-group">
                        <label>Re-type New Password<span class="required"></span></label>
                        <input class="form-control" name="txtPassword2" type="password" maxlength="100" />
                      </div>
                    </div>
                    <div class="col-md-4">
                      &nbsp;<br />* clear the new password if you do not want to change
                    </div>
                  </div>

                  <div class="row">
                    <div class="ln_solid"></div>
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-check-square-o fa-fw"></i> Submit</button>
                    </div>
                  </div>
                </div>
                <div class="x_panel">
                  <div class="row">
                    <h2><?php echo _ACTIVITYREPORT; ?></h2>
                    <div class="col-lg-12 table-responsive">

                      <div class="x_content ">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Login Time</th>
                              <th>IP Address</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $mySql   = "SELECT * FROM log_user WHERE user_id='" . $_SESSION['SES_USERID'] . "' order by log_date DESC";
                            $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                            $nomor  = 0;
                            while ($myData = mysqli_fetch_array($myQry)) {
                              $nomor++;
                            ?>

                              <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo date_format(new DateTime($myData['log_date']), 'H:i \o\n l jS F Y'); ?></td>
                                <td><?php echo $myData['log_ipaddress']; ?></td>
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
          </div>
        </div>
      </div>
  </div>
</div>

<!-- /page content -->
</form>
<?php
include "footer.php";
?>