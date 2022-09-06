<?php
include_once "library/inc.seslogin.php";
include "header.php";
$User = $_SESSION['SES_USERID'];
$Code  = isset($_GET['id']) ?  $_GET['id'] : '';
$_SESSION['SES_PAGE'] = "?page=Document-Detail&id=" . $Code;
$division = $_SESSION['SES_DIVISION'];
$department = $_SESSION['SES_DEPARTMENT'];
$unit =  $_SESSION['SES_UNIT'];
$user_id = $_SESSION['SES_USERID'];

$mySqla  = "select count(*) as totala from view_document_privileges where document_id='$Code' ";
$myQrya  = mysqli_query($koneksidb, $mySqla)  or die("Query ambil data salah : " . mysqli_error());
$myDataa = mysqli_fetch_array($myQrya);
$totala = $myDataa['totala'];
if ($totala > 0) {

  $mySqlb  = "select count(*) as totalb from view_document_privileges where document_id='$Code' and (division='$division' or 
	department='$department' or unit='$unit' or	user_id='$user_id')";
  $myQryb  = mysqli_query($koneksidb, $mySqlb)  or die("Query ambil data salah : " . mysqli_error());
  $myDatab = mysqli_fetch_array($myQryb);
  $totalb = $myDatab['totalb'];
  if ($totalb < 1) {
    echo "<meta http-equiv='refresh' content='0; url=?page=Document-Denied&id=Document'>";
  }
}





$mySql  = "select * from view_document_user where document_id='$Code'";
$myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
$myData = mysqli_fetch_array($myQry);

$level1 = $myData['category_level_1'];
$level2 = $myData['category_level_2'];
$category = $myData['category_level_2'];
$ID = $myData['document_id'];
$version = $myData['document_version'];
$Title = $myData['document_title_' . $lang];
$Date = date_format(new DateTime($myData['document_date']), "d F Y");
$Key = $myData['document_keyword'];
$Desc = $myData['document_description_' . $lang];
$UpdatedDate = date_format(new DateTime($myData['updated_date']), "d F Y, H:i:s");
$UpdatedBy = $myData['updated_by'];
$_SESSION['SES_DOCUMENTID'] = $myData['document_id'];
$_SESSION['SES_DOCUMENT_VERSION'] = $myData['document_version'];

$mySqld  = "select * from view_document_files where document_id='$Code'";
$myQryd  = mysqli_query($koneksidb, $mySqld)  or die("Query ambil data salah : " . mysqli_error());
$myDatad = mysqli_fetch_array($myQryd);

$document_name = $myDatad['document_file_name'];

// ambil detail buku

$mySqldo   = "SELECT * FROM view_document  where document_id = '$Code'";
$myQrydo   = mysqli_query($koneksidb, $mySqldo)  or die("Error query " . mysqli_error());
$myDatado = mysqli_fetch_array($myQrydo);

$year = $myDatado['document_year'];
$rack = $myDatado['document_rack'];
$publisher = $myDatado['document_publisher'];
$author = $myDatado['document_author'];
$cover = $myDatado['document_cover'];



?>

<style>
  /* *,
  *:before,
  *:after {
    box-sizing: border-box;
  }

  body {
    background-color: #f3f3f3;
  } */

  .product-card {
    border-radius: 15px;
    background-color: #fdfefe;
    max-width: 90%;
    min-height: 250px;
    margin: 0 auto;
    margin-top: 50px;
    margin-bottom: 50px;
    box-shadow: 8px 12px 30px #b3b3b3;
    color: #919495;
    font-weight: normal;
    text-align: left;
    font-size: 14px;
    position: relative;
  }

  .product-details {
    width: 85%;
    float: right;
    height: 100%;
    padding: 30px;
  }

  .product-details h1 {
    color: #333;
    /* font-family: 'Pacifico', cursive; */
    margin-bottom: 25px;
    font-size: 20px;
  }

  .product-details button {
    width: 150px;
    height: 50px;
    margin-top: 20px;
    background-color: #337ab7;
    border-radius: 0;
    color: #fff;
    box-shadow: 2px 2px 7px #173853;
  }

  .product-details button:hover,
  .product-details button:active,
  .product-details button:focus {
    color: #fff;
  }

  .product-image {
    position: absolute;
    left: -30px;
    top: -40px;
  }

  .product-image img {
    max-width: 170px;
  }

  @media (max-width: 700px) {
    .product-card {
      margin-left: 20px;
      margin-right: 20px;
    }

    .product-image img {
      max-width: 80px;
      margin-left: 210px;
      margin-right: 20px;
      padding-top: 35px;
    }

    .product-card {
      border-radius: 15px;
      background-color: #fdfefe;
      max-width: 90%;
      min-height: 350px;
      margin: 0 auto;
      margin-top: 50px;
      margin-bottom: 50px;
      box-shadow: 8px 12px 30px #b3b3b3;
      color: #919495;
      font-weight: normal;
      text-align: left;
      font-size: 14px;
      position: relative;
    }


  }

  @media (max-width: 540px) {
    .product-card {
      /* overflow: hidden; */
      margin-bottom: 50px;
    }

    .product-details {
      width: 100%;
      z-index: 1;
    }

    .product-image {
      width: 100%;
      left: 5%;
      top: -50px;
    }
  }

  @media (max-width: 440px) {
    .product-details {
      width: 100%;
    }
  }

  @media (max-width: 365px) {
    .product-details {
      width: 80%;
      position: relative;
      color: #333;
      background-color: rgba(255, 255, 255, 0.7);
    }
  }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php echo $category ?></h3>
      </div>
      <div class="title_right">
        <div class="form-group pull-right">
          <h6><a href="?page=Main"><i class="fa fa-home"></i> <?php echo _HOME ?></a> / <?php echo $level1 ?> / <a href="?page=Document&id=<?php echo $level2; ?>&id2=<?php echo $level1; ?>"><?php echo $level2 ?></a></h6>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="x_content">
              <ul class="nav navbar-left">
                <?php
                $mySqlf  = "SELECT id FROM document_favourite WHERE document_id='$Code' and user_id='$User'";
                $myQryf  = mysqli_query($koneksidb, $mySqlf)  or die("Query ambil data salah : " . mysqli_error());
                $myDataf = mysqli_fetch_array($myQryf);
                if ($myDataf['id'] == "") {
                  echo "<a href='?page=Document-Favourite-Add&id=$Code' class='btn btn-default btn-sm' target='_self' title='" . _ADDTOFAVOURITE . "'><img src='images/fav0.png'  />&nbsp;&nbsp;&nbsp;" . _ADDTOFAVOURITE . "</a>";
                } else {
                  echo "<a href='?page=Document-Favourite-Delete&id=$Code' class='btn btn-default btn-sm' target='_self' title='" . _DELETEFROMFAVOURITE . "'><img src='images/fav1.png'  />&nbsp;&nbsp;&nbsp;" . _DELETEFROMFAVOURITE . "</a>";
                }
                ?>
              </ul>
              <ul class="nav navbar-right">
                <a href="<?php echo $_SESSION['SES_BACK']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> <?php echo _BACK; ?></a>
              </ul>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <!-- content -->
            <!--  -->

            <!--  -->
            <div class="row">
              <div class="col-lg-12 col-md-8 col-xs-12">
                <div>
                  <div class="product-card" style="height: 250px;">
                    <div class="product-image">
                      <?php if ($cover != '') { ?>
                        <img class="" src="../uploads/cover/<?php echo $cover ?>" alt="Card image cap">
                      <?php } else { ?>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/1200px-PDF_file_icon.svg.png">
                      <?php } ?>
                    </div>
                    <div class="product-details">
                      <div>

                      </div>
                      <H1><?php echo $Title; ?></H1>

                      <div class="row">
                        <div class="col-lg-3 col-md-3 col-xs-12">
                          <p class="card-text"><?php echo _AUTHOR ?> :</p>
                        </div>
                        <div class="col-lg-8 col-md-8 col-xs-12">
                          <p class="card-text" style="color:black"><?php echo $author ?></p>
                        </div>
                      </div>
                      <!-- Penerbit -->
                      <div class="row">
                        <div class="col-lg-3 col-md-6 col-xs-12">
                          <p class="card-text"><?php echo _PUBLISHER ?>:</p>
                        </div>
                        <div class="col-lg-8 col-md-6 col-xs-12">
                          <p class="card-text " style="color:black"><?php echo $publisher ?></p>
                        </div>
                      </div>
                      <!-- No Rak -->
                      <?php if ($rack != '') { ?>
                        <div class="row">
                          <div class="col-lg-3 col-md-6 col-xs-12">
                            <p class="card-text"><?php echo _LOCATION ?>:</p>
                          </div>
                          <div class="col-lg-8 col-md-6 col-xs-12">
                            <p class="card-text" style="color:black"><?php echo $rack ?></p>
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($year != '') { ?>
                        <div class="row">
                          <div class="col-lg-3 col-md-6 col-xs-12">
                            <p class="card-text"><?php echo _YEAR ?>:</p>
                          </div>
                          <div class="col-lg-8 col-md-6 col-xs-12">
                            <p class="card-text" style="color:black"><?php echo $year ?></p>
                          </div>
                        </div>
                      <?php } ?>
                      <div class="row">
                        <div class="col-lg-3 col-md-6 col-xs-12">
                          <p style="color:black;align=justify"><?php echo $Desc; ?></p>

                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="">
              <table id="datatable-responsive-x" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                <tbody>
                  <?php
                  $mySql   = "SELECT * FROM document_files where document_id='$ID' and document_version='$version' order by document_order";
                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                    $Code = $myData['document_file_name'];
                    $_SESSION['SES_DOCUMENT_FILE'] = $myData['document_file_title'];



                  ?>
                    <tr>
                      <td width="5%">
                        <a href="?page=Document-Viewer&id=<?php echo $myData['document_id']; ?>&v=<?php echo $myData['document_version']; ?>&doc=<?php echo $myData['document_file_title']; ?>&hal=1"><img src="images/pdf.png" height="20" longdesc="#"></a>
                      </td>
                      <td>
                        <a href="?page=Document-Viewer&id=<?php echo $myData['document_id']; ?>&v=<?php echo $myData['document_version']; ?>&doc=<?php echo $myData['document_file_title']; ?>&hal=1"><u><?php echo $myData['document_file_title']; ?></a></u>
                      </td>
                      <td>
                        <?php echo $myData['document_size']; ?></td>


                    </tr>

                  <?php } ?>
                </tbody>
              </table>

            </div> -->


            <div class="row">
              <div class="col-lg-4 col-md-8 col-xs-6">
                <div class="search-box2">
                  <h2 style="font-size: 25px; color:black;"><?php echo _DOCUMENT ?></h2>
                </div>
              </div>

            </div>

            <div class="clearfix">&nbsp;</div>


            <div class="row" style="padding-left: 35px;">
              <?php

              $mySql   = "SELECT * FROM document_files where document_id='$ID' and document_version='$version' order by document_order";
              $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
              $nomor  = 0;
              while ($myData = mysqli_fetch_array($myQry)) {
                $nomor++;
                $Code = $myData['document_file_name'];
                $_SESSION['SES_DOCUMENT_FILE'] = $myData['document_file_title'];

              ?>
                <div class="col-sm-3">
                  <div class="card" style="border-radius: 15px; background-color:white">
                    <img class="" src="images/pdflogo.png" style="width: 70%;  padding-left: 60px; object-fit: contain;" alt="Card image cap">
                    <div class="card-body" style="min-height: 50px;">
                      <style>
                        .card-text {
                          font-size: 13px;
                          align-items: center;
                          padding-left: 15px;
                        }

                        .card-title {
                          min-height: 75px;
                          padding-left: 15px;
                          padding-right: 15px;
                        }
                      </style>
                      <h5 class="card-title" style="text-align:center"> <b><?php echo $title; ?></b> </h5>
                      <!-- Penulis -->
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="card-text"><?php echo _FILENAME; ?></p>
                        </div>
                        <div class="col-sm-8">
                          <p class="card-text"><a href="?page=Document-Detail-PDF&id=<?php echo $myData['document_id']; ?>&v=<?php echo $myData['document_version']; ?>&doc=<?php echo $myData['document_file_title']; ?>&hal=1"><u><?php echo $myData['document_file_title']; ?></a></u></p>
                        </div>
                      </div>
                      <!-- Penerbit -->
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="card-text"><?php echo _SIZE; ?></p>
                        </div>
                        <div class="col-sm-8">
                          <p class="card-text"><?php echo $myData['document_size']; ?></p>
                        </div>
                      </div>
                    </div>
                    <!-- <h3 class="product-title" style="text-align: right;"><a href="?page=Document-Viewer&id=<?php echo $myData['document_id']; ?>&v=<?php echo $myData['document_version']; ?>&doc=<?php echo $myData['document_file_title']; ?>&hal=1" style="font-size: 15px; color:red; text-align: right; padding-right:10px;"> <b>Show In Full</b> </a></h3> -->
                  </div>

                </div>
              <?php } ?>
            </div>



            <!-- <div class="" style="padding-top:50px;">

              <embed type="application/pdf" src="<?php echo $document_name ?>#zoom=85&scrollbar=0&toolbar=0&navpanes=0" width="100%" height="400"></embed>

            </div> -->
            <!-- content -->
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