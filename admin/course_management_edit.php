<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
if (!isset($_GET['id'])) {
  echo "<script>window.location.href='$hostname/admin/course_management_read.php'</script>";
}
$id = $_GET['id'];
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
          <li class="breadcrumb-item active">Modify Course Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Modify Course Details</h5>
              <!-- PHP Code for Update   Course Record -->
              <?php
              if (isset($_POST['save'])) {
                $file_name = '';
                if (empty($_FILES['new-image']['name'])) {
                  $save_img_name = $_POST['old-image'];
                } else {
                  if (isset($_FILES['new-image'])) {
                    $file_name = $_FILES['new-image']["name"];
                    $file_tmp = $_FILES['new-image']["tmp_name"];
                    $file_type = $_FILES['new-image']["type"];
                    $file_size = $_FILES['new-image']["size"];
                    $tempFileExt = explode('.', $file_name);
                    $file_ext = strtolower(end($tempFileExt));
                    $allow_extension = array("jpg", "jpeg", "png", "webp");
                    $file_error = array();
                    if (in_array($file_ext, $allow_extension) === false) {
                      $file_error[] = "This extension file not allowed, Please choose a JPG or PNG file.";
                    }
                    if ($file_size > 2097152) {
                      $file_error[] = "Image must be 2mb or lower.";
                    }
                    $save_img_name = date("d_M_Y_h_i_sa") . "_" . basename($file_name);
                    $img_save_target = "upload_media/courses_poster/";
                    if (empty($file_error) == true) {
                      move_uploaded_file($file_tmp, $img_save_target . $save_img_name);
                    } else {
                      print_r($file_error);
                      die();
                    }
                  }
                }

                // course icon
                $file_name_icon = '';
                if (empty($_FILES['new-image-icon']['name'])) {
                  $save_img_name_icon = $_POST['old-image-icon'];
                } else {
                  if (isset($_FILES['new-image-icon'])) {
                    $file_name_icon = $_FILES['new-image-icon']["name"];
                    $file_tmp = $_FILES['new-image-icon']["tmp_name"];
                    $file_type = $_FILES['new-image-icon']["type"];
                    $file_size = $_FILES['new-image-icon']["size"];
                    $tempFileExt = explode('.', $file_name_icon);
                    $file_ext = strtolower(end($tempFileExt));
                    $allow_extension = array("jpg", "jpeg", "png", "webp");
                    $file_error = array();
                    if (in_array($file_ext, $allow_extension) === false) {
                      $file_error[] = "This extension file not allowed, Please choose a JPG or PNG file.";
                    }
                    if ($file_size > 2097152) {
                      $file_error[] = "Image must be 2mb or lower.";
                    }
                    $save_img_name_icon = date("d_M_Y_h_i_sa") . "_" . basename($file_name_icon);
                    $img_save_target_icon = "upload_media/courses_poster/";
                    if (empty($file_error) == true) {
                      move_uploaded_file($file_tmp, $img_save_target_icon . $save_img_name_icon);
                    } else {
                      print_r($file_error);
                      die();
                    }
                  }
                }
                // course icon
                $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $course_price = mysqli_real_escape_string($conn, $_POST['course_price']);
                $estimated_price = mysqli_real_escape_string($conn, $_POST['estimated_price']);
                $discount = mysqli_real_escape_string($conn, $_POST['discount']);
                $category = mysqli_real_escape_string($conn, $_POST['category']);
                $old_category = $_POST['old_category'];
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
                $sql_update_course_details = "UPDATE course SET title = '{$course_name}', description = '{$description}', main_price = '{$estimated_price}' , sell_price = '{$course_price}', discount = '{$discount}', learning_skill_1 = '{$flo}', learning_skill_2 = '{$slo}', learning_skill_3 = '{$tlo}', feature_1 = '{$first_feature}', feature_2 = '{$second_feature}', feature_3 = '{$third_feature}', feature_4 = '{$fourth_feature}', skill_tags = '{$course_tags}', category = '{$category}', level = '{$level}', prerequisties_1 = '{$fpr}', prerequisties_2 = '{$spr}', prerequisties_3 = '{$tpr}', resource_link = '{$resource}', icon = '{$save_img_name_icon}' , poster = '{$save_img_name}' WHERE cid ='{$id}';";

                // If Category Change
                if ($old_category !=  $category) {
                  $sql_update_course_details .= "UPDATE category SET num_of_record = num_of_record - 1 WHERE category_id = '{$old_category}';";
                  $sql_update_course_details .= "UPDATE category SET num_of_record = num_of_record + 1 WHERE category_id = '{$category}';";
                }

                if (mysqli_multi_query($conn, $sql_update_course_details)) {
              ?>
                  <script>
                    alert('Course Details Modify successfully !!')
                  </script>
                <?php
                  echo "<script>window.location.href='$hostname/admin/course_management_read.php'</script>";
                } else {
                ?>
                  <script>
                    alert('Course Details is not Modify !!')
                  </script>
              <?php
                }
              }
              ?>
              <!-- PHP Code for Update Course Record -->
              <!-- PHP Code for Fetch Course Data -->
              <?php
              $sql_fetch_all_courses = "SELECT * FROM course WHERE cid = '{$id}'";
              $result_sql_fetch_all_courses = mysqli_query($conn, $sql_fetch_all_courses) or die("Query Failed!!");
              $fetch = array();
              if (mysqli_num_rows($result_sql_fetch_all_courses) > 0) {
                while ($row_sql_fetch_all_courses = mysqli_fetch_assoc($result_sql_fetch_all_courses)) {
              ?>
                  <!-- PHP Code for Fetch Course Data -->
                  <!-- Floating Labels Form -->
                  <form class="row g-3" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="on">
                    <div class="col-md-12 border-top">
                      <p class="card-text p-1 pt-4"><i class="bi bi-1-circle"></i> Step</p>
                    </div>
                    <div class="col-md-10">
                      <div class="form-floating mt-3">
                        <input type="text" class="form-control" id="title" placeholder="Course Name" name='course_name' required value="<?php echo $row_sql_fetch_all_courses['title'] ?>">
                        <label for="title">Course Name</label>
                      </div>

                      <div class="row g-3 pt-3">
                        <div class="col-md-4">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text py-3">₹</span>
                            </div>
                            <input type="number" class="form-control py-3" placeholder="Course Price" aria-label="Amount (to the nearest rupess)" name='course_price' required value="<?php echo $row_sql_fetch_all_courses['sell_price'] ?>">
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
                            <input type="number" class="form-control py-3" placeholder="Estimated Price" name='estimated_price' required value="<?php echo $row_sql_fetch_all_courses['main_price'] ?>">
                            <div class="input-group-append">
                              <span class="input-group-text py-3">.00</span>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-4">
                          <div class="input-group">
                            <input type="number" class="form-control py-3" placeholder="Course Discount" name='discount' required value="<?php echo $row_sql_fetch_all_courses['discount'] ?>">
                            <div class="input-group-append">
                              <span class="input-group-text py-3">%</span>
                            </div>
                          </div>
                        </div>


                      </div>

                      <div class="row g-3 pt-3">

                        <div class="col-md-4">
                          <div class="form-floating mb-3">
                            <select class="form-select" id="category" aria-label="category" name='category' required>
                              <!-- Fetch Data from Category Table -->
                              <?php
                              $sql_fetch_all_category = "SELECT * FROM category WHERE active_record = 'Yes' ORDER BY category_id DESC";
                              $result_sql_fetch_all_category = mysqli_query($conn, $sql_fetch_all_category) or die("Query Failed!!");
                              if (mysqli_num_rows($result_sql_fetch_all_category) > 0) {
                                while ($row_sql_fetch_all_category = mysqli_fetch_assoc($result_sql_fetch_all_category)) {
                                  if ($row_sql_fetch_all_category['category_id'] == $row_sql_fetch_all_courses['category']) {
                              ?>
                                    <option selected value="<?php echo $row_sql_fetch_all_category['category_id'] ?>"><?php echo $row_sql_fetch_all_category['category_name'] ?></option>
                                  <?php } else { ?>
                                    <option value="<?php echo $row_sql_fetch_all_category['category_id']; ?>"><?php echo $row_sql_fetch_all_category['category_name']; ?></option>
                              <?php }
                                }
                              } ?>
                              <!-- Fetch Data from Category Table -->
                            </select>
                            <input type="hidden" value="<?php echo $row_sql_fetch_all_courses['category']; ?>" name="old_category">
                            <label for="category">Course Category</label>
                          </div>
                        </div>


                        <div class="col-md-4">
                          <div class="form-floating mb-3">
                            <select class="form-select" id="level" aria-label="level" name='level'>
                              <option selected value="<?php echo $row_sql_fetch_all_courses['level'] ?>"><?php echo $row_sql_fetch_all_courses['level'] ?></option>
                              <option value="Beginner">Beginner</option>
                              <option value="Intermediate">Intermediate</option>
                              <option value="Expert">Expert</option>
                            </select>
                            <label for="level">Course Level</label>
                          </div>
                        </div>


                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="skill_tags" placeholder="Course Tags" name='course_tags' value="<?php echo $row_sql_fetch_all_courses['skill_tags'] ?>">
                            <label for="skill_tags">Course Tags</label>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="d-flex justify-content-center gap-3 align-items-center">
                            <label for="customRange1">Quality: </label>
                            <span>25%</span>
                            <input type="range" class="form-range" id="customRange1" value="100" name='picture_quality' disabled>
                            <span>100%</span>
                          </div>
                        </div>


                      </div>

                    </div>

                    <div class="col-md-2 pt-3">
                      <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="upload_media/courses_poster/<?php echo $row_sql_fetch_all_courses['icon'] ?>" alt="Profile" class='w-100 border rounded-3 mb-2'>
                        <input type="file" name="new-image-icon" id="img-icon" style="display:none;" />
                        <label for="img-icon" class="btn btn-primary btn-sm w-100" title="Upload new icon "><i class="bi bi-upload"></i>&nbsp;&nbsp;Upload icon</label>
                        <input type="hidden" name="old-image-icon" value="<?php echo $row_sql_fetch_all_courses['icon']; ?>">
                      </div>
                    </div>

                    <!-- course icon -->
                    <div class="col-md-6 pt-3">
                      <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="upload_media/courses_poster/<?php echo $row_sql_fetch_all_courses['poster'] ?>" alt="Profile" class='w-100 border rounded-3 mb-2'>
                        <input type="file" name="new-image" id="img" style="display:none;" />
                        <label for="img" class="btn btn-primary btn-sm w-100" title="Upload new profile image"><i class="bi bi-upload"></i>&nbsp;&nbsp;Upload new course poster</label>
                        <input type="hidden" name="old-image" value="<?php echo $row_sql_fetch_all_courses['poster']; ?>">
                      </div>
                    </div>
                    <!-- course icon -->

                    <div class="col-md-6 pt-3">
                      <div class="form-floating">
                        <!-- CKEditor -->
                        <textarea name="description" id="editor" class="form-control"><?php echo $row_sql_fetch_all_courses['description'] ?></textarea>
                        <!-- CKEditor -->
                      </div>
                    </div>
                    <div class="col-md-12 border-top">
                      <p class="card-text p-1 pt-4"><i class="bi bi-2-circle"></i> Step</p>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="learning_skill_1" placeholder="First Learning objective" name='flo' value="<?php echo $row_sql_fetch_all_courses['learning_skill_1'] ?>">
                        <label for="learning_skill_1">First Learning objective</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="learning_skill_2" placeholder="Second Learning objective" name='slo' value="<?php echo $row_sql_fetch_all_courses['learning_skill_2'] ?>">
                        <label for="learning_skill_2">Second Learning objective</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="learning_skill_3" placeholder="Third Learning objective" name='tlo' value="<?php echo $row_sql_fetch_all_courses['learning_skill_3'] ?>">
                        <label for="learning_skill_3">Third Learning objective</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="prerequisties_1" placeholder="First Learning objective" name='fpr' value="<?php echo $row_sql_fetch_all_courses['prerequisties_1'] ?>">
                        <label for="prerequisties_1">First Pre-requisites</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="prerequisties_2" placeholder="Second Pre-requisites" name='spr' value="<?php echo $row_sql_fetch_all_courses['prerequisties_2'] ?>">
                        <label for="prerequisties_2">Second Pre-requisites</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="prerequisties_3" placeholder="Third Pre-requisites" name='tpr' value="<?php echo $row_sql_fetch_all_courses['prerequisties_3'] ?>">
                        <label for="prerequisties_3">Third Pre-requisites</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="feature_1" placeholder="First Feature" name='first_feature' value="<?php echo $row_sql_fetch_all_courses['feature_1'] ?>">
                        <label for="feature_1">First Feature</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="feature_2" placeholder="Second Feature" name='second_feature' value="<?php echo $row_sql_fetch_all_courses['feature_2'] ?>">
                        <label for="feature_2">Second Feature</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="feature_3" placeholder="Third Feature" name='third_feature' value="<?php echo $row_sql_fetch_all_courses['feature_3'] ?>">
                        <label for="feature_3">Third Feature</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="feature_4" placeholder="Fourth Feature" name='fourth_feature' value="<?php echo $row_sql_fetch_all_courses['feature_3'] ?>">
                        <label for="feature_4">Fourth Feature</label>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="resource_link" placeholder="Resource" name='resource' value="<?php echo $row_sql_fetch_all_courses['resource_link'] ?>">
                        <label for="resource_link">Resource</label>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="save" required>Save Changes</button>
                    </div>
                  </form><!-- End floating Labels Form -->
              <?php
                }
              } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('admin_footer.php') ?>