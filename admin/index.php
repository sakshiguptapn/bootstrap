<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php') ?>

<body>
  <!-- Nav Bar -->
  <?php include("navbar.php");
  if (!($_SESSION['user_role'] == 0 || $_SESSION['user_role'] == 1)) {
    echo "<script>window.location.href='$hostname/admin/users-profile-overview.php'</script>";
  } ?>
  <!-- Nav Bar -->
  <!-- ======= Sidebar ======= -->
  <?php include('sidebar.php') ?>
  <!-- ======= Sidebar ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <!-- Course Fetch data -->
                <div class="card-body">
                  <h5 class="card-title">Courses <span>| Count</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cast"></i>
                    </div>
                    <?php
                    $sql_fetch_course_data = "SELECT active_record FROM course WHERE active_record = 'Yes'";
                    $result_sql_fetch_course_data = mysqli_query($conn, $sql_fetch_course_data) or die("Query Failed!!");
                    if (mysqli_num_rows($result_sql_fetch_course_data) > 0) { ?>
                      <div class="ps-3">
                        <h6><?php echo mysqli_num_rows($result_sql_fetch_course_data) ?></h6>
                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Teams <span>| Count</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-microsoft-teams"></i>
                    </div>
                    <?php
                    $sql_fetch_team_data = "SELECT active_record FROM team WHERE active_record = 'Yes'";
                    $result_sql_fetch_team_data = mysqli_query($conn, $sql_fetch_team_data) or die("Query Failed!!");
                    if (mysqli_num_rows($result_sql_fetch_team_data) > 0) { ?>
                      <div class="ps-3">
                        <h6><?php echo mysqli_num_rows($result_sql_fetch_team_data) ?></h6>
                        <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                      <?php } ?>
                      </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->
            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Active Users <span>| Count</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      $sql_fetch_end_user_data = "SELECT active_record FROM user_data WHERE active_record = 'Yes'";
                      $result_sql_fetch_end_user_data = mysqli_query($conn, $sql_fetch_end_user_data) or die("Query Failed!!");
                      if (mysqli_num_rows($result_sql_fetch_end_user_data) > 0) { ?>
                        <h6><?php echo mysqli_num_rows($result_sql_fetch_end_user_data) ?></h6>
                        <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Customers Card -->
            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>
                  <!-- Line Chart -->
                  <div id="reportsChart"></div>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sales',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Customers',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->
                </div>
              </div>
            </div><!-- End Reports -->

            <!-- Start Recent Courses -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Recent Courses</h5>
                  <table class="table table-borderless datatable table-striped">
                    <thead>
                      <tr>
                        <th class="border border-primary text-primary">Title</th>
                        <th class="border border-primary text-primary">Sell Price</th>
                        <th class="border border-primary text-primary">Estimated Price</th>
                        <th class="border border-primary text-primary">Discount</th>
                        <th class="border border-primary text-primary">Category</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Fetch Course Data -->
                      <?php
                      $sql_fetch_all_courses = "SELECT * FROM course INNER JOIN category ON course.category=category.category_id WHERE course.active_record = 'Yes' ORDER BY cid DESC";
                      $result_sql_fetch_all_courses = mysqli_query($conn, $sql_fetch_all_courses) or die("Query Failed!!");
                      if (mysqli_num_rows($result_sql_fetch_all_courses) > 0) {
                        while ($row_sql_fetch_all_courses = mysqli_fetch_assoc($result_sql_fetch_all_courses)) {
                      ?>
                          <tr>
                            <td><?php echo $row_sql_fetch_all_courses['title'] ?></td>
                            <td class='text-center'>₹ <?php echo $row_sql_fetch_all_courses['sell_price'] ?></td>
                            <td class='text-center'>₹ <?php echo $row_sql_fetch_all_courses['main_price'] ?></td>
                            <td class='text-center'><?php echo $row_sql_fetch_all_courses['discount'] ?>%</td>
                            <td><?php echo $row_sql_fetch_all_courses['category_name'] ?></td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!-- End Recent Courses -->


            <!-- Start Recent Users -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Recent Users</h5>
                  <table class="table table-borderless datatable table-striped">
                    <thead>
                      <tr>
                        <th class="border border-primary text-primary">User Name</th>
                        <th class="border border-primary text-primary">Full Name</th>
                        <th class="border border-primary text-primary">Designation</th>
                        <th class="border border-primary text-primary">Role</th>
                        <th class="border border-primary text-primary">Phone</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Fetch Users Data -->
                      <?php
                      $sql_fetch_all_user = "SELECT * FROM user_data WHERE active_record = 'Yes' ORDER BY user_id DESC";
                      $result_sql_fetch_all_user = mysqli_query($conn, $sql_fetch_all_user) or die("Query Failed!!");
                      if (mysqli_num_rows($result_sql_fetch_all_user) > 0) {
                        while ($row_sql_fetch_all_user = mysqli_fetch_assoc($result_sql_fetch_all_user)) {
                      ?>
                          <tr>
                            <td><?php echo $row_sql_fetch_all_user['username'] ?></td>
                            <td><?php echo $row_sql_fetch_all_user['full_name'] ?></td>
                            <td><?php echo $row_sql_fetch_all_user['designation'] ?></td>
                            <!-- Role Permission Conditional Rending -->
                            <?php
                            $user_role_permission = '';
                            if ($row_sql_fetch_all_user['role'] == '0') {
                              $user_role_permission = 'Administration Level';
                            } elseif ($row_sql_fetch_all_user['role'] == '1') {
                              $user_role_permission = 'Middle Management Level';
                            } else {
                              $user_role_permission = 'End User';
                            }
                            ?>
                            <td><?php echo $user_role_permission ?></td>
                            <td><?php echo $row_sql_fetch_all_user['phone'] ?></td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!-- End Recent Users -->

          </div>
        </div><!-- End Left side columns -->
        <!-- Right side columns -->
        <div class="col-lg-4">


          <!-- Website Traffic -->
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
              <h5 class="card-title">Application Trafic</h5>
              <p>Total Trafic Browser Wise : <?php echo $total_trafic ?></p>
              <!-- Radial Bar Chart -->
              <div id="radialBarChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#radialBarChart"), {
                    series: [<?php echo $Chrome; ?>, <?php echo $Edge; ?>, <?php echo $Firefox; ?>, <?php echo $Other; ?>, <?php echo $Safari; ?>, ],
                    chart: {
                      height: 350,
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
          <!-- End Website Traffic -->


          <!-- Recent Activity -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">Recent Activity <span>| Today</span></h5>
              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label">32 min</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Create A New <a class="fw-bold text-dark"> Course</a>
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">56 min</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Delete A End User
                  </div>
                </div><!-- End activity item-->
                <div class="activity-item d-flex">
                  <div class="activite-label">2 hrs</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Alter User Permission
                  </div>
                </div><!-- End activity item-->
                <div class="activity-item d-flex">
                  <div class="activite-label">1 day</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    Modify <a href="#" class="fw-bold text-dark">Category</a> Data
                  </div>
                </div><!-- End activity item-->
                <div class="activity-item d-flex">
                  <div class="activite-label">2 Day</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Create A New <a class="fw-bold text-dark"> Course</a>
                  </div>
                </div><!-- End activity item-->
              </div>
            </div>
          </div>
          <!-- End Recent Activity -->

          <!-- Budget Report -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>
                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>
            <div class="card-body pb-0">
              <h5 class="card-title">Budget Report <span>| This Month</span></h5>
              <div id="budgetChart" style="min-height: 400px;" class="echart"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                    legend: {
                      data: ['Allocated Budget', 'Actual Spending']
                    },
                    radar: {
                      // shape: 'circle',
                      indicator: [{
                          name: 'Sales',
                          max: 6500
                        },
                        {
                          name: 'Administration',
                          max: 16000
                        },
                        {
                          name: 'Information Technology',
                          max: 30000
                        },
                        {
                          name: 'Customer Support',
                          max: 38000
                        },
                        {
                          name: 'Development',
                          max: 52000
                        },
                        {
                          name: 'Marketing',
                          max: 25000
                        }
                      ]
                    },
                    series: [{
                      name: 'Budget vs spending',
                      type: 'radar',
                      data: [{
                          value: [4200, 3000, 20000, 35000, 50000, 18000],
                          name: 'Allocated Budget'
                        },
                        {
                          value: [5000, 14000, 28000, 26000, 42000, 21000],
                          name: 'Actual Spending'
                        }
                      ]
                    }]
                  });
                });
              </script>
            </div>
          </div>
          <!-- End Budget Report -->



        </div><!-- End Right side columns -->
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>