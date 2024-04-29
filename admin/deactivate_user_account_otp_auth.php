<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
$notification_box = 'block';
?>
<!-- Login Back-End Code -->
<!-- Form Start -->
<?php
if (isset($_POST['verify'])) {
  session_start();
  $username = $_SESSION['otp_username'];
  $email = $_SESSION['otp_email'];
  $otp = mysqli_real_escape_string($conn, $_POST['otp']);
  $_SESSION['otp_auth'] = $otp;
  $otp_check = "SELECT * FROM user_data WHERE forgot_pwd_otp = '{$otp}' AND username = '{$username}' AND email = '{$email}'" or die("Query Failed!! --> otp_check");
  $otp_query_response = mysqli_query($conn, $otp_check);
  if (mysqli_num_rows($otp_query_response) > 0) {
    // Email Update For Deactivate User Account
    $deactivate_email = $email . " - deactivated";
    $sql_otp_create = "UPDATE user_data SET email = '{$deactivate_email}' WHERE username = '{$username}' AND email = '{$email}'";
    if (mysqli_query($conn, $sql_otp_create)) {
?>
      <script>
        alert('Your account is deactivated successfully.')
      </script>
<?php
      echo "<script>
      window.location.href = '$hostname'
    </script>";
    } else {
      echo ("<div class='d-flex justify-content-center' style='margin-bottom:-120px; padding-top:60px;'>
      <p class='btn btn-danger'>Invalid OTP.</p>
    </div>");
    }
    echo "<script>window.location.href='$hostname'</script>";
  } else {
    $notification_box = 'none !important';
    echo ("<div class='d-flex justify-content-center' style='padding-top:60px;'><p class='btn btn-danger'>Invalid OTP.</p></div>");
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
          <!-- top send message -->
          <div class='d-flex justify-content-center align-items-center w-full' style='padding-top:60px; display: <?php echo $notification_box ?>'>
            <p class='btn btn-success'>Email was send successfull to your registered email.</p>
          </div>
          <!-- top send message -->
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
                    <h5 class="card-title text-center pb-0 fs-4">Deactivate Account</h5>
                    <p class="text-center small">Enter OTP</p>
                  </div>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="row g-3 needs-validation" novalidate autocomplete="off">
                    <div class="col-12">
                      <label for="otp" class="form-label">OTP</label>
                      <input type="text" name="otp" class="form-control" id="otp" maxlength="6">
                      <div class="invalid-feedback">Please enter your OTP.</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-danger w-100" type="submit" name='verify'>Verify OTP</button>
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