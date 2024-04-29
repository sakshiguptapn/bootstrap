<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Analysis section nav start -->
        <?php
        // $_SESSION['user_role'] = 0,1 or 9 => 0 - Admin | 1 - Middle Management | 9 - End User
        if ($_SESSION['user_role'] == 0 || $_SESSION['user_role'] == 1) { ?>

            <!-- Start Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link " href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#analysisCenter" data-bs-toggle="collapse" href="user_management_read.php">
                    <i class="bi bi-clipboard-data"></i><span>Analysis Center</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="analysisCenter" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="analysis_trafic_data.php">
                            <i class="bi bi-circle"></i><span>Application Trafic</span>
                        </a>
                    </li>
                    <li>
                        <a href="analysis_administrative_data.php">
                            <i class="bi bi-circle"></i><span>Administrative Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="analysis_course_data.php">
                            <i class="bi bi-circle"></i><span>Courses Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="analysis_uers_data.php">
                            <i class="bi bi-circle"></i><span>Users Data</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Analysis section nav start -->
            <!-- Course management section nav start -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#course_management" data-bs-toggle="collapse" href="user_management_read.php">
                    <i class="bi bi-journal-medical"></i><span>Course Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="course_management" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="course_management_read.php">
                            <i class="bi bi-circle"></i><span>All Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="course_management_insert.php">
                            <i class="bi bi-circle"></i><span>Create a New Course</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Course management section nav start -->
            <!-- Category management section nav start -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#category_management" data-bs-toggle="collapse" href="user_management_read.php">
                    <i class="bi bi-menu-button"></i><span>Category Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="category_management" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="category_management_read.php">
                            <i class="bi bi-circle"></i><span>All Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="category_management_insert.php">
                            <i class="bi bi-circle"></i><span>Create a New Category</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Category management section nav start -->
            <!-- Review management section nav start -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#review" data-bs-toggle="collapse" href="user_management_read.php">
                    <i class="bi bi-star-half"></i><span>Review Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="review" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="review_management_read.php">
                            <i class="bi bi-circle"></i><span>All Review</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Review management section nav start -->
            <!-- Discussion lobby -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="discussion_lobby_team_read.php">
                    <i class="bi bi-chat-left-text"></i>
                    <span>Discussion lobby</span>
                </a>
            </li>
            <!-- Discussion lobby -->
        <?php } ?>
        <?php
        if ($_SESSION['user_role'] == 0) { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="team_management_read.php">
                    <i class="bi bi-microsoft-teams"></i>
                    <span>Team Management</span>
                </a>
            </li>
            <!-- user management section nav start -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#user_management" data-bs-toggle="collapse" href="user_management_read.php">
                    <i class="bi bi-people-fill"></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="user_management" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="user_management_read.php">
                            <i class="bi bi-circle"></i><span>Administration Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_management_read_middle_management.php">
                            <i class="bi bi-circle"></i><span>Middle Management Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_management_read_end_users.php">
                            <i class="bi bi-circle"></i><span>End Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_management_insert.php">
                            <i class="bi bi-circle"></i><span>Create a New User</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- user management section nav start -->
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile-overview.php">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="mycourses.php">
                <i class="bi bi-question-circle"></i>
                <span>My Courses</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->
    </ul>
</aside><!-- End Sidebar-->