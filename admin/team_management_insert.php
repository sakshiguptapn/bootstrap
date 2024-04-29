<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
?>

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
          <li class="breadcrumb-item active">Create A New Team</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create A New Team</h5>
              <!-- PHP Code for Insert Course Record -->
              <?php
              if (isset($_POST['save'])) {
                try {
                  $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
                  $user_id = $_SESSION['user_id'];
                  $email = $_SESSION['email'];
                  $date = Date('d-m-Y');
                  $sql_insert_category = "INSERT INTO team (team_name, team_entry_date, user_id, user_email) VALUES ('{$category_name}','{$date}', '{$user_id}','{$email}')";
                  if (mysqli_query($conn, $sql_insert_category)) {
              ?>
                    <script>
                      alert('Team is Inserted successfully !!')
                    </script>
                  <?php
                    echo "<script>window.location.href='$hostname/admin/team_management_read.php'</script>";
                  } else {
                  ?>
                    <script>
                      alert('Team is not Insert !!')
                    </script>
              <?php
                    throw new Exception("Team is not Insert.");
                  }
                } catch (\Throwable $th) {
                  echo ("<div class='d-flex justify-content-center position-fixed' style='top:150px; right:35px;'><p class='btn btn-danger'>Error: " . $th->getMessage() . "</p></div>");
                }
              }
              ?>
              <!-- PHP Code for Insert Course Record -->
              <!-- Floating Labels Form -->
              <form class="row g-3" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="col-md-12">
                  <div class="form-floating mt-3">
                    <input type="text" class="form-control" id="Category" placeholder="Team Name" name='category_name'>
                    <label for="Category">Team Name</label>
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