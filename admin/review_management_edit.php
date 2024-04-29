<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
if (!isset($_GET['id'])) {
  echo "<script>window.location.href='$hostname/admin/review_management_read.php'</script>";
}
$id = $_GET['id'];
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
      <h1>Review Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Review Management</li>
          <li class="breadcrumb-item active">Review Management</li>
          <li class="breadcrumb-item">Modify Review Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Modify Review Details</h5>
              <!-- PHP Code for Insert Course Record -->
              <?php
              if (isset($_POST['save'])) {
                try {
                  $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
                  $sql_update_category = "UPDATE review SET review_title = '{$category_name}' WHERE review_id = '{$id}'";
                  if (mysqli_query($conn, $sql_update_category)) {
              ?>
                    <script>
                      alert('Review is Updated successfully !!')
                    </script>
                  <?php
                    echo "<script>window.location.href='$hostname/admin/review_management_read.php'</script>";
                  } else {
                  ?>
                    <script>
                      alert('Review is not Update !!')
                    </script>
              <?php
                    throw new Exception("Review is not Update.");
                  }
                } catch (\Throwable $th) {
                  echo ("<div class='d-flex justify-content-center position-fixed' style='top:150px; right:35px;'><p class='btn btn-danger'>Error: " . $th->getMessage() . "</p></div>");
                }
              }
              ?>
              <!-- PHP Code for Insert Course Record -->
              <!-- Floating Labels Form -->
              <!-- PHP Code for Fetch Course Data -->
              <?php
              $sql_fetch_all_reviews = "SELECT review_title FROM review WHERE review_id = '{$id}'";
              $result_sql_fetch_all_reviews = mysqli_query($conn, $sql_fetch_all_reviews) or die("Query Failed!!");
              if (mysqli_num_rows($result_sql_fetch_all_reviews) > 0) {
                while ($row_sql_fetch_all_reviews = mysqli_fetch_assoc($result_sql_fetch_all_reviews)) {
              ?>
                  <!-- PHP Code for Fetch Course Data -->
                  <form class="row g-3" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="col-md-12">
                      <div class="form-floating mt-3">
                        <input type="text" class="form-control" id="category_name" placeholder="Category Name" name='category_name' value="<?php echo $row_sql_fetch_all_reviews['review_title']; ?>">
                        <label for="category_name">Reply</label>
                      </div>
                    </div>
                    <div class="text-center my-3 mt-5">
                      <button type="submit" class="btn btn-primary" name="save" required>Save Changes</button>
                    </div>
                  </form><!-- End floating Labels Form -->
              <?php }
              } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>