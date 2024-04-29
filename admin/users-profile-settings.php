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
                  <a style='color:#2c384e' href="users-profile-overview.php" class="nav-link">Overview</a>
                </li>
                <li class="nav-item">
                  <a style='color:#2c384e' href="users-profile-edit.php" class="nav-link">Edit Profile</a>
                </li>
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit"><a href="users-profile-settings.php">Settings</a></button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <!-- Profile Edit Form -->
                  <form>
                    <?php $two_factor_auth = '';
                    if ($row_user_overview['tfa'] == 'No') {
                      $two_factor_auth = 'Disable';
                    } else {
                      $two_factor_auth = 'Enable';
                    } ?>
                    <div class="row mb-3 pt-3">
                      <label for="full_name" class="col-md-8 col-lg-9 col-form-label">Two-Factor Authentication is <?php echo $two_factor_auth ?> </label>
                      <div class="col-md-4 col-lg-3">
                        <?php if ($row_user_overview['tfa'] == 'No') { ?>
                          <button type="submit" class="btn btn-success"><a style='color:#fff' href="two_factor_authentication.php">Enable</a></button>
                        <?php } else {
                        ?>
                          <a class="btn btn-outline-danger" href="two_factor_authentication_disable.php">Disable</a>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <!-- // Delete User account -->
                    <div class="row mb-3 border-top pt-3">
                      <div class="col-md-8 col-lg-9">
                        <label for="full_name" class="col-form-label">Deactivate account</label>
                        <p style="color:#B2BEB5">Note: Once you delete your account there's no getting it back. Make sure going forward with this will delete all your data from our platform such as email and cached files.</p>
                      </div>
                      <div class="col-md-4 col-lg-3">
                        <a class="btn btn-outline-danger" href="deactivate_user_account.php">Deactivate</a>
                      </div>
                    </div>
                  </form><!-- End Profile Edit Form -->
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
  <script>
    function btnClick() {
      console.log('Click');
    }
  </script>
  <?php include('admin_footer.php') ?>