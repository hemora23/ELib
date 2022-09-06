<?php
$_SESSION['SES_TITLE'] = "User";
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=User";
$position = $_SESSION['SES_POSITION'];
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>User<small></small></h3>
      </div>
      <div class="title_right">
        <div class="form-group pull-right">
          <?php if ($position == 'Super Admin' || $position == 'Pustakawan') { ?>
            <a href="?page=User-Add" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus-square fa-fw"></i> Add New Data</a>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content table-responsive">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Photo</th>
                  <!-- <th>ID Anggota</th> -->
                  <th>Name</th>
                  <th>Username</th>
                  <th>Institusi</th>
                  <th>Bagian</th>
                  <th>Unit</th>
                  <th>Prodi</th>
                  <th>Position</th>
                  <th>Access Group</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $mySql   = "SELECT * FROM master_user";
                $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                $nomor  = 0;
                while ($myData = mysqli_fetch_array($myQry)) {
                  $nomor++;
                  $Code = $myData['user_id'];
                ?>

                  <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><img src=<?php echo "../uploads/user/" . $myData['user_photo']; ?> alt="..." class="img-circle" width="30px" height="30px"></td>
                    <!-- <td><?php echo $myData['user_id']; ?></td> -->
                    <td><?php echo $myData['user_fullname']; ?></td>
                    <td><?php echo $myData['username']; ?></td>
                    <td><?php echo $myData['branch']; ?></td>
                    <td><?php echo $myData['division']; ?></td>
                    <td><?php echo $myData['department']; ?></td>
                    <td><?php echo $myData['unit']; ?></td>
                    <td><?php echo $myData['position']; ?></td>
                    <td><?php echo $myData['user_group']; ?></td>
                    <td style="color:<?php if ($myData['user_status'] == "Not Active") {
                                        echo "#FF0000";
                                      } ?>"><?php echo $myData['user_status']; ?></td>

                    <?php if ($myData['position'] == 'Member' && $position == 'Pustakawan') { ?>
                      <td><a href="?page=User-Edit&id=<?php echo $Code; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a></td>
                      <td><a href="?page=User-Delete&id=<?php echo $Code; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
                    <?php } elseif ($position == 'Super Admin') { ?>
                      <td><a href="?page=User-Edit&id=<?php echo $Code; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a></td>
                      <td><a href="?page=User-Delete&id=<?php echo $Code; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
                    <?php  } else { ?>
                      <td></td>
                      <td></td>
                    <?php } ?>
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
<!-- /page content -->

<?php
include "footer.php";
?>