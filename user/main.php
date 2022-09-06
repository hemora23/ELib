<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=Main";
$_SESSION['SES_BACK'] = "?page=Main";

$LANG = $_SESSION['SES_LANG'];
?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"> -->

<!-- owl carousel -->
<link href="../vendors/owlcarousel/css/owlcarousel.min.css" rel="stylesheet">

<script src="../vendors/owlcarousel/css/owl.carousel.min.js"></script>
<script src="../vendors/owlcarousel/css/owl.carousel.js"></script>



<!-- css untuk card -->
<style>
  .wrapper2 {
    width: 100%;
    padding-top: 20px;
    text-align: center;
  }

  h2 {
    font-family: sans-serif;
    color: #fff;
  }

  .carousel2 {
    width: 90%;
    margin: 0px auto;
  }

  .slick-slide {
    margin: 10px;
  }

  .slick-slide img {
    width: 100%;
  }

  .slick-prev,
  .slick-next {
    background: #000;
    border-radius: 15px;
    border-color: transparent;
  }

  .card {
    border: 2px solid #fff;
    box-shadow: 1px 1px 15px #ccc;
  }

  .card-body {
    /* background: #fff; */
    width: 200%;
    /* vertical-align: top; */
  }

  .card-body2 {
    /* background: #fff; */
    width: 100%;
    height: 250px;


    /* vertical-align: top; */
  }

  .card-content {
    text-align: left;
    color: #333;
    padding: 15px;
  }

  .card-text {
    font-size: 14px;
    font-weight: 300;
  }
</style>
<!-- end -->
<!-- css untuk carousel -->
<style>
  .carousel-container {
    border-radius: 20px;
    overflow: hidden;
    max-width: 100%;
    /* height: 400px; */

    position: relative;
    box-shadow: 0 0 100px -20px;
    margin: auto;
    z-index: 0;
    object-fit: cover;
  }

  /* Hide the images by default */
  .mySlides {
    display: none;
  }

  .mySlides img {
    display: block;
    width: 100%;
  }

  /* image gradient overlay [optional] */
  /* .mySlides::after {
  content: "";
  position: absolute;
  inset: 0 0 0 0;
    background-image: linear-gradient(-45deg, rgba(110, 0, 255, .1), rgba(70, 0, 255, .2));
} */

  /* Next & previous buttons */
  .prev,
  .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translate(0, -50%);
    width: auto;
    padding: 20px;
    /* color: white; */
    font-weight: bold;
    font-size: 24px;
    border-radius: 0 8px 8px 0;
    /* background: rgba(173, 216, 230, 0.1); */
    user-select: none;
  }

  .next {
    right: 0;
    border-radius: 8px 0 0 8px;
  }

  .prev:hover,
  .next:hover {
    /* background-color: rgba(173, 216, 230, 0.3); */
  }

  /* Caption text */
  .text {
    /* color: #f2f2f2; */
    /* background-color: rgba(10, 10, 20, 0.1); */
    backdrop-filter: blur(6px);
    border-radius: 10px;
    font-size: 20px;
    padding: 8px 12px;
    position: absolute;
    bottom: 60px;
    left: 50%;
    transform: translate(-50%);
    text-align: center;
  }

  /* Number text (1/3 etc) */
  .number {
    color: #f2f2f2;
    font-size: 16px;
    /* background-color: rgba(173, 216, 230, 0.15); */
    backdrop-filter: blur(6px);
    border-radius: 10px;
    padding: 8px 12px;
    position: absolute;
    top: 10px;
    left: 10px;
  }

  .dots-container {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translate(-50%);
  }

  /* The dots/bullets/indicators */
  .dots {
    cursor: pointer;
    height: 14px;
    width: 14px;
    margin: 0 4px;
    /* background-color: rgba(173, 216, 230, 0.2); */
    backdrop-filter: blur(2px);
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.3s ease;
  }

  .active,
  .dots:hover {
    /* background-color: rgba(173, 216, 230, 0.8); */
  }

  /* Fading animation */
  .animate {
    -webkit-animation-name: animate;
    -webkit-animation-duration: 1s;
    animation-name: animate;
    animation-duration: 2s;
  }

  @keyframes animate {
    from {
      transform: scale(1.1) rotateY(10deg);
    }

    to {
      transform: scale(1) rotateY(0deg);
    }
  }
</style>
<!-- end -->
<!-- css untuk search bar -->
<style>
  @import url('https://fonts.googleapis.com/css?family=Lato:300,700');

  /* body {
    background: #81CCE8;
  } */

  .search-box {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 20vh;
  }

  .search-box2 {
    display: flex;
    justify-content: left;
    align-items: center;
    height: 20vh;
    padding-left: 10px;
  }

  input[type=search] {
    /* box-shadow: 10px 10px 4px rgba(0, 0, 0, 0.4); */
    background: #8a0808;
    border: 2px solid #8a0808;
    outline: none;
    width: 100%;
    height: 50px;
    border-radius: 15px 0 0 15px;
    font-size: 1.4em;
    font-weight: 300;
    padding: 0px 10px;
    font-family: 'Lato', sans-serif;
    letter-spacing: 2px;
    /* text-transform: uppercase; */
    color: #ffffff;
  }

  ::placeholder {
    color: #ffffff;
    font-size: 1.2em;
    font-weight: 300;
    font-family: 'Lato', sans-serif;
  }

  .search-btn {
    /* box-shadow: 10px 10px 4px rgba(0, 0, 0, 0.4); */
    margin-top: 5px;
    height: 50px;
    width: 50px;
    outline: none;
    border-radius: 0 15px 15px 0;
    background: #8a0808;
    ;
    color: #ffffff;
    border: none;
    transition: all 0.3s ease;
  }

  .search-btn:hover {
    transition: all 0.3s ease;
  }

  .search-btn:hover i {
    font-size: 1.8em;
  }

  .search-btn i {
    font-size: 1.5em;
  }
</style>
<!-- end  -->
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <!-- Full-width images with number and caption text -->
      <div class="carousel-container">
        <?php
        $mySqlMas   = "SELECT * FROM master_banner order by updated_date asc";
        $myQryMas   = mysqli_query($koneksidb, $mySqlMas)  or die("Error query " . mysqli_error());
        $nomor  = 0;
        while ($myDataMas = mysqli_fetch_array($myQryMas)) {
          $nomor++;
          $logo  = $myDataMas['logo']; ?>

          <div class="mySlides animate ">
            <img src="../uploads/<?php echo $logo ?> " style='height:350px;' alt="slide" />
            <div class="number"><?php echo $nomor ?></div>
          </div>
        <?php }
        ?>

        <!-- <div class="mySlides animate">
          <img src="https://wallpapershome.com/images/pages/pic_h/23525.jpg" alt="slide" />
          <div class="number">2 / 5</div>
          <div class="text">amet consectetur</div>
        </div>

         Next and previous buttons -->
        <a class="prev" onclick="prevSlide()">&#10094;</a>
        <a class="next" onclick="nextSlide()">&#10095;</a>

        <!-- The dots/circles -->
        <div class="dots-container">
          <span class="dots" onclick="currentSlide(1)"></span>
          <!-- <span class="dots" onclick="currentSlide(2)"></span>
          <span class="dots" onclick="currentSlide(3)"></span>
          <span class="dots" onclick="currentSlide(4)"></span>
          <span class="dots" onclick="currentSlide(5)"></span> -->
        </div>
      </div>



      <script src="https://kit.fontawesome.com/42e3e833b9.js" crossorigin="anonymous"></script>
    </div>

    <!-- Buku Populer -->

    <div class="col-lg-9 col-md-6 col-xs-6">
      <div class="search-box2">
        <h2 style="font-size: 20px; color:black;"><?php echo _POPULARBOOK ?></h2>
      </div>
    </div>


    <form role="form" action="?page=Validasi" method="POST" name="form3" target="_self" id="form3">

      <div class="col-lg-3 col-md-4 col-xs-6">
        <div class="search-box">
          <input type="search" name="cari" placeholder="<?php echo _SEARCH ?>" />
          <button type="submit" src="?page=Validasi" class="search-btn" name="btnCari"><i class="fa fa-search"></i></button>
        </div>

      </div>
    </form>
  </div>

  <div class="clearfix">&nbsp;</div>


  <div class="row" style="padding-left: 35px;">
    <?php

    $mySql   = "SELECT * FROM view_log_document_mostread  order by total desc LIMIT 6";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
    $nomor  = 0;
    while ($myData = mysqli_fetch_array($myQry)) {
      $nomor++;
      $Code = $myData['document_id'];

      // ambil detail buku

      $mySqld   = "SELECT * FROM view_document  where document_id = '$Code'";
      $myQryd   = mysqli_query($koneksidb, $mySqld)  or die("Error query " . mysqli_error());
      $myDatad = mysqli_fetch_array($myQryd);

      $year = $myDatad['document_year'];
      $rack = $myDatad['document_rack'];
      $publisher = $myDatad['document_publisher'];
      $author = $myDatad['document_author'];
      $cover = $myDatad['document_cover'];

      $title = $myData['document_title_' . $lang];

      $description = $myDatad['document_description_' . $lang];

      // if ($nomor == '4') {
      //   $style = "style='padding-bottom:5%'";
      // }

    ?>

      <div class="col-sm-4" style='margin-bottom:30px;'>
        <div class="card" style="border-radius: 15px; background-color:white; width: 290px;">
          <div class="card-body2">

            <?php if ($cover != '') { ?>
              <img class="" src="../uploads/cover/<?php echo $cover ?>" style=" height:280px; padding: 5%;   display: block; margin-left: auto;  margin-right: auto;" alt="Card image cap">
            <?php } else { ?>
              <img class="" src="images/pdflogo.png" style="width: 108%;" alt="Card image cap">
            <?php } ?>
          </div>
          <div class="card-body" style="min-height: 300px; width:auto">
            <style>
              .card-text {
                font-size: 13px;
                align-items: center;
                padding-left: 15px;
              }

              .card-title {
                height: 80px;
                padding-left: 15px;
                padding-right: 15px;
                line-height: 2;
                Font-size: 16px;
                font-weight: bolder;

              }
            </style>
            <br>
            <!-- Penulis -->
            <div class="row">
              <div class="card-title" style="text-align:center; text-align:center; font-size: 17px; color:black"> <b><?php echo $title; ?></b> </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <p class="card-text"><?php echo _AUTHOR ?> :</p>
              </div>
              <div class="col-sm-8">
                <p class="card-text"><?php echo $author ?></p>
              </div>
            </div>
            <!-- Penerbit -->
            <div class="row">
              <div class="col-sm-4">
                <p class="card-text"><?php echo _PUBLISHER ?> :</p>
              </div>
              <div class="col-sm-8">
                <p class="card-text"><?php echo $publisher ?></p>
              </div>
            </div>
            <!-- No Rak -->
            <?php if ($rack != '') { ?>
              <div class="row">
                <div class="col-sm-4">
                  <p class="card-text"><?php echo _LOCATION ?>:</p>
                </div>
                <div class="col-sm-8">
                  <p class="card-text"><?php echo $rack ?></p>
                </div>
              </div>
            <?php } ?>
            <!-- No Rak -->
            <?php if ($year != '') { ?>
              <div class="row">
                <div class="col-sm-4">
                  <p class="card-text"><?php echo _YEAR ?></p>
                </div>
                <div class="col-sm-8">
                  <p class="card-text"><?php echo $year ?></p>
                </div>
              </div>
            <?php } ?>
            <?php if ($description != '') { ?>
              <div class="row">
                <div class="col-sm-4">
                  <p class="card-text"><?php echo _DESC ?></p>
                </div>
                <div class="col-sm-8">
                  <p class="card-text"><?php echo $description ?></p>
                </div>
              </div>
            <?php } ?>
            <h3 class="product-title" style="text-align: right;"><a href="?page=Document-Detail&id=<?php echo $myData['document_id']; ?>" style="font-size: 16px; color:red; text-align: right; padding-right:10px;"> <b><?php echo _READ ?></b> </a></h3>
          </div>

        </div>
      </div> <?php

            } ?>
  </div>

  <!-- Batas Buku Populer -->

  <!-- Buku Terbaru -->


  <div class="row">
    <div class="col-lg-4 col-md-8 col-xs-6">
      <div class="search-box2">
        <h2 style="font-size: 20px; color:black;"><?php echo _NEWBOOK ?></h2>
      </div>
    </div>
  </div>

  <div class="clearfix">&nbsp;</div>


  <div class="row" style="padding-left: 35px;">
    <?php

    $mySql   = "SELECT * FROM view_document_user  order by document_date desc LIMIT 6";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error());
    $nomor  = 0;
    while ($myData = mysqli_fetch_array($myQry)) {
      $nomor++;
      $Code = $myData['document_id'];
      $title = $myData['document_title_' . $lang];

      // ambil detail buku

      $mySqld   = "SELECT * FROM view_document  where document_id = '$Code'";
      $myQryd   = mysqli_query($koneksidb, $mySqld)  or die("Error query " . mysqli_error());
      $myDatad = mysqli_fetch_array($myQryd);

      $year = $myDatad['document_year'];
      $rack = $myDatad['document_rack'];
      $publisher = $myDatad['document_publisher'];
      $author = $myDatad['document_author'];
      $cover = $myDatad['document_cover'];

      $description = $myDatad['document_description_' . $lang];


      // if ($nomor == '4') {
      //   $style = "'";
      // }

    ?>
      <div class="col-sm-4" style='margin-bottom:30px;'>
        <div class="card" style="border-radius: 15px; background-color:white; width: 290px;">
          <div class="card-body2">

            <?php if ($cover != '') { ?>
              <img class="" src="../uploads/cover/<?php echo $cover ?>" style=" height:280px; padding: 5%; width:75%;  display: block; margin-left: auto;  margin-right: auto;" alt="Card image cap">
            <?php } else { ?>
              <img class="" src="images/pdflogo.png" style="width: 108%;" alt="Card image cap">
            <?php } ?>
          </div>
          <div class="card-body" style="min-height: 300px; width:auto">
            <style>
              .card-text {
                font-size: 13px;
                align-items: center;
                padding-left: 15px;
              }

              .card-title {
                height: 80px;
                padding-left: 15px;
                padding-right: 15px;
                line-height: 2;
                Font-size: 16px;
                font-weight: bolder;

              }
            </style>
            <br>
            <!-- Penulis -->
            <div class="row">
              <div class="card-title" style="text-align:center; text-align:center; font-size: 17px; color:black"> <b><?php echo $title; ?></b> </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <p class="card-text"><?php echo _AUTHOR ?> :</p>
              </div>
              <div class="col-sm-8">
                <p class="card-text"><?php echo $author ?></p>
              </div>
            </div>
            <!-- Penerbit -->
            <div class="row">
              <div class="col-sm-4">
                <p class="card-text"><?php echo _PUBLISHER ?> :</p>
              </div>
              <div class="col-sm-8">
                <p class="card-text"><?php echo $publisher ?></p>
              </div>
            </div>
            <!-- No Rak -->
            <?php if ($rack != '') { ?>
              <div class="row">
                <div class="col-sm-4">
                  <p class="card-text"><?php echo _LOCATION ?>:</p>
                </div>
                <div class="col-sm-8">
                  <p class="card-text"><?php echo $rack ?></p>
                </div>
              </div>
            <?php } ?>
            <!-- No Rak -->
            <?php if ($year != '') { ?>
              <div class="row">
                <div class="col-sm-4">
                  <p class="card-text"><?php echo _YEAR ?></p>
                </div>
                <div class="col-sm-8">
                  <p class="card-text"><?php echo $year ?></p>
                </div>
              </div>
            <?php } ?>
            <?php if ($description != '') { ?>
              <div class="row">
                <div class="col-sm-4">
                  <p class="card-text"><?php echo _DESC ?></p>
                </div>
                <div class="col-sm-8">
                  <p class="card-text"><?php echo $description ?></p>
                </div>
              </div>
            <?php } ?>
            <h3 class="product-title" style="text-align: right;"><a href="?page=Document-Detail&id=<?php echo $myData['document_id']; ?>" style="font-size: 16px; color:red; text-align: right; padding-right:10px;"> <b><?php echo _READ ?></b> </a></h3>
          </div>

        </div>
      </div>
    <?php } ?>
  </div>
  <br>
  <br>

</div>








<!-- /page content -->


<!-- javascript untuk carousel -->
<script>
  let slideIndex = 0;
  showSlides();

  // Next-previous control
  function nextSlide() {
    slideIndex++;
    showSlides();
    timer = _timer; // reset timer
  }

  function prevSlide() {
    slideIndex--;
    showSlides();
    timer = _timer;
  }

  // Thumbnail image controlls
  function currentSlide(n) {
    slideIndex = n - 1;
    showSlides();
    timer = _timer;
  }

  function showSlides() {
    let slides = document.querySelectorAll(".mySlides");
    let dots = document.querySelectorAll(".dots");

    if (slideIndex > slides.length - 1) slideIndex = 0;
    if (slideIndex < 0) slideIndex = slides.length - 1;

    // hide all slides
    slides.forEach((slide) => {
      slide.style.display = "none";
    });

    // show one slide base on index number
    slides[slideIndex].style.display = "block";

    dots.forEach((dot) => {
      dot.classList.remove("active");
    });

    dots[slideIndex].classList.add("active");
  }

  // autoplay slides --------
  let timer = 4; // sec
  const _timer = timer;

  // this function runs every 1 second
  setInterval(() => {
    timer--;

    if (timer < 3) {
      nextSlide();
      timer = _timer; // reset timer
    }
  }, 4000); // 1sec
</script>
<!--  -->


<?php
include "footer.php";
?>