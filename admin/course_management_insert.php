<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
?>

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
      <h1>Course Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Course Management</li>
          <li class="breadcrumb-item active">Create a New Course</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create a New Course</h5>
              <!-- PHP Code for Insert Course Record -->
              <?php
              if (isset($_POST['save'])) {

                if (isset($_FILES['fileToUpload'])) {
                  // Picture Quality Set Input
                  $picture_quality = mysqli_real_escape_string($conn, $_POST['picture_quality']);
                  if ($_FILES['fileToUpload']["size"] > 10485760) {
                    echo "<div class='alert alert-danger'>Image must be 10mb or lower.</div>";
                  }
                  $info = getimagesize($_FILES['fileToUpload']['tmp_name']);
                  if (isset($info['mime'])) {
                    if ($info['mime'] == "image/jpeg") {
                      $img = imagecreatefromjpeg($_FILES['fileToUpload']['tmp_name']);
                    } elseif ($info['mime'] == "image/png") {
                      $img = imagecreatefrompng($_FILES['fileToUpload']['tmp_name']);
                    } elseif ($info['mime'] == "image/webp") {
                      $img = imagecreatefromwebp($_FILES['fileToUpload']['tmp_name']);
                    } else {
                      echo "<div class='alert alert-danger'>This extension file not allowed, Please choose a JPG, JPEG, PNG or WEBP file.</div>";
                    }
                    if (isset($img)) {

                      // Course Icon
                      if (isset($_FILES['fileToUpload_icon'])) {
                        // Picture Quality Set Input
                        $picture_quality = mysqli_real_escape_string($conn, $_POST['picture_quality']);
                        if ($_FILES['fileToUpload_icon']["size"] > 10485760) {
                          echo "<div class='alert alert-danger'>Image must be 10mb or lower.</div>";
                        }
                        $info = getimagesize($_FILES['fileToUpload_icon']['tmp_name']);
                        if (isset($info['mime'])) {
                          if ($info['mime'] == "image/jpeg") {
                            $img_icon = imagecreatefromjpeg($_FILES['fileToUpload_icon']['tmp_name']);
                          } elseif ($info['mime'] == "image/png") {
                            $img_icon = imagecreatefrompng($_FILES['fileToUpload_icon']['tmp_name']);
                          } elseif ($info['mime'] == "image/webp") {
                            $img_icon = imagecreatefromwebp($_FILES['fileToUpload_icon']['tmp_name']);
                          } else {
                            echo "<div class='alert alert-danger'>This extension file not allowed, Please choose a JPG, JPEG, PNG or WEBP file.</div>";
                          }
                          if (isset($img)) {
                            if (isset($img_icon)) {
                              // Course Icon

                              // Course Poster
                              $output_img = date("d_m_Y_h_i_sa") . "_" . basename($_FILES['fileToUpload']["name"]) . ".webp";
                              imagewebp($img, "upload_media/courses_poster/" . $output_img, $picture_quality);
                              // Course icon
                              $output_img_icon = date("d_m_Y_h_i_sa") . "_" . basename($_FILES['fileToUpload_icon']["name"]) . ".webp";
                              imagewebp($img_icon, "upload_media/courses_poster/" . $output_img_icon, $picture_quality);

                              $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
                              $description = mysqli_real_escape_string($conn, $_POST['description']);
                              $course_price = mysqli_real_escape_string($conn, $_POST['course_price']);
                              $estimated_price = mysqli_real_escape_string($conn, $_POST['estimated_price']);
                              $discount = floor((abs($estimated_price - $course_price) / $estimated_price) * 100);
                              $category = mysqli_real_escape_string($conn, $_POST['category']);
                              $level = mysqli_real_escape_string($conn, $_POST['level']);
                              $course_tags = mysqli_real_escape_string($conn, $_POST['course_tags']);
                              $flo = mysqli_real_escape_string($conn, $_POST['flo']);
                              $slo = mysqli_real_escape_string($conn, $_POST['slo']);
                              $tlo = mysqli_real_escape_string($conn, $_POST['tlo']);
                              $fpr = mysqli_real_escape_string($conn, $_POST['fpr']);
                              $spr = mysqli_real_escape_string($conn, $_POST['spr']);
                              $tpr = mysqli_real_escape_string($conn, $_POST['tpr']);
                              $first_feature = mysqli_real_escape_string($conn, $_POST['first_feature']);
                              $second_feature = mysqli_real_escape_string($conn, $_POST['second_feature']);
                              $third_feature = mysqli_real_escape_string($conn, $_POST['third_feature']);
                              $fourth_feature = mysqli_real_escape_string($conn, $_POST['fourth_feature']);
                              $resource = mysqli_real_escape_string($conn, $_POST['resource']);
                              $user_id = $_SESSION['user_id'];
                              $email = $_SESSION['email'];
                              $date = Date('d-m-Y');
                              $sql_insert_course = "INSERT INTO course (title, description, main_price, sell_price, discount, learning_skill_1, learning_skill_2, learning_skill_3, feature_1, feature_2, feature_3, feature_4, skill_tags, category, level, prerequisties_1, prerequisties_2, prerequisties_3, resource_link, entry_date, user_id, user_email, icon, poster) VALUES ('{$course_name}', '{$description}','{$estimated_price}', '{$course_price}', '{$discount}', '{$flo}', '{$slo}', '{$tlo}','{$first_feature}', '{$second_feature}','{$third_feature}', '{$fourth_feature}','{$course_tags}', '{$category}', '{$level}', '{$fpr}', '{$spr}', '{$tpr}', '{$resource}', '{$date}', '{$user_id}','{$email}','{$output_img_icon}', '{$output_img}');";
                              echo $sql_insert_course .= "UPDATE category SET num_of_record = num_of_record + 1 WHERE category_id = '{$category}'";
                              if (mysqli_multi_query($conn, $sql_insert_course)) {
              ?>
                                <script>
                                  alert('Course is Inserted successfully !!')
                                </script>
                              <?php
                                echo "<script>window.location.href='$hostname/admin/course_management_read.php'</script>";
                              } else {
                              ?>
                                <script>
                                  alert('Course is not Insert !!')
                                </script>
              <?php
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
              ?>
              <!-- PHP Code for Insert Course Record -->
              <!-- Floating Labels Form -->
              <form class="row g-3" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="on">
                <div class="col-md-12 border-top">
                  <p class="card-text p-1 pt-4"><i class="bi bi-1-circle"></i> Step</p>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mt-3">
                    <input type="text" class="form-control" id="floatingName" placeholder="Course Name" name='course_name' required>
                    <label for="floatingName">Course Name</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <label for="formFile" class="form-label">Course Icon</label>
                  <input class="form-control" type="file" name="fileToUpload_icon" id="formFile" required>
                </div>

                <div class="col-md-3">
                  <label for="formFile" class="form-label">Course Poster</label>
                  <input class="form-control" type="file" name="fileToUpload" id="formFile" required>
                </div>

                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text py-3">₹</span>
                    </div>
                    <input type="number" class="form-control py-3" placeholder="Course Price" aria-label="Amount (to the nearest rupess)" name='course_price' required>
                    <div class="input-group-append">
                      <span class="input-group-text py-3">.00</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text py-3">₹</span>
                    </div>
                    <input type="number" class="form-control py-3" placeholder="Estimated Price" name='estimated_price' required>
                    <div class="input-group-append">
                      <span class="input-group-text py-3">.00</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="input-group">
                    <div class='w-100'>
                      <label for="customRange1" class="form-label">Picture Quality</label>
                      <div class='d-flex justify-content-center gap-3 align-items-center'>
                        <span>25%</span>
                        <input type="range" class="form-range" id="customRange1" value="100" name='picture_quality'>
                        <span>100%</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <!-- CKEditor -->
                    <textarea name="description" id="editor" class="form-control">Course Description</textarea>
                    <!-- CKEditor -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="category" name='category' required>
                      <option value=''>Course Category</option>
                      <!-- Fetch Data from Category Table -->
                      <?php
                      $sql_fetch_all_category = "SELECT * FROM category WHERE active_record = 'Yes' ORDER BY category_id DESC";
                      $result_sql_fetch_all_category = mysqli_query($conn, $sql_fetch_all_category) or die("Query Failed!!");
                      if (mysqli_num_rows($result_sql_fetch_all_category) > 0) {
                        while ($row_sql_fetch_all_category = mysqli_fetch_assoc($result_sql_fetch_all_category)) {
                      ?>
                          <option value="<?php echo $row_sql_fetch_all_category['category_id'] ?>"><?php echo $row_sql_fetch_all_category['category_name']; ?></option>
                      <?php }
                      } ?>
                      <!-- Fetch Data from Category Table -->
                    </select>
                    <label for="floatingSelect">Course Category</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="level" name='level' required>
                      <option value=''>Beginner/ Intermediate / Expert</option>
                      <option value="Beginner">Beginner</option>
                      <option value="Intermediate">Intermediate</option>
                      <option value="Expert">Expert</option>
                    </select>
                    <label for="floatingSelect">Course Level</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="Course Tags" name='course_tags'>
                    <label for="floatingEmail">Course Tags</label>
                  </div>
                </div>
                <div class="col-md-12 border-top">
                  <p class="card-text p-1 pt-4"><i class="bi bi-2-circle"></i> Step</p>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="First Learning objective" name='flo'>
                    <label for="floatingEmail">First Learning objective</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="Second Learning objective" name='slo'>
                    <label for="floatingEmail">Second Learning objective</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="Third Learning objective" name='tlo'>
                    <label for="floatingEmail">Third Learning objective</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="First Learning objective" name='fpr'>
                    <label for="floatingEmail">First Pre-requisites</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="Second Pre-requisites" name='spr'>
                    <label for="floatingEmail">Second Pre-requisites</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="Third Pre-requisites" name='tpr'>
                    <label for="floatingEmail">Third Pre-requisites</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="First Feature" name='first_feature'>
                    <label for="floatingEmail">First Feature</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="Second Feature" name='second_feature'>
                    <label for="floatingEmail">Second Feature</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="Third Feature" name='third_feature'>
                    <label for="floatingEmail">Third Feature</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="Fourth Feature" name='fourth_feature'>
                    <label for="floatingEmail">Fourth Feature</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="Resource" name='resource'>
                    <label for="floatingEmail">Resource</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="save" required>Create Now</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>