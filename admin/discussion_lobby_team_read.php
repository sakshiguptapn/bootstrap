<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
?>

<body>
  <!-- Nav Bar -->
  <?php include("navbar.php") ?>
  <!-- Nav Bar -->
  <!-- ======= Sidebar ======= -->
  <?php include('sidebar.php') ?>
  <!-- ======= Sidebar ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Discussion lobby</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Discussion Lobby</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
      <div class="row">
        <!-- sql_fetch_all_team List -->
        <div class="col-xl-4 overflow-y-auto" style='height:75vh;'>
          <?php
          $login_user_id = $_SESSION['user_id'];
          $sql_fetch_all_team = "SELECT * FROM `team`
          INNER JOIN team_member ON team.team_id = team_member.enroll_team_id
          WHERE team.active_record = 'Yes' AND team_member.active_record = 'Yes' AND team_member.tm_user_id = '{$login_user_id}' 
          GROUP BY team.team_name
          ORDER BY team.team_id DESC";
          $result_sql_fetch_all_team = mysqli_query($conn, $sql_fetch_all_team) or die("Query Failed!!");
          if (mysqli_num_rows($result_sql_fetch_all_team) > 0) {
            while ($row_sql_fetch_all_team = mysqli_fetch_assoc($result_sql_fetch_all_team)) {
          ?>
              <!-- Card Element -->
              <a href="discussion_lobby.php?team_id=<?php echo $row_sql_fetch_all_team['team_id']; ?>" class='text-dark'>
                <div class="card-body profile-card border pt-4 mb-2 d-flex align-items-center gap-3 rounded-2 bg-white shadow-sm" style='cursor: pointer;'>
                  <i class="bi bi-microsoft-teams rounded-circle btn btn-primary" style="font-size: 18px; padding: 14px 18px"></i>
                  <div class='d-flex justify-content-between align-items-center w-100'>
                    <h5 class='fw-semibold h6'><?php echo $row_sql_fetch_all_team['team_name']; ?></h5>
                  </div>
                </div>
              </a>
              <!-- Card Element -->
            <?php
            }
          } else {
            ?>
            <!-- Card Element -->
            <div class="card-body profile-card border pt-4 mb-2 d-flex align-items-center gap-3 rounded-2 bg-white shadow-sm" style='cursor: pointer;'>
              <i class="bi bi-trash2 h2"></i>
              <p class='pt-2'>Empty Discussion Group</p>
            </div>
            <!-- Card Element -->
          <?php
          }
          ?>
        </div>
        <!-- sql_fetch_all_team List -->
        <!-- Default Screen -->
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3 d-flex flex-column justify-content-center align-items-center" style='height:75vh; cursor:pointer;'>
              <i class="bi bi-chat-left-text display-1 "></i>
              <p class="h6 fw-semibold">Start a new team conversation</p>
            </div>
          </div>
        </div>
        <!-- Default Screen -->
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>