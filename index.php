<!-- Import Files -->
<?php include('header.php');
include('private_files/system_configure_setting.php');
// Trafic Analysis code 
function get_device_info()
{
  $isMobileDevice = is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile"));
  if ($isMobileDevice == 1) {
    return 'Mobile & Tablet';
  } else {
    return 'Computer & Laptop';
  }
}
$device = get_device_info();
function get_browser_info()
{
  $user_agent = $_SERVER['HTTP_USER_AGENT'];
  if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) {
    return 'Opera';
  } elseif (strpos($user_agent, 'Edge') || strpos($user_agent, 'Edg')) {
    return 'Edge';
  } elseif (strpos($user_agent, 'Chrome')) {
    return 'Chrome';
  } elseif (strpos($user_agent, 'Safari')) {
    return 'Safari';
  } elseif (strpos($user_agent, 'Firefox')) {
    return 'Firefox';
  } elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) {
    return 'Internet Explorer';
  } else {
    return 'Other';
  }
}
$browser = get_browser_info();
date_default_timezone_set("Asia/Kolkata");
$dateObject = new DateTime(date("h:m", time()));
$time = $dateObject->format('h:i A');
$date = Date('d-M-Y');
// Fetch current trafic count
$trafic_count = array();
$sql_fetch_trafic_record = "SELECT * FROM trafic ORDER BY trafic_id DESC";
$result_sql_fetch_trafic_record = mysqli_query($conn, $sql_fetch_trafic_record) or die("Query Failed!!");
if (mysqli_num_rows($result_sql_fetch_trafic_record) > 0) {
  while ($row_sql_fetch_trafic_record = mysqli_fetch_assoc($result_sql_fetch_trafic_record)) {
    $trafic_count[] = $row_sql_fetch_trafic_record['trafic_count'];
  }
  $newTraficCount = $trafic_count[0] + 1;
  // Insert Record
  $sql_insert_trafic_record = "INSERT INTO trafic (trafic_count, trafic_device, trafic_browser, trafic_time, trafic_date)
VALUES ('{$newTraficCount}','{$device}','{$browser}','{$time}','{$date}')";
  if (mysqli_query($conn, $sql_insert_trafic_record)) {
  }
} ?>
<!-- Trafic Analysis code -->
<!-- Import course icon file -->
<?php include('course_icon_slider.php'); ?>
<!-- <section> begin ============================-->
<section>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 text-center text-lg-start"><img class="img-fluid" src="assets/img/course_logo/technology.png" alt="code" />
      </div>
      <div class="col-lg-6">
        <h1 class="fs-xl-5 fs-lg-4 fs-3">Build your next project with Trending Technologies.</h1>
        <ul class="list-unstyled my-xl-5 my-3">
          <li class="fs-2 my-4 d-flex align-items-center gap-3 text-black"><i class="fa-solid fa-circle-check fs-4 text-dark"></i><span>Trending Technologies.</span></li>
          <li class="fs-2 my-4 d-flex align-items-center gap-3 text-black"><i class="fa-solid fa-circle-check fs-4 text-dark"></i><span>Scalable Application</span></li>
          <li class="fs-2 my-4 d-flex align-items-center gap-3 text-black"><i class="fa-solid fa-circle-check fs-4 text-dark"></i><span>Secure Application</span></li>
        </ul>
        <a href="courses.php" class="btn btn-dark">Start now</a>
      </div>
    </div>
  </div>
  <!-- end of .container-->
</section>
<!-- <section> close ============================-->
<!-- ============================================-->
<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-8 pt-lg-0">
  <div class="container">
    <div class="d-flex flex-column-reverse flex-lg-row gap-5">
      <div class="col-lg-6">
        <h1 class="fs-lg-4 fs-md-3 fs-xl-5 mb-5">Empowering Minds through Hands-On Exploration, Project Based Learning Unleashed.</h1>
        <ul class="list-unstyled">
          <li class="fs-2 shadow-sm offer-list-item"><i class="fa-solid fa-leaf fs-lg-4 fs-3"></i><span>Effortless Documentation</span></li>
          <li class="fs-2 shadow-sm offer-list-item"><i class="fa-solid fa-eye fs-lg-4 fs-3"></i><span>Open Source Projects</span></li>
        </ul>
      </div>
      <div class="col-lg-6 text-center text-lg-end">
        <img class="img-fluid rounded-2" src="assets/img/course_logo/dashboard.jpg" />
      </div>
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