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



<body class="">
  <!-- header -->
  <div class="container body">
    <div class="main_container">
      <!--/ header -->


      <!-- <style>
        .navbar-nav:hover {
          background-color: yellow;
        }
      </style> -->
      <!-- top navigation -->
      <div class="">
        <div class="nav_menu" style="background-color:#8a0808 ">
          <nav>
            <div class="navbar nav_title" style="border: 0;background-color:#8a0808 ">
              <a href="?page=Main" class=""><img src="../uploads/logo.png" width="220px" /></a>
            </div>

            <ul class="nav navbar-nav navbar-right" style="background-color:#8a0808">



              <li class="">
                <a href="javascript:;" class=" user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src=<?php echo "../uploads/user/" . $_SESSION['SES_PHOTO']; ?> alt="" style="color:#E7EAED">
                  <spa style="color:#E7EAED">
                    <?php echo $_SESSION['SES_NAMA']; ?>

                  </spa>
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

              <!-- <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/<?php echo $lang; ?>.png" />
                  <span class=" fa fa-angle-down" style="color:#E7EAED"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="?page=Lang-ID"><img src="images/id.png" height="16px" class="pull-right" />Bahasa Indonesia</a></li>
                  <li><a href="?page=Lang-EN"><img src="images/en.png" height="16px" class="pull-right" />English</a></li>

                </ul>
              </li> -->



            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->