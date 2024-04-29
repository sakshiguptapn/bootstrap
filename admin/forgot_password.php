<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php'); ?>
<!-- Login Back-End Code -->
<!-- Form Start -->
<?php
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $sql_user_pass_cheack = "SELECT user_id, username, email FROM user_data WHERE username = '{$username}' AND email = '{$email}'" or die("Query Failed!! --> sql_user_pass_cheack");
  $result_sql_user_pass_cheack = mysqli_query($conn, $sql_user_pass_cheack);
  if (mysqli_num_rows($result_sql_user_pass_cheack) > 0) {
    // Create Session For OTP Auth
    session_start();
    $_SESSION['user_otp_email'] = $email;
    // OTP Generated 
    $otp = strtoupper(substr(md5(rand(11, 99)), 0, 6));
    // OTP Session for Send Email
    $_SESSION['otp_send_session'] = $otp;
    $sql_otp_create = "UPDATE user_data SET forgot_pwd_otp ='{$otp}' WHERE username = '{$username}' AND email = '{$email}'";
    if (mysqli_query($conn, $sql_otp_create)) {
      echo "<script>window.location.href='$hostname/admin/email_sender_files/forgot_password_otp_sender.php'</script>";
    } else {
      echo ("<div class='d-flex justify-content-center' style='padding-top:60px;'><p class='btn btn-danger'>Invalid Username and Email.</p></div>");
    }
  } else {
    echo ("<div class='d-flex justify-content-center' style='padding-top:60px;'><p class='btn btn-danger'>Invalid Username and Email.</p></div>");
  }
}
?>
<!-- Login Back-End Code -->
<?php ?>

<body>
  <main>
    <div class="container">
      <section class="section register d-flex flex-column align-items-center justify-content-center pb-4" style='min-height: 85vh;'>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt=<?php echo $website_display_default_name; ?>>
                  <span class="d-none d-lg-block"><?php echo $website_display_default_name; ?></span>
                </a>
              </div><!-- End Logo -->
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                    <p class="text-center small">Enter your username & email to login</p>
                  </div>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="row g-3 needs-validation" novalidate autocomplete="off">
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername">
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email">
                      <div class="invalid-feedback">Please enter your Email.</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name='login'>Get OTP</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">login</a></p>
                    </div>
                  </form>
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
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Import Vendor JS links -->
  <?php include('admin_footer_vendor_links.php') ?>