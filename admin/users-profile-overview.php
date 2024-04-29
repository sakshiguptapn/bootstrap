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
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <?php $user_id = $_SESSION['user_id'];
          $sql_show_user_overview = "SELECT * FROM user_data WHERE user_id = '{$user_id}' ";
          $result_sql_show_user_overview = mysqli_query($conn, $sql_show_user_overview) or die("Query Failed!!");
          if (mysqli_num_rows($result_sql_show_user_overview) > 0) {
            while ($row_user_overview = mysqli_fetch_assoc($result_sql_show_user_overview)) {
          ?>
              <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                  <img src="upload_media/users_profiles_picture/<?php echo $row_user_overview['profile_picture'] ?>" alt="Profile" class="rounded-circle">
                  <h2 class='text-center mt-3 pb-2'>@<?php echo $row_user_overview['username'] ?></h2>
                  <h3 class='text-center'><?php echo $row_user_overview['designation'] ?></h3>
                  <div class="social-links mt-5">
                    <a href="<?php echo $row_user_overview['github'] ?>" class="linkedin"><i class="bi bi-github"></i></a>
                    <a href="<?php echo $row_user_overview['linkedin'] ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    <a href="<?php echo $row_user_overview['twitter'] ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="<?php echo $row_user_overview['fb'] ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="<?php echo $row_user_overview['insta'] ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="<?php echo $row_user_overview['youtube'] ?>" class="instagram"><i class="bi bi-youtube"></i></a>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>
                <li class="nav-item">
                  <a style='color:#2c384e' href="users-profile-edit.php" class="nav-link">Edit Profile</a>
                </li>
                <li class="nav-item">
                  <a style='color:#2c384e' href="users-profile-settings.php" class="nav-link">Settings</a>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?php echo $row_user_overview['about_text'] ?></p>
                  <h5 class="card-title">Profile Details</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">User Name</div>
                    <div class="col-lg-9 col-md-8">@<?php echo $row_user_overview['username'] ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row_user_overview['full_name'] ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row_user_overview['designation'] ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row_user_overview['phone'] ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row_user_overview['email'] ?></div>
                  </div>
                </div>
            <?php }
          } ?>
              </div><!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>