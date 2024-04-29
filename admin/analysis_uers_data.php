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
          <li class="breadcrumb-item active">Users Management Analysis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row pt-4">
        <!-- Polar Area Chart -->
        <div class="col-lg-6">
          <!-- PHP Code for data fetch from database -->
          <?php
          $sql_fetch_user_status = "SELECT * FROM user_data";
          $result_sql_fetch_user_status = mysqli_query($conn, $sql_fetch_user_status) or die("Query Failed!!");
          if (mysqli_num_rows($result_sql_fetch_user_status) > 0) {
            $userFetchDataRes = array();
            while ($row_sql_fetch_user_status = mysqli_fetch_assoc($result_sql_fetch_user_status)) {
              $userFetchDataRes[] = $row_sql_fetch_user_status['active_record'];
            }
            $total_count_of_users = mysqli_num_rows($result_sql_fetch_user_status);
            $active_user_count = count(array_filter($userFetchDataRes, function ($var) {
              return ($var == 'No');
            }));
            $deactive_user_count = count(array_filter($userFetchDataRes, function ($var) {
              return ($var == 'Yes');
            }));            
          } ?>
          <!-- PHP Code for data fetch from database -->
          <div class="card" style="cursor: pointer;">
            <div class="card-body">
              <h5 class="card-title">Active / Deactive Users Account</h5>
              <p>Total Users : <?php echo $total_count_of_users ?></p>
              <!-- Polar Area Chart -->
              <canvas id="polarAreaChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#polarAreaChart'), {
                    type: 'polarArea',
                    data: {
                      labels: [
                        'Active Users',
                        'Deactive Users',
                      ],
                      datasets: [{
                        label: 'Users Count',
                        data: [<?php echo $active_user_count ?>, <?php echo $deactive_user_count ?>],
                        backgroundColor: [
                          'rgb(75, 192, 192)',
                          'rgb(255, 99, 132)',
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
        <!-- Column Chart -->
        <div class="col-lg-6">
          <!-- PHP Code for data fetch from database -->
          <?php
          $sql_fetch_user_social_links = "SELECT * FROM user_data";
          $result_sql_fetch_user_social_links = mysqli_query($conn, $sql_fetch_user_social_links) or die("Query Failed!!");
          if (mysqli_num_rows($result_sql_fetch_user_social_links) > 0) {
            $userFacebookFetchRes = array();
            $userTwitterFetchRes = array();
            $userLinkedinFetchRes = array();
            $userInstagramFetchRes = array();
            $userYoutubeFetchRes = array();
            $userGithubFetchRes = array();
            while ($row_sql_fetch_user_social_links = mysqli_fetch_assoc($result_sql_fetch_user_social_links)) {
              $userFacebookFetchRes[] = $row_sql_fetch_user_social_links['fb'];
              $userTwitterFetchRes[] = $row_sql_fetch_user_social_links['twitter'];
              $userLinkedinFetchRes[] = $row_sql_fetch_user_social_links['linkedin'];
              $userInstagramFetchRes[] = $row_sql_fetch_user_social_links['insta'];
              $userYoutubeFetchRes[] = $row_sql_fetch_user_social_links['youtube'];
              $userGithubFetchRes[] = $row_sql_fetch_user_social_links['github'];
            }
            $total_count_of_users_social = mysqli_num_rows($result_sql_fetch_user_social_links);
            //Count Data from fetch array
            $active_fb_count = count(array_filter($userFacebookFetchRes, function ($var) {
              return ($var != '');
            }));
            $active_twitter_count = count(array_filter($userTwitterFetchRes, function ($var) {
              return ($var != '');
            }));
            $active_linkedin_count = count(array_filter($userLinkedinFetchRes, function ($var) {
              return ($var != '');
            }));
            $active_insta_count = count(array_filter($userInstagramFetchRes, function ($var) {
              return ($var != '');
            }));
            $active_youtube_count = count(array_filter($userYoutubeFetchRes, function ($var) {
              return ($var != '');
            }));
            $active_github_count = count(array_filter($userGithubFetchRes, function ($var) {
              return ($var != '');
            }));
          } ?>
          <!-- PHP Code for data fetch from database -->
          <div class="card" style="cursor: pointer;">
            <div class="card-body">
              <h5 class="card-title">Users Social Handles</h5>
              <p>Total Users Social Handles : <?php echo $total_count_of_users_social ?></p>
              <div id="columnChart"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#columnChart"), {
                    series: [{
                      name: 'Total Users Count',
                      data: [<?php echo $total_count_of_users_social ?>, <?php echo $total_count_of_users_social ?>, <?php echo $total_count_of_users_social ?>, <?php echo $total_count_of_users_social ?>, <?php echo $total_count_of_users_social ?>, <?php echo $total_count_of_users_social ?>]
                    }, {
                      name: 'Total Users Social Count',
                      data: [<?php echo $active_linkedin_count ?>, <?php echo $active_github_count ?>, <?php echo $active_fb_count ?>, <?php echo $active_twitter_count ?>, <?php echo $active_insta_count ?>, <?php echo $active_youtube_count ?>]
                    }],
                    chart: {
                      type: 'bar',
                      height: 385
                    },
                    plotOptions: {
                      bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                      },
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      show: true,
                      width: 2,
                      colors: ['transparent']
                    },
                    xaxis: {
                      categories: ['Linkedin', 'Github', 'Facebook', 'Twitter', 'Instagram', 'Youtube'],
                    },
                    yaxis: {
                      title: {
                        text: 'Users Social Handles Data'
                      }
                    },
                    fill: {
                      opacity: 1
                    },
                    tooltip: {
                      y: {
                        formatter: function(val) {
                          return "Filled Social Filed : " + val
                        }
                      }
                    }
                  }).render();
                });
              </script>
              <!-- End Column Chart -->
            </div>
          </div>
        </div>
        <!-- Column Chart -->
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>