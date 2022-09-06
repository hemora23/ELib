<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
  <meta name="viewport" content="width=device-width, user-scalable=false;">

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

          <div class="navbar nav_title " style="border: 0;">
            <a href="?page=Main" class="site_title"><img src="../uploads/logo.png" width="220px" /></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src=<?php echo "../uploads/user/" . $_SESSION['SES_PHOTO']; ?> alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo $_SESSION['SES_NAMA']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3><?php echo $_SESSION['SES_GROUP']; ?></h3>
              <ul class="nav side-menu">
                <?php
                if (isset($_SESSION['SES_ADMIN']) || isset($_SESSION['SES_USER'])) {
                  # JIKA YANG LOGIN LEVEL ADMIN, menu di bawah yang dijalankan
                ?>
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?page=Dashboard">Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-database"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?page=Status">Status</a></li>
                      <li><a href="?page=Organization">Organization</a></li>
                      <li><a href="?page=Position">Position</a></li>
                      <li><a href="?page=User">User</a></li>
                      <li><a href="?page=Logo">Logo</a></li>
                      <li><a href="?page=Wallpaper">Wallpaper</a></li>
                      <li><a href="?page=Banner">Banner</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-list-ol"></i> Category <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?page=Category">Category</a></li>
                      <li><a href="?page=Category-Import">Import Category</a></li>
                      <li><a href="?page=Category-Restore">Restore Category Changes</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-files-o"></i> Document<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?page=Document">All Document</a></li>
                      <li><a href="?page=Document-Revised">Revised Document</a></li>
                      <?php
                      $ses_posisi = $_SESSION['SES_POSITION'];
                      if ('Super Admin' == $ses_posisi) { ?>
                        <li><a href="?page=Document-Approval">Approval Document</a></li>
                      <?php } ?>
                      <li><a href="?page=Document-Privileges">Document Privileges</a></li>
                      <li><a href="?page=Document-Files-Privileges">File Privileges</a></li>
                      <li><a href="?page=Document-Expiration">Document Expiration</a></li>
                      <!-- <li><a href="?page=Document-Link">Document Link</a></li> -->
                      <li><a href="?page=Document-Search">Document Search</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart"></i> Statistic<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a>Visitors<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="?page=Report-User-Date">By Date</a></li>
                          <li><a href="?page=Report-User-User">By User</a></li>
                          <li><a href="?page=Report-User-All">All User</a></li>
                        </ul>
                      </li>
                      <li><a>Documents<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="?page=Report-Document-Date">By Date</a></li>
                          <li><a href="?page=Report-Document-Category">By Category</a></li>
                          <li><a href="?page=Report-Document-Doc">By Document</a></li>
                          <li><a href="?page=Report-Document-Div">By Bagian/Unit</a></li>
                          <li><a href="?page=Report-Document-User">By User</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file-text-o"></i> Report<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?page=Report-Document">All Report</a></li>
                      <li><a href="?page=Report-Doc">Report of document read by user</a></li>
                      <li><a href="?page=Report-Div">Report of document by division</a></li>
                    </ul>
                  </li>

                <?php
                }

                ?>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->


        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu" style="background-color:#8a0808 ">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars" style="color:#E7EAED"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right" style="background-color:#8a0808 ">



              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src=<?php echo "../uploads/user/" . $_SESSION['SES_PHOTO']; ?> alt="">
                  <span style="color:#E7EAED">
                    <?php echo $_SESSION['SES_NAMA']; ?>

                  </span>
                  <span class=" fa fa-angle-down" style="color:#E7EAED"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="?page=Profile"><i class="fa fa-user pull-right"></i> Profile</a></li>
                  <!-- <li><a href="uploads/Rentas_KMS_admin_guide.pdf"><i class="fa fa-book pull-right"></i> Admin Guide</a></li>
                  <li><a href="?page=Help"><i class="fa fa-question-circle pull-right"></i> Help</a></li> -->
                  <li><a href="?page=Logout"><i class="fa fa-sign-out pull-right"></i> Logout</a></li>
                </ul>
              </li>

              <?php
              $ses_nama  = $_SESSION['SES_NAMA'];
              $mySql   = "SELECT status_name FROM master_status where status_group='Document Expiration'";
              $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query 4" . mysqli_error());
              $myData = mysqli_fetch_array($myQry);
              $interval = $myData['status_name'];

              $mySql   = "select count(*) as total from view_document where Date(document_expire_date) < DATE(NOW() + INTERVAL $interval) and document_status='Approved' ";
              $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
              $myData = mysqli_fetch_array($myQry);
              $TotalExpire  = $myData['total'];
              if ($TotalExpire > 0) {
              ?>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-calendar"></i>
                    <span class="badge bg-red"><?php echo $TotalExpire; ?></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a href="?page=Document-Expiration">
                        <span>
                          <span><b>Expired Documents</b></span>
                        </span>
                        <span class="message">
                          <?php echo $TotalExpire; ?> documents have expired
                        </span>
                      </a>
                    </li>
                  </ul>
                </li><!-- /end -->
              <?php } ?>
              <?php
              if ('Super Admin' == $ses_posisi) {
                # code...

                $ses_nama  = $_SESSION['SES_NAMA'];
                $mySql   = "SELECT count(*) as total FROM view_document WHERE (document_status='Revised')  ";

                $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                $myData = mysqli_fetch_array($myQry);
                $TotalRevisi  = $myData['total'];
                if ($TotalRevisi > 0) {
              ?>

                  <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-pencil-square"></i>
                      <span class="badge bg-orange"><?php echo $TotalRevisi; ?></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                      <li>
                        <a href="?page=Document-Revised">
                          <span>
                            <span><b>Revised Documents</b></span>
                          </span>
                          <span class="message">
                            <?php echo $TotalRevisi; ?> documents waiting to be revised
                          </span>
                        </a>
                      </li>
                    </ul>
                  </li><!-- /end -->
                <?php } ?>
                <?php
                $ses_nama  = $_SESSION['SES_NAMA'];
                $mySql   =

                  " SELECT SUM(A.tot) as total FROM
				(SELECT count(*) as tot FROM view_document WHERE (document_status='Created' or document_status='Updated' or document_status='Request Delete')  
									
									UNION ALL
									SELECT count(*) as tot FROM view_document WHERE document_status='Reviewed' and updated_by ='$ses_nama') A ";

                $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                $myData = mysqli_fetch_array($myQry);
                $TotalApproval  = $myData['total'];
                if ($TotalApproval > 0) {
                ?>

                  <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-check-square" style="color:#E7EAED"></i>
                      <span class="badge "><?php echo $TotalApproval; ?></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                      <li>
                        <a href="?page=Document-Approval">
                          <span>
                            <span><b>Document Approval</b></span>
                          </span>
                          <span class="message">
                            <?php echo $TotalApproval; ?> documents waiting to be reviewed
                          </span>
                        </a>
                      </li>
                    </ul>
                  </li><!-- /end -->
              <?php }
              } ?>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->