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
  <?php
  include('private_files/system_configure_setting.php');
  if (!isset($_GET['course_id'])) {
    echo "
  <script>
    window.location.href = '$hostname/courses.php';
  </script>";
  }
  $course_id = $_GET['course_id'];
  ?>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top" style="background: #0A2640;">
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
    <div class="bg-dark pt-5" style="height: 250px;"><img class="img-fluid position-absolute end-0" src="assets/img/hero/hero-bg.png" alt="Hero Section" />
      <!-- ============================================-->
      <!-- Fetch Course Data -->
      <!-- Fetch course data -->
      <?php
      $sql_fetch_courses = "SELECT * FROM course      
      WHERE active_record = 'Yes' AND cid = '{$course_id}'";
      $result_sql_fetch_courses = mysqli_query($conn, $sql_fetch_courses) or die("Query Failed!!");
      if (mysqli_num_rows($result_sql_fetch_courses) > 0) {
        while ($row_sql_fetch_courses = mysqli_fetch_assoc($result_sql_fetch_courses)) {
      ?>
          <!-- <section> begin ============================-->
          <div class="container pt-5">
            <div class="row py-5">
              <div class="col-md-12 pt-5 text-center d-flex gap-2 justify-content-start align-items-center">
                <a href="#" class="text-white"><i class="bi bi-house bg-success rounded-circle text-center px-2 py-1 pb-2"></i>
                  Home</a>
                <i class="bi bi-chevron-right text-white "></i>
                <a href="courses.php" class="text-white">Project</a>
                <i class="bi bi-chevron-right text-white "></i>
                <a class="text-white"><?php echo $row_sql_fetch_courses['title'] ?></a>
              </div>
            </div>
          </div>
    </div>
    <!-- end of .container-->
    <!-- <section> close ============================-->
    <!-- ============================================-->
    </div>
    <!-- <section> begin ============================-->
    <section class="bg-white">
      <div class="row flex-lg-row-reverse px-5">
        <div class="col-lg-5">
          <img src="admin/upload_media/courses_poster/<?php echo $row_sql_fetch_courses['poster'] ?>" alt="course poster" class="w-100 rounded-2">
          <div class="pt-4 pb-2 d-flex gap-2">
            <h3 style="font-weight: 600;">₹ <?php echo $row_sql_fetch_courses['sell_price'] ?> <sup class="text-decoration-line-through" style="color:gray">₹ <?php echo $row_sql_fetch_courses['main_price'] ?></sup>
            </h3>
            <h4 style="font-weight: 600;" class="px-3"><?php echo $row_sql_fetch_courses['discount'] ?>% Off</h4>
          </div>
          <div class="pt-2 pb-2 w-100">
            <!-- Conditional Rendring -->
            <?php
            $sql_isEnroll = "SELECT * FROM enrollment WHERE course_id = '{$course_id}' AND enroll_user_id = '{$sessionUserId}'" or die("Query Failed!! --> sql_isEnroll");
            $result_sql_isEnroll = mysqli_query($conn, $sql_isEnroll);
            if (mysqli_num_rows($result_sql_isEnroll) > 0) {
            ?>
              <a href="study_area.php?course_id=<?php echo $row_sql_fetch_courses['cid']; ?>" class="rounded-2 fs-1 fw-semibold text-white" style="background: #198754; padding: 10px 40px;">Enter Study Area</a>
            <?php
            } else {
            ?>
              <a href="enrollment.php?course_id=<?php echo $row_sql_fetch_courses['cid']; ?>" class="rounded-2 bg-danger fs-1 fw-semibold text-white" style="padding: 10px 40px;">Enroll
                Now</a>
            <?php
            }
            ?>
          </div>
          <div class="pt-4 pb-2 px-4">
            <li><?php echo $row_sql_fetch_courses['feature_1'] ?></li>
            <li><?php echo $row_sql_fetch_courses['feature_2'] ?></li>
            <li><?php echo $row_sql_fetch_courses['feature_3'] ?></li>
            <li><?php echo $row_sql_fetch_courses['feature_4'] ?></li>
          </div>
        </div>
        <div class="col-lg-7">
          <h3 style="font-weight: 600;"><?php echo $row_sql_fetch_courses['title'] ?></h3>
          <h5>Level: <?php echo $row_sql_fetch_courses['level'] ?></h5>
          <div class="d-flex gap-2 justify-content-start align-content-center pb-2">
            <i class="bi bi-star-fill" style="color:#F6B100"></i>
            <i class="bi bi-star-fill" style="color:#F6B100"></i>
            <i class="bi bi-star-fill" style="color:#F6B100"></i>
            <i class="bi bi-star-fill" style="color:#F6B100"></i>
            <i class="bi bi-star-fill" style="color:#969494"></i>
            <i class="pt-1">17 Reviews</i>
          </div>
          <div class="pt-5 pb-2">
            <h3 style="font-weight: 600;">What you will learn from this course?</h3>
            <h5><i class="bi bi-check2-all"></i> <?php echo $row_sql_fetch_courses['learning_skill_1'] ?></h5>
            <h5><i class="bi bi-check2-all"></i> <?php echo $row_sql_fetch_courses['learning_skill_2'] ?></h5>
            <h5><i class="bi bi-check2-all"></i> <?php echo $row_sql_fetch_courses['learning_skill_3'] ?></h5>
          </div>
          <div class="pt-5 pb-2">
            <h3 style="font-weight: 600;">What are the prerequisites for starting this course?</h3>
            <h5><i class="bi bi-check2-all"></i> <?php echo $row_sql_fetch_courses['prerequisties_1'] ?></h5>
            <h5><i class="bi bi-check2-all"></i> <?php echo $row_sql_fetch_courses['prerequisties_2'] ?></h5>
            <h5><i class="bi bi-check2-all"></i> <?php echo $row_sql_fetch_courses['prerequisties_3'] ?></h5>
          </div>
          <!-- Course Details -->
          <div class="pt-5 pb-2">
            <h3 style="font-weight: 600;">Course Details</h3>
            <h5><?php echo $row_sql_fetch_courses['description'] ?></h5>
          </div>
          <!-- Course Details -->
          <div class="pt-5 pb-2">
            <div class="col-lg-12">
              <h3 style="font-weight: 600;">Course Overview</h3>
              <!-- Accordion without outline borders -->
              <div class="accordion accordion-flush" id="accordionFlushExample">
                <!-- Fetch All Chapter From Database -->
                <?php
                $sql_fetch_all_chapter = "SELECT * FROM chapter
                WHERE active_record = 'Yes'
                AND course_id = '{$course_id}'
                ORDER BY chapter_index";
                $idx = 1;
                $result_sql_fetch_all_chapter = mysqli_query($conn, $sql_fetch_all_chapter) or die("Query Failed!!");
                if (mysqli_num_rows($result_sql_fetch_all_chapter) > 0) {
                  while ($row_sql_fetch_all_chapter = mysqli_fetch_assoc($result_sql_fetch_all_chapter)) {
                ?>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-heading<?php echo $idx; ?>">
                        <button class="accordion-button collapsed bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $idx; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $idx; ?>">
                          <h5><i class="bi bi-check2-all"></i> Chapter: <?php echo $idx; ?></h5>
                        </button>
                      </h2>
                      <div id="flush-collapse<?php echo $idx; ?>" class="accordion-collapse collapse bg-white" aria-labelledby="flush-heading<?php echo $idx; ?>" data-bs-parent="#accordionFlushExample<?php echo $idx; ?>">
                        <h5 class="px-5">• <?php echo $row_sql_fetch_all_chapter['chapter_title'] ?></h5>
                      </div>
                    </div>
                <?php
                    $idx++;
                  }
                } ?>
              </div>
              <!-- End Accordion without outline borders -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- <section> close ============================-->
<?php }
      } else {
        echo "
        <script>
          window.location.href = '$hostname/courses.php';
        </script>";
      } ?>
  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->
  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <!-- Import FIles -->
  <?php include('footer.php') ?>