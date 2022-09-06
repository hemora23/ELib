<?php
if (empty($_SESSION['failed_login'])) {
} elseif ($_SESSION['failed_login'] > 2) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Login-Failed'>";
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>E-Library</title>
  <link rel="shortcut icon" href="images/logo.png">
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <!-- fontawesome -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>

<!-- additional css -->
<style>
  IMG.displayed {
    display: block;
    margin-left: auto;
    margin-right: auto
  }



  .input {
    position: relative;
  }

  .input__label {
    position: absolute;
    left: 0;
    top: 0;
    padding: calc(var(--size-bezel) * 0.75) calc(var(--size-bezel) * .5);
    margin: calc(var(--size-bezel) * 0.75 + 3px) calc(var(--size-bezel) * .5);
    background: pink;
    white-space: nowrap;
    transform: translate(0, 0);
    transform-origin: 0 0;
    background: var(--color-background);
    transition: transform 120ms ease-in;
    font-weight: lighter;
    line-height: 2.7;

  }

  .input__field {
    box-sizing: border-box;
    display: block;
    width: 100%;
    border: 3px solid currentColor;
    padding: calc(var(--size-bezel) * 1.5) var(--size-bezel);
    color: currentColor;
    background: transparent;
    border-radius: var(--size-radius);
  }

  .input__field:focus+.input__label,
  .input__field:not(:placeholder-shown)+.input__label {
    transform: translate(0.25rem, -60%) scale(0.8);
    color: var(--color-accent);
  }

  .field-icon {
    float: right;
    margin-right: 10px;
    margin-top: -43px;
    position: relative;
    z-index: 2;
  }
</style>

<body class="login">



  <div>
    <!-- <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a> -->

    <div class="animate form login_form">
      <section class="login_content">
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 6%;">
          <div class="col-md-3 col-sm-12 col-xs-12">





          </div>
          <div class=" col-md-3 col-sm-12 col-xs-12" style="background:#9A1B23; padding-bottom: 94px;">
            <div class="login_wrapper">
              <img src="images/logo.png" class="displayed" style="padding-bottom: 20px; padding-top:20px;">
              <!-- <img src="../uploads/logo.png" class="displayed" style="padding-bottom: 20px; padding-top:20px;"> -->
              <h2 style="color: white; font-size:25px;">E-Library</h2>
              <h2 style="color: white; font-weight: 100;">Sekolah Tinggi Intelejen Negara</h2>
            </div>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12" style="background:white; padding-bottom: 81px;">
            <div class="login_wrapper">
              <form class="form-signin" role="form" action="?page=Login-Validasi" method="POST" name="form1" target="_self" id="form1">
                <h3 style="color: black; padding-top: 40px; padding-bottom: 15px;">Login Form</h3>
                <div>
                  <!-- <input id="txtUser" name="txtUser" type="text" class="form-control" placeholder="username" required /> -->
                  <label class="input">
                    <input class="form-control input__field" id="txtUser" style="width:100%;" name="txtUser" type="text" placeholder=" " required />
                    <span class="input__label"> &nbsp; Username</span>
                  </label>
                </div>
                <div style="padding-bottom:10px;">
                  <!-- <input  class="form-control" placeholder="Password" required /> -->
                  <label class="input">
                    <input class="form-control input__field" id="txtPassword" style="width:100%;" name="txtPassword" type="password" placeholder=" " required />
                    <!-- <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i> -->
                    <span id="txtPassword" class="input__label"> &nbsp; Password</span>
                    <span toggle="#txtPassword" id="toggle_pwd" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  </label>
                </div>




                <button class="btn  submit" type="submit" name="btnLogin" style="width:50%; background-color: #9A1B23; color:white;">&nbsp;&nbsp;&nbsp;&nbsp;Masuk&nbsp;&nbsp;&nbsp;&nbsp;</button>





            </div>
            <span> <a href="" data-toggle="modal" data-target="#myModal"> Register / Lupa Password</a></span>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 6%;">

          <div class=" clearfix"></div>

          <div class="separator">




            <div>
              <p style="color: white;">©Sekolah Tinggi Intelejen Negara 2021. All Rights Reserved. </p>
            </div>
          </div>

        </div>




        </form>
      </section>



    </div>
  </div>
  <script type="text/javascript">
    $(function() {
      $("#toggle_pwd").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#txtPassword").attr("type", type);
      });
    });
  </script>



  </div>
  </div>
</body>


<!-- Moal Registrasi -->

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->




<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notification</h4>
      </div>
      <div class="modal-body">
        <p>Untuk pendaftaraan atau lupa password silahkan hubungi pustakawan, Terima kasih.</p>
        <i>For registration or forget password please contact Librarian, Thank you.</i>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</html>