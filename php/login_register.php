<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
  <title>STG - Login</title>
</head>

<body style="background-image: linear-gradient(rgba(0,0,0, .2),rgba(0,0,0, .9)), url(../img/mercedes_bg.jpg); background-size: cover; 
background-position: center center; background-attachment: fixed; ; height: 100vh;">
  <!-- Navbar başlangıcı-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

      <a class="navbar-brand" href="../html/index.html"><img src="../img/rent_a_car_logo.jpg" class="rounded-circle" alt="STG Rent a Car"
          height="50px"> STG RENT A CAR</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link fs-5" href="../html/index.html"> <img src="../img/home.png" height="25px"> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5" href="../html/cars.html"> <img src="../img/traffic-jam.png" height="25px"> Cars</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5" href="../html/contactus.html"> <img src="../img/phone.png" height="25px"> Contact
              Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5" href="../php/login_register.php"> <img src="../img/login.png" height="25px"> Login/Signup</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
  <!-- Navbar bitişi-->

  <section class="vh-100 gradient-custom">
    <div class="container-fluid py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mb-md-5 mt-md-4 pb-5">
                <form action="">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50">Please enter your e-mail and password!</p>
                <hr>
                <div class="input-group mb-3">
                  <span class="mx-4" style="padding-left: 8px;"><h3><b>  E-mail:</b></h3></span>
                  <input type="email" class="form-control" placeholder="Enter e-mail" aria-label="e-mail" required>
                </div>

                <div class="input-group mb-3">
                  <span class="mx-2" ><h3><b>Password:</b>  </h3></span>
                  <input type="password" class="form-control" placeholder="Enter password" aria-label="password" required>
                </div>
                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                <p class="medium mb-0 mt-2 pb-lg-2"><a class="text-white-50" href="../html/forgot_password.html">Forgot password?</a></p>
              </form>
              </div>
                <hr>
              <div>
                <p class="mb-0">Don't have an account? <a href="../php/signup.php" class="text-white-50 fw-bold">Sign Up</a>
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <div class="text-center p-2 mt-5 bg-dark text-muted fixed-bottom" style="background-color: rgba(88, 88, 88, 0.181);">
    © 2022 Copyright:
    <span class="fw-bold">Süleyman Türker Güner</span>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>