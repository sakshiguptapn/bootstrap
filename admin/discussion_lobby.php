<!-- Import Files -->
<?php include('admin_header.php');
include('private_files/system_configure_setting.php');
if (!isset($_GET['receiver_id'])) {
  $receiver_id = 'NULL';
} else {
  $receiver_id = $_GET['receiver_id'];
}
if (!isset($_GET['team_id'])) {
  echo "<script>window.location.href='$hostname/admin/discussion_lobby_team_read.php'</script>";
}
$team_id = $_GET['team_id']; ?>

<body>
  <!-- Nav Bar -->
  <?php include("navbar.php") ?>
  <!-- Nav Bar -->
  <!-- ======= Sidebar ======= -->
  <?php include('sidebar.php') ?>
  <!-- ======= Sidebar ======= -->
  <!-- INSERT CHAT CODE -->
  <?php
  $sender_id = $_SESSION['user_id'];
  if (isset($_POST['save'])) {
    try {
      date_default_timezone_set("Asia/Kolkata");
      $dateObject = new DateTime(date("h:m", time()));
      $time = $dateObject->format('h:i A');
      $date = Date('d-m-Y');
      $chat_text = mysqli_real_escape_string($conn, $_POST['chat_text']);
      $sql_insert_chat = "INSERT INTO chat (chat_text, sender_id, receiver_id, chat_time, chat_date)
                            VALUES ('{$chat_text}','{$sender_id}', '{$receiver_id}','{$time}','{$date}')";
      if (mysqli_query($conn, $sql_insert_chat)) {
        echo "<script>window.location.href='$hostname/admin/discussion_lobby.php?receiver_id=$receiver_id&team_id=$team_id'</script>";
      } else {
        throw new Exception("Message not send.");
      }
    } catch (\Throwable $th) {
      echo ("<div class='d-flex justify-content-center position-fixed' style='top:200px; right:35px;'><p class='btn btn-danger'>Error: " . $th->getMessage() . "</p></div>");
    }
  }
  ?>
  <!-- INSERT CHAT CODE -->
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
        <!-- User List -->
        <div class="col-xl-4 overflow-y-auto" style='height:75vh;'>
          <?php
          // $sql_fetch_all_user = "SELECT DISTINCT user_data.user_id, user_data.profile_picture, user_data.username, chat.receiver_id, chat.sender_id
          //  FROM user_data
          //  INNER JOIN chat ON user_data.user_id = chat.sender_id
          //  WHERE chat.active_record = 'Yes' GROUP BY user_data.user_id ORDER BY chat.chat_id DESC";
          $sql_fetch_all_user = "SELECT * FROM team_member
          INNER JOIN user_data ON team_member.tm_user_id = user_data.user_id
          WHERE team_member.enroll_team_id = '{$team_id}' AND team_member.active_record = 'Yes'";
          $result_sql_fetch_all_user = mysqli_query($conn, $sql_fetch_all_user) or die("Query Failed!!");
          if (mysqli_num_rows($result_sql_fetch_all_user) > 0) {
            while ($row_sql_fetch_all_user = mysqli_fetch_assoc($result_sql_fetch_all_user)) {
              if ($sender_id == $row_sql_fetch_all_user['user_id']) {
                $login_user_sender_text = ' (YOU) ';
              } else {
                $login_user_sender_text = '';
              }
          ?>
              <!-- Card Element -->
              <a href="discussion_lobby.php?receiver_id=<?php echo $row_sql_fetch_all_user['user_id']; ?>&team_id=<?php echo $row_sql_fetch_all_user['enroll_team_id']; ?>" class='text-dark'>
                <div class="card-body profile-card border pt-4 mb-2 d-flex align-items-center gap-3 rounded-2 bg-white shadow-sm" style='cursor: pointer;'>
                  <img src="upload_media/users_profiles_picture/<?php echo $row_sql_fetch_all_user['profile_picture'] ?>" alt="Profile" style="width: 45px; height:45px" class="rounded-circle border border-2 border-primary">
                  <div class='d-flex justify-content-between align-items-center w-100'>
                    <h5 class='fw-semibold h6'><?php echo $row_sql_fetch_all_user['username'];
                                                echo $login_user_sender_text; ?></h5>
                  </div>
                </div>
              </a>
              <!-- Card Element -->
          <?php
            }
          }
          ?>
        </div>
        <!-- User List -->
        <!-- Conditional Rendering -->
        <?php
        if ($receiver_id != 'NULL') {
        ?>
          <!-- Conversation Screen -->
          <div class="col-xl-8">
            <div class="card">
              <div class="card-body pt-3" style='height:75vh; cursor:pointer;'>
                <?php
                $sql_fetch_chat = "SELECT user_data.user_id, user_data.profile_picture, user_data.username, chat.sender_id, chat.receiver_id, chat.chat_id FROM user_data INNER JOIN chat ON user_data.user_id = chat.receiver_id WHERE chat.active_record = 'Yes' AND chat.sender_id = '{$sender_id}' AND chat.receiver_id = '{$receiver_id}' ORDER BY chat.chat_id LIMIT 0,1";
                $result_sql_fetch_chat = mysqli_query($conn, $sql_fetch_chat) or die("Query Failed!!");
                if (mysqli_num_rows($result_sql_fetch_chat) > 0) {
                  while ($row_sql_fetch_chat = mysqli_fetch_assoc($result_sql_fetch_chat)) {
                ?>
                    <!-- Header of Chat -->
                    <!-- Card Element -->
                    <div class="profile-card border p-2 mb-2 d-flex align-items-center gap-3 rounded-2 bg-white shadow-sm" style='cursor: pointer;'>
                      <img src="upload_media/users_profiles_picture/<?php echo $row_sql_fetch_chat['profile_picture'] ?>" alt="Profile" style="width: 30px; height:30px" class="rounded-circle">
                      <h5 class='fw-semibold h6 pt-2'><?php echo $row_sql_fetch_chat['username'] ?></h5>
                    </div>
                    <!-- Card Element -->
                    <!-- Header of Chat -->
                <?php }
                } ?>
                <div class='rounded-2 p-3 chartBox card mb-3' style="height: 80%; overflow-y: scroll;">
                  <!-- Fetch Chat -->
                  <?php
                  $sql_fetch_chat = "SELECT user_data.user_id, user_data.profile_picture, user_data.username, chat.chat_text, chat.chat_time, chat.sender_id, chat.receiver_id 
                  FROM user_data 
                  INNER JOIN chat ON user_data.user_id = chat.receiver_id 
                  WHERE chat.active_record = 'Yes' AND (chat.sender_id = '{$sender_id}' OR chat.sender_id = '{$receiver_id}')
                  AND (chat.receiver_id = '{$sender_id}' OR chat.receiver_id = '{$receiver_id}') 
                  ORDER BY chat.chat_id";
                  $result_sql_fetch_chat = mysqli_query($conn, $sql_fetch_chat) or die("Query Failed!!");
                  if (mysqli_num_rows($result_sql_fetch_chat) > 0) {
                    while ($row_sql_fetch_chat = mysqli_fetch_assoc($result_sql_fetch_chat)) {
                  ?>
                      <div class='d-flex flex-wrap justify-content-between align-items-center w-75 btn btn-light pt-3 pb-0 mb-2'>
                        <p><?php echo $row_sql_fetch_chat['chat_text'] ?></p>
                        <em style='font-size: 13px;'><?php echo $row_sql_fetch_chat['chat_time'] ?></em>
                      </div>
                  <?php }
                  } ?>
                </div>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                  <div class='d-flex justify-content-between align-items-center gap-2'>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-chat-left-text"></i></span>
                      <input type="text" class="form-control" placeholder='Type a message' name="chat_text">
                    </div>
                    <div>
                      <button type="submit" name="save" class="btn btn-outline-primary"><i class="bi bi-send-fill"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Conversation Screen -->
        <?php } else {
        ?>
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
        <?php
        } ?>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <script>
    let scrollToBottom = (elem) => {
      let el = document.querySelector(elem);
      el.scrollTop = el.scrollHeight;
    }
    scrollToBottom('.chartBox')
  </script>
  <?php include('admin_footer.php') ?>