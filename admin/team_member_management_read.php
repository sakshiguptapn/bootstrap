<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
if (!isset($_GET['id'])) {
  echo "<script>window.location.href='$hostname/admin/team_management_read.php'</script>";
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
      <h1>Team Member</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Team Management</li>
          <li class="breadcrumb-item active">Team Member</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section overflow-x-scroll">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Team Member</h5>
              <div class="col-md-5">
                <a href="team_member_management_insert.php?id=<?php echo $id ?>" class="btn btn-primary w-100 mb-5">Create A New Team Member</a>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="border border-primary text-primary text-center">Profile</th>
                    <th class="border border-primary text-primary text-center">Team Member</th>
                    <th class="border border-primary text-primary text-center">Enroll Team Name</th>
                    <th class="border border-primary text-primary text-center">Entery Date</th>
                    <th class="border border-primary text-primary text-center">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_fetch_all_team = "SELECT user_data.username, user_data.profile_picture, team_member.tm_id, team.team_name, team.team_id, team_member.tm_user_id, team_member.enroll_team_id, team_member.team_member_date
                  FROM team_member
                  INNER JOIN team ON team.team_id = team_member.enroll_team_id
                  INNER JOIN user_data ON team_member.tm_user_id = user_data.user_id WHERE team_member.enroll_team_id = '{$id}' AND team_member.active_record = 'Yes' ORDER BY team_member.tm_id DESC";

                  $result_sql_fetch_all_team = mysqli_query($conn, $sql_fetch_all_team) or die("Query Failed!!");
                  if (mysqli_num_rows($result_sql_fetch_all_team) > 0) {
                    while ($row_sql_fetch_all_team = mysqli_fetch_assoc($result_sql_fetch_all_team)) {
                  ?>
                      <tr style="cursor: pointer;">
                        <td class='text-center'><img src="upload_media/users_profiles_picture/<?php echo $row_sql_fetch_all_team['profile_picture'] ?>" alt="Profile" class="rounded-circle" style='width:50px; height;:50px'></td>
                        <td><?php echo $row_sql_fetch_all_team['username'] ?></td>
                        <td><?php echo $row_sql_fetch_all_team['team_name'] ?></td>
                        <td class='text-center'><?php echo $row_sql_fetch_all_team['team_member_date'] ?></td>
                        <td class='text-center'><a href="middleware_auth_team_member_management_delete.php?id=<?php echo ($row_sql_fetch_all_team["tm_id"]) ?>&team_id=<?php echo ($id) ?>" class="btn btn-outline-danger"><i class="bi bi-trash2-fill"></i></a></td>
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