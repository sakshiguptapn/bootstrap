<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php'); ?>

<body>
  <!-- Nav Bar -->
  <?php include("navbar.php") ?>
  <!-- Nav Bar -->
  <!-- ======= Sidebar ======= -->
  <?php include('sidebar.php') ?>
  <!-- ======= Sidebar ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Modify User Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">User Management</li>
          <li class="breadcrumb-item active">Modify User Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <?php
          $user_id = $_GET['id'];
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Modify User Details</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <!-- Profile Edit Form -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="upload_media/users_profiles_picture/<?php echo $row_user_overview['profile_picture'] ?>" alt="Profile" style='width:100px; border-radius:50%;'>
                      <div class="pt-2 px-3">
                        <input type="file" name="new-image" id="img" style="display:none;" />
                        <label for="img" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i>&#20;Upload new profile image</label>
                        <input type="hidden" name="old-image" value="<?php echo $row_user_overview['profile_picture']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="username" class="col-md-4 col-lg-3 col-form-label">User Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="username" type="text" class="form-control" id="username" value="<?php echo $row_user_overview['username'] ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="role" class="col-md-4 col-lg-3 col-form-label">Role</label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-select" name='role' required>
                        <option disabled>Choose a Authorization Level</option>
                        <?php if ($row_user_overview['role'] == '0') { ?>
                          <option value="0" selected>1. Administration Level</option>
                          <option value="1">2. Middle Management Level</option>
                          <option value="9">3. End User Level</option>
                        <?php } elseif ($row_user_overview['role'] == '1') { ?>
                          <option value="0">1. Administration Level</option>
                          <option value="1" selected>2. Middle Management Level</option>
                          <option value="9">3. End User Level</option>
                        <?php } elseif ($row_user_overview['role'] == '9') { ?>
                          <option value="0">1. Administration Level</option>
                          <option value="1">2. Middle Management Level</option>
                          <option value="9" selected>3. End User Level</option>
                        <?php } ?>

                      </select>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="full_name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="full_name" type="text" class="form-control" id="full_name" value="<?php echo $row_user_overview['full_name'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about_text" class="form-control" id="about" style="height: 100px"><?php echo $row_user_overview['about_text'] ?></textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="designation" type="text" class="form-control" id="Job" value="<?php echo $row_user_overview['designation'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $row_user_overview['phone'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="<?php echo $row_user_overview['email'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="github" class="col-md-4 col-lg-3 col-form-label">Github Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="github" type="text" class="form-control" id="github" value="<?php echo $row_user_overview['github'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="linkedin" class="col-md-4 col-lg-3 col-form-label">linkedin Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="linkedin" type="text" class="form-control" id="linkedin" value="<?php echo $row_user_overview['linkedin'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="twitter" type="text" class="form-control" id="Twitter" value="<?php echo $row_user_overview['twitter'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fb" type="text" class="form-control" id="Facebook" value="<?php echo $row_user_overview['fb'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="insta" type="text" class="form-control" id="Instagram" value="<?php echo $row_user_overview['insta'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="youtube" class="col-md-4 col-lg-3 col-form-label">Youtube Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="youtube" type="text" class="form-control" id="youtube" value="<?php echo $row_user_overview['youtube'] ?>">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" name='save'>Save Changes</button>
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
  <!-- User Update Back-End Code -->
  <?php
  if (isset($_POST['save'])) {
    $file_name = '';
    if (empty($_FILES['new-image']['name'])) {
      $save_img_name = $_POST['old-image'];
    } else {
      if (isset($_FILES['new-image'])) {
        $file_name = $_FILES['new-image']["name"];
        $file_tmp = $_FILES['new-image']["tmp_name"];
        $file_type = $_FILES['new-image']["type"];
        $file_size = $_FILES['new-image']["size"];
        $tempFileExt = explode('.', $file_name);
        $file_ext = strtolower(end($tempFileExt));
        $allow_extension = array("jpg", "jpeg", "png", "webp");
        $file_error = array();
        if (in_array($file_ext, $allow_extension) === false) {
          $file_error[] = "This extension file not allowed, Please choose a JPG or PNG file.";
        }
        if ($file_size > 2097152) {
          $file_error[] = "Image must be 2mb or lower.";
        }
        $save_img_name = date("d_M_Y_h_i_sa") . "_" . basename($file_name);
        $img_save_target = "upload_media/users_profiles_picture/";
        if (empty($file_error) == true) {
          move_uploaded_file($file_tmp, $img_save_target . $save_img_name);
        } else {
          print_r($file_error);
          die();
        }
      }
    }
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $about_text = mysqli_real_escape_string($conn, $_POST['about_text']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $github = mysqli_real_escape_string($conn, $_POST['github']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);
    $twitter = mysqli_real_escape_string($conn, $_POST['twitter']);
    $fb = mysqli_real_escape_string($conn, $_POST['fb']);
    $insta = mysqli_real_escape_string($conn, $_POST['insta']);
    $youtube = mysqli_real_escape_string($conn, $_POST['youtube']);
    $sql_update_user = "UPDATE user_data SET username = '{$username}', role = '{$role}', full_name = '{$full_name}', about_text = '{$about_text}', designation = '{$designation}', phone = '{$phone}', email= '{$email}', github = '{$github}', linkedin= '{$linkedin}', twitter = '{$twitter}', fb= '{$fb}', insta = '{$insta}', youtube = '{$youtube}', profile_picture = '{$save_img_name}' WHERE user_id ='{$user_id}'";
    if (mysqli_query($conn, $sql_update_user)) {
  ?>
      <script>
        alert('Record is Update successfully !!')
      </script>
    <?php
      echo "<script>window.location.href='$hostname/admin/user_management_read.php'</script>";
    } else {
    ?>
      <script>
        alert('Record is not Update !!')
      </script>
  <?php
    }
  }
  ?>
  <!-- User Update Back-End Code -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>