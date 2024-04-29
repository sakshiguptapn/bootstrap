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
      <h1>Category Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Category Management</li>
          <li class="breadcrumb-item active">All Category</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section overflow-x-scroll">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Category</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="border border-primary text-primary text-center">Category Name</th>
                    <th class="border border-primary text-primary text-center">Total Enroll Course</th>
                    <th class="border border-primary text-primary text-center">Entery Date</th>
                    <th class="border border-primary text-primary text-center">Edit</th>
                    <th class="border border-primary text-primary text-center">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_fetch_all_category = "SELECT * FROM category WHERE active_record = 'Yes' ORDER BY category_id DESC";
                  $result_sql_fetch_all_category = mysqli_query($conn, $sql_fetch_all_category) or die("Query Failed!!");
                  if (mysqli_num_rows($result_sql_fetch_all_category) > 0) {
                    while ($row_sql_fetch_all_category = mysqli_fetch_assoc($result_sql_fetch_all_category)) {
                  ?>
                      <tr style="cursor: pointer;">
                        <td><?php echo $row_sql_fetch_all_category['category_name'] ?></td>
                        <td class='text-center'><?php echo $row_sql_fetch_all_category['num_of_record'] ?></td>
                        <td class='text-center'><?php echo $row_sql_fetch_all_category['category_entry_date'] ?></td>
                        <td class='text-center'><a href="category_management_edit.php?id=<?php echo ($row_sql_fetch_all_category["category_id"]) ?>" class='btn btn-primary'><i class="bi bi-pencil-square"></i></a></td>
                        <td class='text-center'><a href="middleware_auth_category_management_delete.php?id=<?php echo ($row_sql_fetch_all_category["category_id"]) ?>" class="btn btn-outline-danger"><i class="bi bi-trash2-fill"></i></a></td>
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