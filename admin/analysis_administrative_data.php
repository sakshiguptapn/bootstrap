<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php'); ?>

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
      <h1>Analysis Center</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Analysis Center</li>
          <li class="breadcrumb-item active">Administrative Data Analysis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row pt-4">
        <!-- Bar Chart -->
        <div class="col-lg-6" style='cursor: pointer;'>
          <!-- PHP Code for data fetch from database -->
          <?php
          $sql_fetch_teams = "SELECT team.team_id, team.team_name, team_member.enroll_team_id, COUNT(team_member.enroll_team_id) AS num_of_member FROM team
        INNER JOIN team_member ON team.team_id = team_member.enroll_team_id
        WHERE team.active_record = 'Yes' AND team_member.active_record = 'Yes'
        GROUP BY team_member.enroll_team_id";
          $result_sql_fetch_teams = mysqli_query($conn, $sql_fetch_teams) or die("Query Failed!!");
          if (mysqli_num_rows($result_sql_fetch_teams) > 0) {
            $teamFetchResTeamsName = array();
            $teamFetchResTeamsMemberCount = array();
            while ($row_sql_fetch_teams = mysqli_fetch_assoc($result_sql_fetch_teams)) {
              $teamFetchResTeamsName[] = $row_sql_fetch_teams['team_name'];
              $teamFetchResTeamsMemberCount[] = $row_sql_fetch_teams['num_of_member'];
            }
          } ?>
          <!-- PHP Code for data fetch from database -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Teams Data</h5>
              <p>Total Teams: <?php echo mysqli_num_rows($result_sql_fetch_teams) ?></p>
              <div id="barChart"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#barChart"), {
                    series: [{
                      data: <?php echo print_r(json_encode($teamFetchResTeamsMemberCount), true) ?>
                    }],
                    chart: {
                      type: 'bar',
                      height: 385
                    },
                    plotOptions: {
                      bar: {
                        borderRadius: 4,
                        horizontal: true,
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    xaxis: {
                      categories: <?php echo print_r(json_encode($teamFetchResTeamsName), true) ?>,
                    }
                  }).render();
                });
              </script>
            </div>
          </div>
        </div>
        <!-- End Bar Chart -->
        <!-- Polar Area Chart -->
        <div class="col-lg-6">
          <!-- PHP Code for data fetch from database -->
          <?php
          $sql_fetch_user_status = "SELECT * FROM user_data WHERE active_record = 'Yes'";
          $result_sql_fetch_user_status = mysqli_query($conn, $sql_fetch_user_status) or die("Query Failed!!");
          if (mysqli_num_rows($result_sql_fetch_user_status) > 0) {
            $userFetchDataRes = array();
            while ($row_sql_fetch_user_status = mysqli_fetch_assoc($result_sql_fetch_user_status)) {
              $userFetchDataRes[] = $row_sql_fetch_user_status['role'];
            }
            $total_count_of_users = mysqli_num_rows($result_sql_fetch_user_status);
            $administrative_user_count = count(array_filter($userFetchDataRes, function ($var) {
              return ($var == 0);
            }));
            $middle_management_user_count = count(array_filter($userFetchDataRes, function ($var) {
              return ($var == 1);
            }));
            $end_user_count = count(array_filter($userFetchDataRes, function ($var) {
              return ($var == 9);
            }));
          } ?>
          <!-- PHP Code for data fetch from database -->
          <div class="card" style="cursor: pointer;">
            <div class="card-body">
              <h5 class="card-title">Users Accounts</h5>
              <p>Total Users : <?php echo $total_count_of_users ?></p>
              <!-- Polar Area Chart -->
              <canvas id="polarAreaChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#polarAreaChart'), {
                    type: 'polarArea',
                    data: {
                      labels: [
                        'Administrative Users',
                        'Middle Managment Users',
                        'End Users',
                      ],
                      datasets: [{
                        label: 'Users Count',
                        data: [<?php echo $administrative_user_count ?>, <?php echo $middle_management_user_count ?>, <?php echo $end_user_count ?>],
                        backgroundColor: [
                          'rgb(75, 192, 192)',
                          'rgb(255, 99, 132)',
                          'rgb(255, 205, 86)',
                        ]
                      }]
                    }
                  });
                });
              </script>
              <!-- End Polar Area Chart -->
            </div>
          </div>
        </div>
        <!-- Polar Area Chart -->
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>