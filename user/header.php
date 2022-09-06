<?php
include "language.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>E-Library</title>
  <link rel="shortcut icon" href="images/logo.png">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <link href="" rel="stylesheet">

  <!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <!-- Dropzone.js -->
  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Treeview -->
  <link href="../build/css/bootstrap-treeview.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="../build/css/custom.css" rel="stylesheet">
</head>



<body class="nav-md">
  <!-- header -->
  <div class="container body">
    <div class="main_container">
      <!--/ header -->

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="?page=Main" class="site_title"><img src="../uploads/logo.png" width="220px" /></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src=<?php echo "../uploads/user/" . $_SESSION['SES_PHOTO']; ?> alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span><?php echo _WELCOME; ?>,</span>
              <h2><?php echo $_SESSION['SES_NAMA']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>&nbsp;</h3>
              <ul class="nav side-menu">
                <?php
                if (isset($_SESSION['SES_ADMIN']) || isset($_SESSION['SES_USER'])) {

                ?>
                  <li><a><i class="fa fa-home"></i> <?php echo _HOME; ?> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?page=Main"><?php echo _DASHBOARD; ?></a></li>
                      <li><a href="?page=Document-Favourite"><?php echo _FAVOURITE; ?></a></li>
                    </ul>
                  </li>
                  <li><a href="?page=Search"><i class="fa fa-search"></i> <?php echo _SEARCH; ?> </a>
                    
                  </li>
                  <?php
                  $mySql   = "SELECT category_level_1 FROM master_category where id>0 group by category_level_1 order by id ";
                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                  $nomor  = 0;

                  while ($myData = mysqli_fetch_array($myQry)) {
                    $level1   = $myData['category_level_1'];

                    $mySql5  = "SELECT * FROM view_document WHERE category_level_1='$level1' and document_status='Approved'";
                    $myQry5  = mysqli_query($koneksidb, $mySql5)  or die("Query ambil data salah 2 : " . mysqli_error());
                    $myData5 = mysqli_fetch_array($myQry5);
                    $jumlah2 = mysqli_num_rows($myQry5);

                  ?>

                    <?php if ($jumlah2 != 0) { ?>

                      <li><a><i class="fa fa-files-o"></i> <?php echo $myData['category_level_1']; ?> <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <?php
                          $mySql2   = "SELECT category_level_2 FROM master_category where id>0 and category_level_1='$level1' group by category_level_2 order by category_level_2 ";
                          $myQry2   = mysqli_query($koneksidb, $mySql2)  or die("Error query " . mysqli_error());
                          $nomor  = 0;

                          while ($myData2 = mysqli_fetch_array($myQry2)) {
                            $CodeCategory2 = $myData2['category_level_2'];

                            // echo $CodeCategory;

                            $mySql5  = "SELECT * FROM view_document WHERE category_level_1='$level1' and category_level_2='$CodeCategory2' and document_status='Approved'";
                            $myQry5  = mysqli_query($koneksidb, $mySql5)  or die("Query ambil data salah 2 : " . mysqli_error());
                            $myData5 = mysqli_fetch_array($myQry5);
                            $jumlah = mysqli_num_rows($myQry5);

                          ?>

                            <?php if ($jumlah != 0) { ?>
                              <li><a href="?page=Document&id=<?php echo $myData2['category_level_2']; ?>&id2=<?php echo $myData['category_level_1']; ?>"><?php echo $myData2['category_level_2']; ?></a></li>
                            <?php } ?>

                          <?php

                          } //while level 2 end

                          ?>
                        </ul>
                      </li>
                    <?php } ?>
                    <?php
                  } // while level 1 end   	
                  
                } 
                // if end
                ?>
                <li><a href="https://www.tandfonline.com/"><?php echo 'E-Jurnal'; ?></a></li>


              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->


        </div>
      </div>

      <!-- <style>
        .navbar-nav:hover {
          background-color: yellow;
        }
      </style> -->
      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu" style="background-color:#8a0808 ">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars" style="color:#E7EAED"></i></a>
            </div>


            <ul class="nav navbar-nav navbar-right" style="background-color:#8a0808">



              <li class="">
                <a href="javascript:;" class=" user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src=<?php echo "../uploads/user/" . $_SESSION['SES_PHOTO']; ?> alt="" style="color:#E7EAED">
                  <span style="color:#E7EAED">
                    <?php echo $_SESSION['SES_NAMA']; ?>

                  </span>
                  <span class=" fa fa-angle-down" style="color:#E7EAED"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="?page=Profile"><i class="fa fa-user pull-right"></i><?php echo _PROFILE; ?></a></li>
                  <!-- <li><a href="../uploads/Rentas_KMS_user_guide.pdf" target="_blank"><i class="fa fa-book pull-right"></i> <?php echo _USERGUIDE; ?></a></li>
                  <li><a href="?page=Help"><i class="fa fa-question-circle pull-right"></i> <?php echo _HELP; ?></a></li> -->
                  <li style="border:solid 1px #E7EAED"> </li>
                  <li><a href="?page=Logout"><i class="fa fa-sign-out pull-right"></i> <?php echo _LOGOUT; ?></a></li>
                </ul>
              </li>

              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/<?php echo $lang; ?>.png" />
                  <span class=" fa fa-angle-down" style="color:#E7EAED"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="?page=Lang-ID"><img src="images/id.png" height="16px" class="pull-right" />Bahasa Indonesia</a></li>
                  <li><a href="?page=Lang-EN"><img src="images/en.png" height="16px" class="pull-right" />English</a></li>

                </ul>
              </li>



            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->