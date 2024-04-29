<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>project.dev</title>
  <!-- ===============================================-->
  <!--    Meta -->
  <!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/meta_icon/180x180.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/meta_icon/32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/meta_icon/16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/meta_icon/16x16.png">
  <link rel="manifest" href="assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="assets/img/meta_icon/150x150.png">
  <meta name="theme-color" content="#ffffff">
  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <link href="vendors/prism/prism.css" rel="stylesheet">
  <link href="vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/theme.css" rel="stylesheet" />
  <!-- session -->
  <?php
  session_start();
  if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['email'], $_SESSION['user_role'], $_SESSION['user_profile_picture'])) {
    $sessionUserId =  $_SESSION['user_id'];
    $sessionUserUsername =  $_SESSION['username'];
    $sessionUserEmail =  $_SESSION['email'];
    $sessionUserRole =  $_SESSION['user_role'];
    $sessionUserProfile =  $_SESSION['user_profile_picture'];
  } else {
    $sessionUserId = 0;
    $sessionUserUsername = 0;
    $sessionUserEmail = 0;
    $sessionUserRole = 0;
    $sessionUserProfile = 0;
  }
  ?>
  <!-- session -->
</head>

<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark" data-navbar-on-scroll="data-navbar-on-scroll">
      <div class="container"><a class="navbar-brand" href="index.php"><img src="assets/img/meta_icon/Logo.png" alt="project.dev" style='width:20%' /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa-solid fa-bars text-white fs-3"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="courses.php">Project</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="about.php">About</a></li>
            <?php if ($sessionUserId == 0) { ?>
              <li class="nav-item mt-2 mt-lg-0"><a class="nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" aria-current="page" href="login.php">Login</a></li>
            <?php } else { ?>
              <li class="nav-item mt-2 mt-lg-0"><a class="nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" aria-current="page" href="login.php">Dashboard</a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
    <div class="bg-light">
      <!-- <section> begin ============================-->
      <section class="bg-dark text-center py-9 rounded-bottom ">
        <div class="container">
          <p class="text-light fs-1">About</p>
          <div class="col-12 mx-auto">
            <h1 class="text-white fs-5 fw-bold my-4">Up Skill & Level Up With Project.Dev</h1>
          </div>
          <p class="w-md-50 text-light mx-auto">Where Vision Meets Execution: Fueling Your Projects Forward.</p>
        </div>
        <!-- end of .container-->
      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->
      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pb-0">
        <div class="container">
          <div class="gallery-wraper">
            <div class="img-wraper"><img class="img-fluid shadow-sm" src="assets/img/course_logo/reactjs.png" alt="reactjs" /></div>
            <div class="img-wraper"><img class="img-fluid shadow-sm" src="assets/img/course_logo/dashboard.jpg" alt="reactjs" /></div>
            <div class="img-wraper"><img class="img-fluid shadow-sm" src="assets/img/course_logo/nodejs.png" alt="reactjs" /></div>
            <div class="img-wraper"><img class="img-fluid shadow-sm" src="assets/img/course_logo/expressjs.png" alt="reactjs" /></div>
            <div class="img-wraper"><img class="img-fluid shadow-sm" src="assets/img/course_logo/mongodb.png" alt="reactjs" /></div>
          </div>
        </div>
        <div class="px-xl-8 px-md-5 px-3 py-8 bg-dark" style='margin-top: -150px;'>
          <h1 class="fs-4 fw-bold my-4 text-white" style='padding-top: 100px;'>project.dev</h1>
          <p class="fs-1 fw-semibold text-white">Our platform is designed to support individuals bringing ideas to life and fostering creativity. Whether it's for personal development, experimentation, or showcasing your skills, project.dev is here to empower you in pursuing your projects.</p>
        </div>
        <!-- end of .container-->
      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->
  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->
  <!-- Import course icon file -->
  <?php include('technologies_banner.php') ?>
  <!-- Import FIles -->
  <?php include('footer.php') ?>