<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php'); ?>
<!-- Login Back-End Code -->
<!-- Form Start -->
<?php
if (isset($_POST['login'])) {
  session_start();
  $username = $_SESSION['otp_username'];
  $email = $_SESSION['otp_email'];
  $top_auth = $_SESSION['otp_auth'];
  $password1 = mysqli_real_escape_string($conn,  md5($_POST['password1']));
  $password2 = mysqli_real_escape_string($conn,  md5($_POST['password2']));
  $password1_unsafe = mysqli_real_escape_string($conn, $_POST['password1']);
  $password2_unsafe = mysqli_real_escape_string($conn, $_POST['password2']);
  if ($password1_unsafe == $password2_unsafe) {
    $sql_user_pass_cheack = "UPDATE user_data SET password ='{$password1}' WHERE username = '{$username}' AND email = '{$email}' AND forgot_pwd_otp = '{$top_auth}'" or die("Query Failed!! --> sql_user_pass_cheack");
    $result_sql_user_pass_cheack = mysqli_query($conn, $sql_user_pass_cheack);
    if (mysqli_query($conn, $sql_user_pass_cheack)) {
?>
      <script>
        alert('Password is reset successfull.')
      </script>
<?php
      echo "<script>window.location.href='$hostname/login.php'</script>";
    } else {
      echo ("<div class='d-flex justify-content-center' style='padding-top:60px;'><p class='btn btn-danger'>OTP Not Match.</p></div>");
    }
  } else {
    echo ("<div class='d-flex justify-content-center' style='padding-top:60px;'><p class='btn btn-danger'>Password not match.</p></div>");
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
                    <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                    <p class="text-center small">Create a new password</p>
                  </div>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="row g-3 needs-validation" novalidate autocomplete="off">
                    <div class="col-12">
                      <label for="password1" class="form-label">Enter Your Password</label>
                      <input type="password" name="password1" class="form-control" id="password1">
                      <div class="invalid-feedback">Please enter your password.</div>
                    </div>
                    <div class="col-12">
                      <label for="password2" class="form-label">Re-Enter Your Password</label>
                      <input type="text" name="password2" class="form-control" id="password2">
                      <div class="invalid-feedback">Please re-enter your password.</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name='login'>Reset Password</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="../login.php">login</a></p>
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