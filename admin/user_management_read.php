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
      <h1>All Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">User Management</li>
          <li class="breadcrumb-item active">Administration Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section overflow-x-scroll">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Administration Users</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="border border-primary text-primary">Profile</th>
                    <th class="border border-primary text-primary">User Name</th>
                    <th class="border border-primary text-primary">Full Name</th>
                    <th class="border border-primary text-primary">Designation</th>
                    <th class="border border-primary text-primary">Role</th>
                    <th class="border border-primary text-primary">Phone</th>
                    <th class="border border-primary text-primary">email</th>
                    <th class="border border-primary text-primary">Entery Date</th>
                    <th class="border border-primary text-primary">Edit</th>
                    <th class="border border-primary text-primary">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_fetch_all_user = "SELECT * FROM user_data WHERE active_record = 'Yes' AND role = '0' ORDER BY user_id DESC";
                  $result_sql_fetch_all_user = mysqli_query($conn, $sql_fetch_all_user) or die("Query Failed!!");
                  if (mysqli_num_rows($result_sql_fetch_all_user) > 0) {
                    while ($row_sql_fetch_all_user = mysqli_fetch_assoc($result_sql_fetch_all_user)) {
                  ?>
                      <tr style="cursor: pointer;">
                        <td><img src="upload_media/users_profiles_picture/<?php echo $row_sql_fetch_all_user['profile_picture'] ?>" alt="Profile" class="rounded-circle" style='width:50px; height;:50px'></td>
                        <td><?php echo $row_sql_fetch_all_user['username'] ?></td>
                        <td><?php echo $row_sql_fetch_all_user['full_name'] ?></td>
                        <td><?php echo $row_sql_fetch_all_user['designation'] ?></td>
                        <!-- Role Permission Conditional Rending -->
                        <?php
                        $user_role_permission = '';
                        if ($row_sql_fetch_all_user['role'] == '0') {
                          $user_role_permission = 'Administration Level';
                        } else {
                          $user_role_permission = 'Null';
                        }
                        ?>
                        <td><?php echo $user_role_permission ?></td>
                        <td><?php echo $row_sql_fetch_all_user['phone'] ?></td>
                        <td><?php echo $row_sql_fetch_all_user['email'] ?></td>
                        <td><?php echo $row_sql_fetch_all_user['date'] ?></td>
                        <td><a href="user_management_edit.php?id=<?php echo ($row_sql_fetch_all_user["user_id"]) ?>" class='btn btn-primary'><i class="bi bi-pencil-square"></i></a></td>
                        <td><a href="middleware_auth_user_management_delete.php?id=<?php echo ($row_sql_fetch_all_user["user_id"]) ?>" class="btn btn-outline-danger"><i class="bi bi-trash2-fill"></i></a></td>
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