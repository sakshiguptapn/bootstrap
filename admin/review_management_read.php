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
      <h1>Review Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Review Management</li>
          <li class="breadcrumb-item active">All Reviews</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section overflow-x-scroll">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Reviews</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="border border-primary text-primary">Review</th>
                    <th class="border border-primary text-primary">Reply</th>
                    <th class="border border-primary text-primary">Course</th>
                    <th class="border border-primary text-primary">User Name</th>
                    <th class="border border-primary text-primary">User Email</th>
                    <th class="border border-primary text-primary">Date</th>
                    <th class="border border-primary text-primary">Edit</th>
                    <th class="border border-primary text-primary">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_fetch_all_review = "SELECT review.review_id, review.review_title, review.review_reply, review.review_date, review.active_record, course.title, user_data.username, user_data.email
                  FROM review
                  INNER JOIN user_data ON review.user_id = user_data.user_id
                  INNER JOIN course ON review.review_course_id = course.cid                  
                  WHERE review.active_record = 'Yes' ORDER BY review.review_id DESC";
                  $result_sql_fetch_all_review = mysqli_query($conn, $sql_fetch_all_review) or die("Query Failed!!");
                  if (mysqli_num_rows($result_sql_fetch_all_review) > 0) {
                    while ($row_sql_fetch_all_review = mysqli_fetch_assoc($result_sql_fetch_all_review)) {
                  ?>
                      <tr style="cursor: pointer;">
                        <td><?php echo $row_sql_fetch_all_review['review_title'] ?></td>
                        <td><?php echo $row_sql_fetch_all_review['review_reply'] ?></td>
                        <td><?php echo $row_sql_fetch_all_review['title'] ?></td>
                        <td><?php echo $row_sql_fetch_all_review['username'] ?></td>
                        <td><?php echo $row_sql_fetch_all_review['email'] ?></td>
                        <td><?php echo $row_sql_fetch_all_review['review_date'] ?></td>
                        <td><a href="review_management_edit.php?id=<?php echo ($row_sql_fetch_all_review["review_id"]) ?>" class='btn btn-primary'><i class="bi bi-pencil-square"></i></a></td>
                        <td><a href="middleware_auth_review_management_delete.php?id=<?php echo ($row_sql_fetch_all_review["review_id"]) ?>" class="btn btn-outline-danger"><i class="bi bi-trash2-fill"></i></a></td>
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