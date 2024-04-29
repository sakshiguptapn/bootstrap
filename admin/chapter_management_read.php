<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
if (!isset($_GET['id'])) {
  echo "<script>window.location.href='$hostname/admin/course_management_read.php'</script>";
}
$id = $_GET['id']; ?>

<body>
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
          <li class="breadcrumb-item active">All Chapter</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section overflow-x-scroll">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Chapter</h5>
              <div class="col-md-4">
                <a href="chapter_management_insert.php?id=<?php echo $id; ?>" class="btn btn-primary w-100 mb-5">Create a new chapter</a>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="border border-primary text-primary text-center">Index</th>
                    <th class="border border-primary text-primary text-center">Chapter Title</th>
                    <th class="border border-primary text-primary text-center">Enroll Course</th>
                    <th class="border border-primary text-primary text-center">Date</th>
                    <th class="border border-primary text-primary text-center">Edit</th>
                    <th class="border border-primary text-primary text-center">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Fetch Data from Database -->
                  <?php
                  $sql_fetch_all_chapter = "SELECT * FROM chapter INNER JOIN course ON chapter.course_id = course.cid WHERE chapter.active_record = 'Yes' AND chapter.course_id = '{$id}' ORDER BY chapter_index";
                  $result_sql_fetch_all_chapter = mysqli_query($conn, $sql_fetch_all_chapter) or die("Query Failed!!");
                  if (mysqli_num_rows($result_sql_fetch_all_chapter) > 0) {
                    while ($row_sql_fetch_all_chapter = mysqli_fetch_assoc($result_sql_fetch_all_chapter)) {
                  ?>
                      <tr style="cursor: pointer;">
                        <td class='text-center'><?php echo $row_sql_fetch_all_chapter['chapter_index'] ?></td>
                        <td><?php echo $row_sql_fetch_all_chapter['chapter_title'] ?></td>
                        <td class='text-center'><?php echo $row_sql_fetch_all_chapter['title'] ?></td>
                        <td class='text-center'><?php echo $row_sql_fetch_all_chapter['chapter_entry_date'] ?></td>

                        <td><a href="chapter_management_edit.php?id=<?php echo ($row_sql_fetch_all_chapter["chapter_id"]) ?>&course_id=<?php echo ($id) ?>" class='btn btn-primary'><i class="bi bi-pencil-square"></i></a></td>
                        <td><a href="middleware_auth_chapter_management_delete.php?id=<?php echo ($row_sql_fetch_all_chapter["chapter_id"]) ?>&course_id=<?php echo ($id) ?>" class="btn btn-outline-danger"><i class="bi bi-trash2-fill"></i></a></td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>