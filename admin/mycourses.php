<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php') ?>

<body>
  <!-- Nav Bar -->
  <?php include("navbar.php") ?>
  <!-- Nav Bar -->
  <!-- ======= Sidebar ======= -->
  <?php include('sidebar.php') ?>
  <!-- ======= Sidebar ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>My Courses</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">My Courses</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
      <div class="row">

        <!-- Fetch course data -->
        <?php
        $login_user_id = $_SESSION['user_id'];
        $sql_fetch_all_courses = "SELECT course.cid, course.title, course.poster, course.sell_price, course.main_price, course.active_record , chapter.course_id, enrollment.course_id, enrollment.enroll_user_id, COUNT(chapter.course_id) AS num_of_chapter
          FROM course
          INNER JOIN chapter ON course.cid = chapter.course_id
          INNER JOIN enrollment ON course.cid = enrollment.course_id
          WHERE course.active_record = 'Yes'
          AND enrollment.enroll_user_id = '{$login_user_id}'
          GROUP BY chapter.course_id
          ORDER BY course.cid DESC LIMIT 0,12";
        $result_sql_fetch_all_courses = mysqli_query($conn, $sql_fetch_all_courses) or die("Query Failed!!");
        if (mysqli_num_rows($result_sql_fetch_all_courses) > 0) {
          while ($row_sql_fetch_all_courses = mysqli_fetch_assoc($result_sql_fetch_all_courses)) {
        ?>
            <!-- Card -->
            <div class="col-lg-4 pb-5">
              <a href="<?php echo $hostname ?>/study_area.php?course_id=<?php echo $row_sql_fetch_all_courses['cid']; ?>">
                <div class="card rounded-2 shadow-sm">
                  <img src="upload_media/courses_poster/<?php echo $row_sql_fetch_all_courses['poster'] ?>" class="card-img-top" alt="<?php echo $row_sql_fetch_all_courses['title'] ?>">
                  <div class="card-body p-3">
                    <h5 class="card-title pb-2 px-2" style="font-size: 25px; font-weight: 600;"><?php echo $row_sql_fetch_all_courses['title'] ?></h5>
                    <div class="d-flex gap-2 justify-content-start  align-items-center px-2 border-top border-success pt-2">
                      <div>
                        <i class="bi bi-star-fill" style="color:#F6B100"></i>
                        <i class="bi bi-star-fill" style="color:#F6B100"></i>
                        <i class="bi bi-star-fill" style="color:#F6B100"></i>
                        <i class="bi bi-star-fill" style="color:#F6B100"></i>
                        <i class="bi bi-star-fill" style="color:#969494"></i>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-2">
                      <div class="px-2">
                        <p class="card-text fw-semibold text-dark" style="font-size: 18px; font-weight: 600;">₹
                          <?php echo $row_sql_fetch_all_courses['sell_price'] ?>
                          <sup class="py-1 px-2 rounded-2 bg-success text-white ms-2 text-decoration-line-through" style="font-size: 14px;">₹ <?php echo $row_sql_fetch_all_courses['main_price'] ?></sup>
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
        } else {
          ?>

          <!-- Card -->
          <div class="col-lg-4 pb-5">
            <div class="card">
              <div class="card-body d-flex flex-column justify-content-center  align-items-center py-5 text-danger">
                <i class="bi bi-trash2-fill display-1"></i>
                <h5 class='fw-bold pt-2'>Your don't have a any course</h5>
              </div>
            </div>
          </div>
          <!-- Card -->

        <?php
        } ?>


      </div>

    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>