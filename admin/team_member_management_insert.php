<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
if (!isset($_GET['id'])) {
  echo "<script>window.location.href='$hostname/admin/team_management_read.php'</script>";
}
$id = $_GET['id']; ?>

<body>
  <!-- ======= Header ======= -->
  <!-- Nav Bar -->
  <?php include("navbar.php") ?>
  <!-- Nav Bar -->
  <!-- ======= Sidebar ======= -->
  <?php include('sidebar.php') ?>
  <!-- ======= Sidebar ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Team Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Team Management</li>
          <li class="breadcrumb-item active">Create A New Team Member</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create A New Team Member</h5>
              <!-- PHP Code for Insert Course Record -->
              <?php
              if (isset($_POST['save'])) {
                try {
                  $tm_user_id = mysqli_real_escape_string($conn, $_POST['tm_user_id']);
                  $user_id = $_SESSION['user_id'];
                  $email = $_SESSION['email'];
                  $date = Date('d-m-Y');
                  $sql_insert_category = "INSERT INTO team_member (enroll_team_id, tm_user_id, team_member_date, user_id, user_email)
                                          VALUES ('{$id}','{$tm_user_id}','{$date}', '{$user_id}','{$email}')";
                  if (mysqli_query($conn, $sql_insert_category)) {
              ?>
                    <script>
                      alert('Team Member is Inserted successfully !!')
                    </script>
                  <?php
                    echo "<script>window.location.href='$hostname/admin/team_member_management_read.php?id=$id'</script>";
                  } else {
                  ?>
                    <script>
                      alert('Team Member is not Insert !!')
                    </script>
              <?php
                    throw new Exception("Team Member is not Insert.");
                  }
                } catch (\Throwable $th) {
                  echo ("<div class='d-flex justify-content-center position-fixed' style='top:150px; right:35px;'><p class='btn btn-danger'>Error: " . $th->getMessage() . "</p></div>");
                }
              }
              ?>
              <!-- PHP Code for Insert Course Record -->
              <!-- Floating Labels Form -->
              <form class="row g-3" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">


                <div class="row mb-3">
                  <label for="role" class="col-md-4 col-lg-3 col-form-label">Choose Member For A Team</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-select" name='tm_user_id' required>
                      <option value="">Choose a Authorization Level</option>
                      <!-- sql_fetch_all_user Query -->
                      <?php
                      $sql_fetch_all_user = "SELECT user_id, username, email FROM user_data WHERE active_record = 'Yes' AND role = '0' OR role = '1' ORDER BY email";
                      $result_sql_fetch_all_user = mysqli_query($conn, $sql_fetch_all_user) or die("Query Failed!!");
                      if (mysqli_num_rows($result_sql_fetch_all_user) > 0) {
                        while ($row_sql_fetch_all_user = mysqli_fetch_assoc($result_sql_fetch_all_user)) {
                      ?>
                          <option value="<?php echo $row_sql_fetch_all_user['user_id']; ?>"><?php echo $row_sql_fetch_all_user['email'] ?></option>
                      <?php }
                      } ?>
                      <!-- sql_fetch_all_user Query -->
                    </select>
                  </div>
                </div>


                <div class="text-center my-3 mt-5">
                  <button type="submit" class="btn btn-primary" name="save" required>Create Now</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>