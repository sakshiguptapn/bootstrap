<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php'); ?>

<body>
  <!-- Nav Bar -->
  <?php include("navbar.php") ?>
  <!-- Nav Bar -->
  <!-- ======= Sidebar ======= -->
  <?php include('sidebar.php') ?>
  <!-- ======= Sidebar ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Course Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Course Management</li>
          <li class="breadcrumb-item active">All Courses</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section overflow-x-scroll">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Courses</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="border border-primary text-primary">Icon</th>
                    <th class="border border-primary text-primary">Poster</th>
                    <th class="border border-primary text-primary">Title</th>
                    <th class="border border-primary text-primary">Sell Price</th>
                    <th class="border border-primary text-primary">Estimated Price</th>
                    <th class="border border-primary text-primary">Discount</th>
                    <th class="border border-primary text-primary">Category</th>
                    <th class="border border-primary text-primary">Course Level</th>
                    <th class="border border-primary text-primary">Chapters</th>
                    <th class="border border-primary text-primary">Edit</th>
                    <th class="border border-primary text-primary">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_fetch_all_courses = "SELECT * FROM course INNER JOIN category ON course.category=category.category_id WHERE course.active_record = 'Yes' ORDER BY cid DESC";
                  $result_sql_fetch_all_courses = mysqli_query($conn, $sql_fetch_all_courses) or die("Query Failed!!");
                  if (mysqli_num_rows($result_sql_fetch_all_courses) > 0) {
                    while ($row_sql_fetch_all_courses = mysqli_fetch_assoc($result_sql_fetch_all_courses)) {
                  ?>
                      <tr style="cursor: pointer;">
                        <td><img src="upload_media/courses_poster/<?php echo $row_sql_fetch_all_courses['icon'] ?>" alt="Icon" class="rounded-2 " style='width:50px; height;:50px'></td>
                        <td><img src="upload_media/courses_poster/<?php echo $row_sql_fetch_all_courses['poster'] ?>" alt="Profile" class="rounded-2 " style='width:95px; height;:95px'></td>
                        <td><?php echo $row_sql_fetch_all_courses['title'] ?></td>
                        <td class='text-center'>₹ <?php echo $row_sql_fetch_all_courses['sell_price'] ?></td>
                        <td class='text-center'>₹ <?php echo $row_sql_fetch_all_courses['main_price'] ?></td>
                        <td class='text-center'><?php echo $row_sql_fetch_all_courses['discount'] ?>%</td>
                        <td><?php echo $row_sql_fetch_all_courses['category_name'] ?></td>
                        <td><?php echo $row_sql_fetch_all_courses['level'] ?></td>
                        <td class='text-center'><a href="chapter_management_read.php?id=<?php echo ($row_sql_fetch_all_courses["cid"]) ?>" class='btn btn-success'><i class="bi bi-eye"> View</i></a></td>
                        <td><a href="course_management_edit.php?id=<?php echo ($row_sql_fetch_all_courses["cid"]) ?>" class='btn btn-primary'><i class="bi bi-pencil-square"></i></a></td>
                        <td><a href="middleware_auth_course_management_delete.php?id=<?php echo ($row_sql_fetch_all_courses["cid"]) ?>&cate_id=<?php echo $row_sql_fetch_all_courses['category']; ?>" class="btn btn-outline-danger"><i class="bi bi-trash2-fill"></i></a></td>
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