<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap 5  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Main Page</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#007dd6;font-size: 19px;">
    <div class="container" >
        <a class="navbar-brand" href="home.php">
            <img src="assets/images/ecomLogo.png" width="45" height="30" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item active"> -->
                <li class="nav-item">
                <div class="nav-link inactiveLink"  >CAMPUS ECOM<span class="sr-only">(current)</span></div>
                </li>
            </ul>

            <ul class="navbar-nav  ">
                <li class="nav-item ">
                    <a class="nav-link mr-auto" href="#home">Main<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link mr-auto" href="#about">About<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link mr-auto" href="#benefit">Benefits<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link mr-auto" href="#contact" style="padding-right: 20px;">Contact<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" style="background-color: turqoise ;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="views/user/userLogin.php">User </a>
                        <a class="dropdown-item" href="views/vendor/vendorLogin.php">Vendor</a>
                        <a class="dropdown-item" href="views/admin/adminLogin.php">Admin</a>
                    </div>
                </div>
                </li>
            </ul>
        </div>
  </div>

</nav >
<div style="background-color: white; " id="home">
  <div class="container " style="background-color: white; border-radius:10px;">
     <div class="d-flex justify-content-center">
        <div class="col-md-12" style="padding: 95px 20px 20px 20px;">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary text-dark">Eccommerce</strong>
              <h3 class="mb-0">
                <h1 class="" id="home">FOR THE CAMPUS ECONOMY</h1>
              </h3>
              <div class="mb-1 text-muted" style="padding: 2px; font-size: 20px;">Come Shop with Campus Ecom</div>
              <div class="mb-1 text-muted" style="padding: 2px; font-size: 20px;">A One Stop Shop to Buy or Sell Products</div>
              <div class="mb-1 text-muted" style="padding: 2px; font-size: 20px;">Brought to You by Foodle Inc</div>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" src="assets/images/Homepage.jpg" alt="Card image cap">
          </div>
        </div>
      </div>

    </div>
    </div>

<div class="container mt-4 my-5" style="background-color: white; border-radius:10px;"  id="about">
  <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->
      <div class="title " >
      <h1 class="flex title" >WHAT WE DO</h1>
      </div>
      <div class="container marketing ">

        <!-- Three columns of text below the carousel -->
        <div class="row" >
          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2 class="p-2">Platform</h2>
            <p style="font-size: 18px;">Offers an online platform for studies to conduct sales</p>

          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2 class="p-2">Audience</h2>
            <p style="font-size: 18px;">Vendors can promote their product & reach their audience </p>

          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2 class="p-2">Ease of Use</h2>
            <p style="font-size: 18px;">Its easier to do buisness online rather than manually</p>

          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div>
</div>

<div style="background-color: white ;" id="benefit">
  <div class="container mt-4" style="background-color: white; border-radius:10px;">
  <!-- CAROUSSEL -->
    <div class="row mt-3">
      <div class="col-sm pt-5">
      <div id="myCarousel" class="carousel slide" data-ride="carousel" >
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="first-slide" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmkxtHaF70z-7attFIsBcI9LqZZSaYnvdtGA&usqp=CAU" alt="First slide">
              <div class="container">
                <div class="carousel-caption text-left">
                  <h1>Example headline.</h1>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                  <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                </div>
              </div>
            </div>
            <div class="carousel-item" >
              <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
              <div class="container">
                <div class="carousel-caption">
                  <h1>Another example headline.</h1>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                  <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
              <div class="container">
                <div class="carousel-caption text-right">
                  <h1>One more for good measure.</h1>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                  <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <!-- NEXT TO CAROUSSEL-->
      <div class="col-sm mt-3">
        <div class="container " style="background-color: white; border-radius:10px;">
          <div class="d-flex justify-content-center">
              <div class="col-md-12" style="padding: 55px 20px 20px 20px;">
                <div class="card flex-md-row mb-4 box-shadow " style="border-radius: 7px;">
                  <div class="card-body d-flex flex-column align-items-start">
                    <h3 class="mb-0">
                      <h1 class="" >Upsides Using Us</h1>
                    </h3>
                    <div class="mb-1 text-muted" style="padding: 2px; font-size: 20px;">- Online Payment</div>
                    <div class="mb-1 text-muted" style="padding: 2px; font-size: 20px;">- Product Variety</div>
                    <div class="mb-1 text-muted" style="padding: 2px; font-size: 20px;">- Time Saving</div>

                  </div>
                </div>
              </div>
            </div>
         </div>
         <div class="container " style="background-color: white; border-radius:10px;">
          <div class="d-flex justify-content-center">
              <div class="col-md-12" style="padding:10x 20px 20px 20px;">
                <div class="card flex-md-row mb-4 box-shadow " style="border-radius: 7px;">
                  <div class="card-body d-flex flex-column align-items-start">
                    <h3 class="mb-0">
                      <h1 class="" >Categories?</h1></h1>
                    </h3>
                    <div class="mb-1 text-muted" style="padding: 2px; font-size: 20px;">- Accesories</div>
                    <div class="mb-1 text-muted" style="padding: 2px; font-size: 20px;">- Apparel</div>
                    <div class="mb-1 text-muted" style="padding: 2px; font-size: 20px;">- Electronics</div>

                  </div>
                </div>
              </div>
            </div>
         </div>
      </div>

    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

    <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

<div class="container" id="contact" >
  <div class="row gy-3" style="margin-left: 100px;">
    <div class="col-lg-4 col-md-6 d-flex " style="padding-right: 20px;">
      <i class="bi bi-geo-alt icon"></i>
      <div>
        <h4>Address</h4>
        <p>
          Jalan Hang Tuah <br>
          Melaka, ML 76100 - Malaysia<br>
        </p>
      </div>

    </div>

    <div class="col-lg-4 col-md-6 footer-links d-flex">
      <i class="bi bi-telephone icon"></i>
      <div>
        <h4>Contact</h4>
        <p>
          <strong>Phone:</strong>01110646220<br>
          <strong>Email:</strong> ecomAdmin@gmail.com<br>
        </p>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 footer-links d-flex">
      <i class="bi bi-clock icon"></i>
      <div>
        <h4>HQ Hours</h4>
        <p>
          <strong>Monday-Friday: 9AM</strong> - 6PM<br>
          Saturday & Sunday: Closed
        </p>
      </div>
    </div>



  </div>
</div>

 <footer>
                <div class="mt-4 text-center py-1 " style="background-color: #007dd6">
                    <p style="color: white;">All rights reserved &reg; Developed By Foodle</p>
                </div>
    </footer>

</footer><!-- End Footer -->
</html>
