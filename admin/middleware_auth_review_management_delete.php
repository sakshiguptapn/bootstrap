<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php')
?>
<!-- Login Back-End Code -->
<!-- Form Start -->
<?php
session_start();
if (!isset($_GET['id'])) {
  echo "<script>window.location.href='$hostname/admin/review_management_read.php'</script>";
}
$id = $_GET['id'];
if (isset($_POST['login'])) {
  $email = $_SESSION['email'];
  $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
  $sql_user_pass_cheack = "SELECT * FROM user_data WHERE email = '{$email}' AND password = '{$pass}'" or die("Query Failed!! --> sql_user_pass_cheack");
  $result_sql_user_pass_cheack = mysqli_query($conn, $sql_user_pass_cheack);
  if (mysqli_num_rows($result_sql_user_pass_cheack) > 0) {

    // After Have a access Block
    $sql_user_course_record = "UPDATE review SET active_record ='No' WHERE review_id = '{$id}'";
    if (mysqli_query($conn, $sql_user_course_record)) {
?>
      <script>
        alert('Record is Delete successfully !!')
      </script>
<?php
      echo "<script>window.location.href='$hostname/admin/review_management_read.php'</script>";
    } else {
      echo ("<div class='d-flex justify-content-center' style='margin-bottom:-120px; padding-top:60px;'><p class='btn btn-danger'>Invalid Password.</p></div>");
    }
  } else {
    echo ("<div class='d-flex justify-content-center' style='margin-bottom:-120px; padding-top:60px;'><p class='btn btn-danger'>Invalid Password.</p></div>");
  }
}
?>
<!-- Login Back-End Code -->
<?php ?>

<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
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
                    <h5 class="card-title text-center pb-0 fs-4">Confirm access</h5>
                    <p class="text-center small">Enter your password to perform action</p>
                  </div>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="row g-3 needs-validation" novalidate autocomplete="off">
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope-at-fill"></i></span>
                        <input type="email" name="email" class="form-control" id="email" value="<?php echo $_SESSION['email'] ?>" required disabled>
                        <div class="invalid-feedback">Please enter your Email.</div>
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
                      <button class="btn btn-primary w-100" type="submit" name='login'>Confirm Access</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Forgot Password? <a href="forgot_password.php">Reset Password</a></p>
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