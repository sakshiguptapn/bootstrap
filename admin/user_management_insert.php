<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php'); ?>

<!-- User Insert Back-End Code -->
<?php
if (isset($_POST['save'])) {

  if (isset($_FILES['fileToUpload'])) {
    if ($_FILES['fileToUpload']["size"] > 10485760) {
      echo "<div class='alert alert-danger'>Image must be 10mb or lower.</div>";
    }
    $info = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if (isset($info['mime'])) {
      if ($info['mime'] == "image/jpeg") {
        $img = imagecreatefromjpeg($_FILES['fileToUpload']['tmp_name']);
      } elseif ($info['mime'] == "image/png") {
        $img = imagecreatefrompng($_FILES['fileToUpload']['tmp_name']);
      } elseif ($info['mime'] == "image/webp") {
        $img = imagecreatefromwebp($_FILES['fileToUpload']['tmp_name']);
      } else {
        echo "<div class='alert alert-danger'>This extension file not allowed, Please choose a JPG, JPEG, PNG or WEBP file.</div>";
      }
      if (isset($img)) {
        $output_img = date("d_M_Y_h_i_sa") . "_" . basename($_FILES['fileToUpload']["name"]) . ".webp";
        imagewebp($img, "upload_media/users_profiles_picture/" . $output_img, 100);

        $username = str_replace(' ', '', mysqli_real_escape_string($conn, $_POST['username']));
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $default_password = md5($username . '@lms');
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
        $date = Date('d-m-Y');

        $sql_insert_user = "INSERT INTO user_data (username, role, password, full_name, about_text, designation, phone, email, github, linkedin, twitter, fb, insta, youtube, profile_picture, date) VALUES ('{$username}','{$role}', '{$default_password}', '{$full_name}', '{$about_text}', '{$designation}', '{$phone}','{$email}', '{$github}','{$linkedin}', '{$twitter}','{$fb}', '{$insta}', '{$youtube}', '{$output_img}', '{$date}')";

        if (mysqli_query($conn, $sql_insert_user)) {
?>
          <script>
            alert('Record is Inserted successfully !!')
          </script>
        <?php
          // echo "<script>window.location.href='$hostname/admin/users-profile-edit.php'</script>";
        } else {
        ?>
          <script>
            alert('Record is not Insert !!')
          </script>
<?php
        }
      }
    }
  }
}
?>
<!-- User Insert Back-End Code -->

<body>
  <!-- Nav Bar -->
  <?php include("navbar.php") ?>
  <!-- Nav Bar -->
  <!-- ======= Sidebar ======= -->
  <?php include('sidebar.php') ?>
  <!-- ======= Sidebar ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Create a New User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">User Management</li>
          <li class="breadcrumb-item active">Create a New User</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="upload_media/users_profiles_picture/default_user_profile.png" alt="Profile" class="rounded-circle">
              <h2 class='text-center mt-3 pb-2'>@username</h2>
              <h3 class='text-center'>Designation</h3>
              <div class="social-links mt-5">
                <a href="#" class="linkedin"><i class="bi bi-github"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="instagram"><i class="bi bi-youtube"></i></a>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Enter User Details</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <!-- Profile Edit Form -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="pt-2">

                        <label for="img" class="btn btn-primary btn-sm" title="Upload Profile Picture"><i class="bi bi-upload">
                            <input type="file" name="fileToUpload" id="img" required />
                          </i></label>
                      </div>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="username" class="col-md-4 col-lg-3 col-form-label">User Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="username" type="text" class="form-control" id="username" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="role" class="col-md-4 col-lg-3 col-form-label">Role</label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-select" name='role' required>
                        <option value="">Choose a Authorization Level</option>
                        <option value="0">1. Administration Level</option>
                        <option value="1">2. Middle Management Level</option>
                        <option value="9">3. End User Level</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="full_name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="full_name" type="text" class="form-control" id="full_name" required>
                    </div>
                  </div>



                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about_text" class="form-control" id="about" style="height: 100px"></textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="designation" type="text" class="form-control" id="Job">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone" maxlength="10">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="github" class="col-md-4 col-lg-3 col-form-label">Github Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="github" type="text" class="form-control" id="github">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="linkedin" class="col-md-4 col-lg-3 col-form-label">linkedin Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="linkedin" type="text" class="form-control" id="linkedin">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="twitter" type="text" class="form-control" id="Twitter">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fb" type="text" class="form-control" id="Facebook">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="insta" type="text" class="form-control" id="Instagram">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="youtube" class="col-md-4 col-lg-3 col-form-label">Youtube Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="youtube" type="text" class="form-control" id="youtube">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" name='save'>Create Now</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div><!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>