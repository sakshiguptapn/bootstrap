<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
if (!isset($_GET['id'])) {
  echo "<script>window.location.href='$hostname/admin/course_management_read.php'</script>";
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
      <h1>Chapter Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Course Management</li>
          <li class="breadcrumb-item">All Courses</li>
          <li class="breadcrumb-item">All Chapter</li>
          <li class="breadcrumb-item active">Create A New Chapter</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create A New Chapter</h5>
              <!-- PHP Code for Insert Course Record -->
              <?php
              if (isset($_POST['save'])) {

                $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $chapter_index = mysqli_real_escape_string($conn, $_POST['chapter_index']);
                $user_id = $_SESSION['user_id'];
                $email = $_SESSION['email'];
                $date = Date('d-m-Y');

                $sql_insert_chapter = "INSERT INTO chapter (chapter_title, chapter_description, chapter_index, course_id, chapter_entry_date, user_id, user_email) VALUES ('{$course_name}', '{$description}','{$chapter_index}', '{$id}', '{$date}', '{$user_id}','{$email}')";
                if (mysqli_query($conn, $sql_insert_chapter)) {
              ?>
                  <script>
                    alert('Chapter is Inserted successfully !!')
                  </script>
                <?php
                  echo "<script>window.location.href='$hostname/admin/chapter_management_read.php?id=$id'</script>";
                } else {
                ?>
                  <script>
                    alert('Chapter is not Insert !!')
                  </script>
              <?php
                }
              }

              ?>
              <!-- PHP Code for Insert Course Record -->
              <!-- Floating Labels Form -->
              <form class="row g-3" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="on">


                <div class="col-md-8">
                  <div class="form-floating mt-3">
                    <input type="text" class="form-control" id="floatingName" placeholder="Course Name" name='course_name' required>
                    <label for="floatingName">Chapter Name</label>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="input-group mt-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text py-3">Index</span>
                    </div>
                    <input type="number" class="form-control py-3" placeholder="Chapter Index" name='chapter_index' required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <!-- CKEditor -->
                    <textarea name="description" id="editor" class="form-control">Chapter Description</textarea>
                    <!-- CKEditor -->
                  </div>
                </div>
                <div class="text-center">
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