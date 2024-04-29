<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php') ?>

<!-- Register User Back-End Code -->
<?php
if (isset($_POST['save'])) {
  $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, md5($_POST['password']));
  $role = '9';
  $date = Date('d-m-Y');
  $defult_user_profile = 'default_user_profile.png';

  $sql_user_cheack = "SELECT username FROM user_data WHERE email = '{$email}'";
  $result_user_cheack = mysqli_query($conn, $sql_user_cheack) or die("Query Die ( sql_user_cheack )!!");

  if (mysqli_num_rows($result_user_cheack) > 0) { ?>
    <script>
      alert('Email already Exsits !!')
    </script>
    <?php
    echo ("<div class='d-flex justify-content-center' style='margin-bottom:-50px; padding-top:15px;'><p class='btn btn-danger'>Email already Exsits !!</p></div>");
  } else {
    // Create Session For OTP Auth
    session_start();
    $_SESSION['user_otp_email'] = $email;
    // OTP Generated 
    $otp = strtoupper(substr(md5(rand(11, 99)), 0, 6));
    // OTP Session for Send Email
    $_SESSION['otp_send_session'] = $otp;
    $sql_insert_user = "INSERT INTO user_data (full_name, username, password, role, profile_picture, forgot_pwd_otp, email, date) values('{$full_name}','{$username}','{$password}', '{$role}','{$defult_user_profile}','{$otp}','{$email}','{$date}')";
    if (mysqli_query($conn, $sql_insert_user)) {
    ?>
      <script>
        alert('Email was send successfull to your registered email.')
      </script>
<?php
      echo "<script>window.location.href='$hostname/admin/email_sender_files/registration_otp_sender.php'</script>";
    }
  }
}
?>
<!-- Register User Back-End Code -->

<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <!-- logo -->
              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="d-flex justify-content-center w-full">
                  <img src="assets/img/meta_icon/Logo.png" style="width: 65%;" alt=<?php echo $website_display_default_name; ?>>
                </a>
              </div><!-- End Logo -->
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <!-- Register Form -->
                  <form <?php $_SERVER['PHP_SELF'] ?> method="POST" autocomplete="off" class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="full_name" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope-at-fill"></i></span>
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Please enter your Email.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>


                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="password"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">Please enter your Password.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="save">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                  </form>
                  <!-- Register Form -->
                </div>
              </div>
              <!-- Import Copyright File -->
              <?php include('copyright/copyright.php') ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->
  <a class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Import Vendor JS links -->
  <?php include('admin_footer_vendor_links.php') ?>