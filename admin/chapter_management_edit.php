<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
if (!isset($_GET['id'], $_GET['course_id'])) {
  echo "<script>window.location.href='$hostname/admin/course_management_read.php'</script>";
}
$id = $_GET['id'];
$course_id = $_GET['course_id']; ?>
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
      <h1>Chapter Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Course Management</li>
          <li class="breadcrumb-item">All Courses</li>
          <li class="breadcrumb-item">All Chapter</li>
          <li class="breadcrumb-item active">Modify Chapter</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Modify Chapter</h5>
              <!-- PHP Code for Update Chapter Record -->
              <?php
              if (isset($_POST['save'])) {
                $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $chapter_index = mysqli_real_escape_string($conn, $_POST['chapter_index']);
                echo $sql_update_chapter = "UPDATE chapter SET chapter_title = '{$course_name}', chapter_description = '{$description}', chapter_index = '{$chapter_index}' WHERE chapter_id = '{$id}' AND course_id = '{$course_id}'";
                if (mysqli_query($conn, $sql_update_chapter)) {
              ?>
                  <script>
                    alert('Chapter is Modify successfully !!')
                  </script>
                <?php
                  echo "<script>window.location.href='$hostname/admin/chapter_management_read.php?id=$course_id'</script>";
                } else {
                ?>
                  <script>
                    alert('Chapter is Not Modify !!')
                  </script>
              <?php
                }
              }
              ?>
              <!-- PHP Code for Update Chapter Record -->
              <!-- Fetch Data from Database -->
              <?php
              $sql_fetch_all_chapter = "SELECT * FROM chapter WHERE chapter_id = '{$id}' AND course_id = '{$course_id}'";
              $result_sql_fetch_all_chapter = mysqli_query($conn, $sql_fetch_all_chapter) or die("Query Failed!!");
              if (mysqli_num_rows($result_sql_fetch_all_chapter) > 0) {
                while ($row_sql_fetch_all_chapter = mysqli_fetch_assoc($result_sql_fetch_all_chapter)) {
              ?>
                  <!-- Floating Labels Form -->
                  <form class="row g-3" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="on">
                    <div class="col-md-8">
                      <div class="form-floating mt-3">
                        <input type="text" class="form-control" id="floatingName" placeholder="Course Name" name='course_name' value="<?php echo $row_sql_fetch_all_chapter['chapter_title'] ?>" required>
                        <label for="floatingName">Chapter Name</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="input-group mt-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text py-3">Index</span>
                        </div>
                        <input type="number" class="form-control py-3" placeholder="Chapter Index" name='chapter_index' value="<?php echo $row_sql_fetch_all_chapter['chapter_index'] ?>" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-floating">
                        <!-- CKEditor -->
                        <textarea name="description" id="editor" class="form-control"><?php echo $row_sql_fetch_all_chapter['chapter_description'] ?></textarea>
                        <!-- CKEditor -->
                      </div>
                    </div>
                    <div class="text-center">
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