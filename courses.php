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

<body style="overflow-x: hidden;">
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
    <div class="bg-dark"><img class="img-fluid position-absolute end-0" src="assets/img/hero/hero-bg.png" alt="Hero Section" />
      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section>
        <div class="container">
          <div class="row ">
            <div class="col-md-12 text-center d-flex gap-2 justify-content-start align-items-center pt-lg-8">
              <a href="index.php" class="text-white"><i class="bi bi-house bg-success rounded-circle text-center px-2 py-1 pb-2"></i>
                Home</a>
              <i class="bi bi-chevron-right text-white "></i>
              <a class="text-white">Project</a>
            </div>
          </div>
        </div>
    </div>
    <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    </div>
    <!-- <Course Section> ============================================-->
    <!-- <section> begin ============================-->
    <!-- <section> close ============================-->
    <!-- <Course Section> ============================================-->
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-white mb-0 pb-0">
      <div class="container">
        <div class="col-md-12 pb-4">
          <h1 class="text-dark fw-bold fs-4 text-center">Explore Our Project</h1>
        </div>
        <div class="row pt-5 justify-content-center">
          <!-- Fetch course data -->
          <?php
          include('private_files/system_configure_setting.php');
          $sql_fetch_all_courses = "SELECT course.cid, course.title, course.poster, course.sell_price, course.main_price, course.active_record , chapter.course_id, COUNT(chapter.course_id) AS num_of_chapter
          FROM course
          INNER JOIN chapter ON course.cid = chapter.course_id
          WHERE course.active_record = 'Yes'
          AND chapter.active_record = 'Yes'
          GROUP BY chapter.course_id
          ORDER BY course.cid DESC LIMIT 0,12";
          $result_sql_fetch_all_courses = mysqli_query($conn, $sql_fetch_all_courses) or die("Query Failed!!");
          if (mysqli_num_rows($result_sql_fetch_all_courses) > 0) {
            while ($row_sql_fetch_all_courses = mysqli_fetch_assoc($result_sql_fetch_all_courses)) {
          ?>
              <!-- Card -->
              <div class="col-lg-4 pb-5">
                <a href="courses_single.php?course_id=<?php echo $row_sql_fetch_all_courses['cid']; ?>">
                  <div class="card rounded-2 shadow-sm">
                    <img src="admin/upload_media/courses_poster/<?php echo $row_sql_fetch_all_courses['poster'] ?>" class="card-img-top" alt="<?php echo $row_sql_fetch_all_courses['title'] ?>" style="border-top-right-radius: 24px; border-top-left-radius: 24px">
                    <div class="card-body p-3">
                      <h5 class="card-title pb-2 px-2" style="font-size: 25px; font-weight: 600;"><?php echo $row_sql_fetch_all_courses['title'] ?></h5>
                      <div class="d-flex gap-2 justify-content-start  align-items-center px-2 border-top border-success pt-2">
                        <div>
                          <i class="bi bi-star-fill" style="color:#F6B100"></i>
                          <i class="bi bi-star-fill" style="color:#969494"></i>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center pt-2">
                        <div class="px-2">
                          <p class="card-text fw-semibold text-dark" style="font-size: 18px; font-weight: 600;">₹
                            <?php echo $row_sql_fetch_all_courses['sell_price'] ?>
                            <sup class="py-1 px-2 rounded-2 bg-success text-dark ms-2 text-decoration-line-through" style="font-size: 14px;">₹ <?php echo $row_sql_fetch_all_courses['main_price'] ?></sup>
                          </p>
                        </div>
                        <div class="card-text fw-semibold text-dark px-3" style="font-size: 14px; font-weight: 600;">
                          <i class="bi bi-layers"></i><span> <?php echo $row_sql_fetch_all_courses['num_of_chapter'] ?> Chapters</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <!-- Card -->
          <?php }
          } ?>
        </div>
      </div>
      <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    <!-- Import course icon file -->
    <?php include('technologies_banner.php') ?>
    <!-- Import FIles -->
    <?php include('footer.php') ?>