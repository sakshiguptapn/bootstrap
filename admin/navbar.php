<!-- Import Files -->
<?php include('private_files/system_configure_setting.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:{$hostname}/login.php");
}
?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="<?php echo $hostname ?>" class="logo d-flex align-items-center">
            <img src="../assets/img/meta_icon/Logo.png" style="width: 50%;" alt="project.dev">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <!-- End Search Icon-->
            <!-- Start Messages Nav -->
            <?php
            if ($_SESSION['user_role'] == 0 || $_SESSION['user_role'] == 1) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number rounded-circle" style='color:transparent'>3</span>
                    </a><!-- End Messages Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have few recent messages
                            <a href="discussion_lobby_team_read.php"><span class="badge rounded-pill bg-success p-2 ms-2">View all</span></a>
                        </li>
                        <!-- Fetch Chat -->
                        <?php
                        $login_user_id = $_SESSION['user_id'];
                        $sql_fetch_chat = "SELECT chat.chat_text, chat.sender_id,  chat.receiver_id, chat.chat_time, chat.chat_id , chat.active_record,
                    user_data.user_id, user_data.username, user_data.profile_picture
                    FROM chat
                    INNER JOIN user_data ON chat.receiver_id = user_data.user_id
                    WHERE chat.active_record = 'Yes'
                    AND user_data.active_record = 'Yes'
                    AND chat.sender_id = '{$login_user_id}'
                    AND chat.receiver_id != '{$login_user_id}'
                    GROUP BY chat.receiver_id
                    ORDER BY chat.chat_id DESC
                    LIMIT 0, 3";
                        $result_sql_fetch_chat = mysqli_query($conn, $sql_fetch_chat) or die("Query Failed!!");
                        if (mysqli_num_rows($result_sql_fetch_chat) > 0) {
                            while ($row_sql_fetch_chat = mysqli_fetch_assoc($result_sql_fetch_chat)) {
                        ?>
                                <!-- Message Bar -->
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="message-item" style='cursor: pointer;'>
                                    <a href="discussion_lobby_team_read.php">
                                        <img src="upload_media/users_profiles_picture/<?php echo $row_sql_fetch_chat['profile_picture'] ?>" alt="Profile" class="rounded-circle">
                                        <div>
                                            <h4><?php echo $row_sql_fetch_chat['username'] ?></h4>
                                            <p><?php echo $row_sql_fetch_chat['chat_text'] ?></p>
                                        </div>
                                    </a>
                                </li>
                                <!-- Message Bar -->
                            <?php }
                        } else {
                            ?>
                            <!-- Message Bar -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="message-item" style='cursor: pointer;'>
                                <div class='d-flex flex-column justify-content-center align-items-center py-3'>
                                    <i class="bi bi-trash2 h2"></i>
                                    <p>Empty Message Box</p>
                                </div>
                            </li>
                            <!-- Message Bar -->
                        <?php
                        }
                        ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="discussion_lobby_team_read.php">Show all messages</a>
                        </li>
                    </ul><!-- End Messages Dropdown Items -->
                </li>
            <?php } ?>
            <!-- End Messages Nav -->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="upload_media/users_profiles_picture/<?php echo $_SESSION['user_profile_picture'] ?>" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username']; ?></span>
                </a><!-- End Profile Iamge Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo $_SESSION['username']; ?></h6>
                        <span><?php echo $_SESSION['user_designation']; ?></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile-overview.php">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile-settings.php">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center text-danger" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->