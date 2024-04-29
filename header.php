<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="product.dev, product.dev jabalpur, product.dev piyush, product.dev courses, product.dev projects, product dev project, product dev, product dev jabalpur, product dev piyush, product dev courses, product dev projects, product dev project">
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
    <meta name="google-site-verification" content="LopNqldkYDCSrQY4o_MgrLE7pFoOkxZ8tW6HUDO0wag" />
    
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
                    <div class="row align-items-center py-lg-8 py-6">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="text-white fs-5 fs-xl-6 text-capitalize">Up Skill & Level up with project.dev</h1>
                            <p class="text-white py-lg-3 py-2">Where Vision Meets Execution: Fueling Your Projects Forward.</p>
                            <div class="d-sm-flex align-items-center gap-3">
                                <a href="courses.php" class="btn btn-success text-black mb-3 w-50">Explore Projects</a>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end mt-3 mt-lg-0"><img class="img-fluid" src="assets/img/hero/hero-graphics.png" alt="hero_section" /></div>
                    </div>
                    <div class="swiper ">
                        <div class="swiper-container swiper-shadow swiper-theme" data-swiper='{"slidesPerView":2,"breakpoints":{"640":{"slidesPerView":2,"spaceBetween":20},"768":{"slidesPerView":4,"spaceBetween":40},"992":{"slidesPerView":5,"spaceBetween":40},"1024":{"slidesPerView":4,"spaceBetween":50},"1025":{"slidesPerView":6,"spaceBetween":50}},"spaceBetween":10,"grabCursor":true,"pagination":{"el":".swiper-pagination","clickable":true},"loop":true,"freeMode":true,"autoplay":{"delay":2500,"disableOnInteraction":false}}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide text-center"><img src="assets/img/meta_icon/logo_145.png" alt="project.dev" /></div>
                                <div class="swiper-slide text-center"><img src="assets/img/meta_icon/logo_145.png" alt="project.dev" /></div>
                                <div class="swiper-slide text-center"><img src="assets/img/meta_icon/logo_145.png" alt="project.dev" /></div>
                                <div class="swiper-slide text-center"><img src="assets/img/meta_icon/logo_145.png" alt="project.dev" /></div>
                                <div class="swiper-slide text-center"><img src="assets/img/meta_icon/logo_145.png" alt="project.dev" /></div>
                                <div class="swiper-slide text-center"><img src="assets/img/meta_icon/logo_145.png" alt="project.dev" /></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of .container-->
            </section>
        </div>