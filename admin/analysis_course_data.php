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
          <li class="breadcrumb-item active">Course Management Analysis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row pt-4">
        <div class="col-lg-6">
          <div class="card" style="cursor: pointer;">
            <div class="card-body">
              <h5 class="card-title">Course Category Data</h5>
              <!-- Polar Area Chart -->
              <div id="polarAreaChart"></div>
              <!-- PHP Code for data fetch from database -->
              <?php
              $sql_fetch_course_category_data = "SELECT * FROM category WHERE active_record = 'Yes' ORDER BY num_of_record";
              $result_sql_fetch_course_category_data = mysqli_query($conn, $sql_fetch_course_category_data) or die("Query Failed!!");
              if (mysqli_num_rows($result_sql_fetch_course_category_data) > 0) {
                $temp = array();
                $categoryNameFetchRes = array();
                $categoryRecordCountFetchRes = array();
                while ($row_sql_fetch_course_category_data = mysqli_fetch_assoc($result_sql_fetch_course_category_data)) {
                  $categoryNameFetchRes[] = $row_sql_fetch_course_category_data['category_name'];
                  $categoryRecordCountFetchRes[] = $row_sql_fetch_course_category_data['num_of_record'];
                }
                $categoryRecordCountFetchResArrayValues = '';
                foreach ($categoryRecordCountFetchRes as $value) {
                  $categoryRecordCountFetchResArrayValues .= $value . ', ';
                }
              }
              ?>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#polarAreaChart"), {
                    series: [<?php echo $categoryRecordCountFetchResArrayValues ?>],
                    labels: <?php echo json_encode($categoryNameFetchRes) ?>,
                    chart: {
                      type: 'polarArea',
                      height: 400,
                      toolbar: {
                        show: true
                      },
                    },
                    stroke: {
                      colors: ['#fff']
                    },
                    fill: {
                      opacity: 0.8
                    }
                  }).render();
                });
              </script>
              <!-- End Polar Area Chart -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>