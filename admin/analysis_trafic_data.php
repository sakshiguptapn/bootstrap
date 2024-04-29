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
          <li class="breadcrumb-item active">Application Trafic Analysis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row pt-4">
        <!-- Application Trafic Browswer Wise Chart -->
        <div class="col-lg-6">
          <div class="card" style="cursor: pointer;">
            <!-- PHP Code for data fetch from database -->
            <?php
            $sql_fetch_app_trafic = "SELECT COUNT(trafic_browser) AS browser_trafic_count, trafic_browser FROM `trafic` GROUP BY trafic_browser";
            $result_sql_fetch_app_trafic = mysqli_query($conn, $sql_fetch_app_trafic) or die("Query Failed!!");
            if (mysqli_num_rows($result_sql_fetch_app_trafic) > 0) {
              $brower_name = array();
              $browser_trafic_count = array();
              while ($row_sql_fetch_app_trafic = mysqli_fetch_assoc($result_sql_fetch_app_trafic)) {
                $brower_name[] = $row_sql_fetch_app_trafic['trafic_browser'];
                $browser_trafic_count[] = $row_sql_fetch_app_trafic['browser_trafic_count'];
              }
              $total_trafic = array_sum($browser_trafic_count);
              $Chrome = round((($browser_trafic_count[0] / $total_trafic) * 100));
              $Edge = round((($browser_trafic_count[1] / $total_trafic) * 100));
              $Firefox = round((($browser_trafic_count[2] / $total_trafic) * 100));
              $Other = round((($browser_trafic_count[3] / $total_trafic) * 100));
              $Safari = round((($browser_trafic_count[4] / $total_trafic) * 100));
            } ?>
            <!-- PHP Code for data fetch from database -->
            <div class="card-body">
              <h5 class="card-title">Application Trafic (Browser Wise)</h5>
              <p>Total Trafic Browser Wise : <?php echo $total_trafic ?></p>
              <!-- Radial Bar Chart -->
              <div id="radialBarChart"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#radialBarChart"), {
                    series: [<?php echo $Chrome; ?>, <?php echo $Edge; ?>, <?php echo $Firefox; ?>, <?php echo $Other; ?>, <?php echo $Safari; ?>, ],
                    chart: {
                      height: 400,
                      type: 'radialBar',
                      toolbar: {
                        show: true
                      }
                    },
                    plotOptions: {
                      radialBar: {
                        dataLabels: {
                          name: {
                            fontSize: '22px',
                          },
                          value: {
                            fontSize: '16px',
                          },
                          total: {
                            show: true,
                            label: 'Total',
                            formatter: function(w) {
                              // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                              return <?php echo $total_trafic; ?>
                            }
                          }
                        }
                      }
                    },
                    labels: <?php echo json_encode($brower_name); ?>,
                  }).render();
                });
              </script>
              <!-- End Radial Bar Chart -->
            </div>
          </div>
        </div>
        <!-- Application Trafic Browswer Wise Chart -->
        <!-- Application Trafic Device Wise Chart -->
        <div class="col-lg-6">
          <!-- PHP Code for data fetch from database -->
          <?php
          $sql_fetch_app_trafic_device = "SELECT COUNT(trafic_device) AS device_trafic_count, trafic_device FROM `trafic` GROUP BY trafic_device";
          $result_sql_fetch_app_trafic_device = mysqli_query($conn, $sql_fetch_app_trafic_device) or die("Query Failed!!");
          if (mysqli_num_rows($result_sql_fetch_app_trafic_device) > 0) {
            $device_name = array();
            $device_trafic_count = array();
            while ($row_sql_fetch_app_trafic_device = mysqli_fetch_assoc($result_sql_fetch_app_trafic_device)) {
              $device_name[] = $row_sql_fetch_app_trafic_device['trafic_device'];
              $device_trafic_count[] = $row_sql_fetch_app_trafic_device['device_trafic_count'];
            }
            $total_device_trafic = array_sum($device_trafic_count);
          } ?>
          <!-- PHP Code for data fetch from database -->
          <div class="card" style="cursor: pointer;">
            <div class="card-body">
              <h5 class="card-title">Application Trafic (Device Wise)</h5>
              <p>Total Trafic Device Wise : <?php echo $total_device_trafic ?></p>
              <!-- Polar Area Chart -->
              <canvas id="polarAreaChart" style="max-height: 380px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#polarAreaChart'), {
                    type: 'polarArea',
                    data: {
                      labels: <?php echo json_encode($device_name) ?>,
                      datasets: [{
                        label: 'Total Trafic Device Wise Count',
                        data: <?php echo json_encode($device_trafic_count) ?>,
                        backgroundColor: [
                          'rgba(255, 205, 86, 0.8)',
                          'rgba(54, 162, 235, 0.8)',
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
        <!-- Application Trafic Device Wise Chart -->
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>