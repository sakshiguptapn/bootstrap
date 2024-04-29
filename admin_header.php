<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>project.dev</title>
    <!-- ===============================================-->
    <!--    Meta -->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/meta_icon/180x180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/meta_icon/32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/meta_icon/16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/meta_icon/16x16.png">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/meta_icon/150x150.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="admin/assets/css/style.css" rel="stylesheet">

    <!-- session -->
    <?php
    session_start();
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['email'], $_SESSION['user_role'], $_SESSION['user_profile_picture'])) {
        $sessionUserId =  $_SESSION['user_id'];
        $sessionUserUsername =  $_SESSION['username'];
        $sessionUserEmail =  $_SESSION['email'];
        $sessionUserRole =  $_SESSION['user_role'];
        $sessionUserProfile =  $_SESSION['user_profile_picture'];
    } else {
        $sessionUserId = 0;
        $sessionUserUsername = 0;
        $sessionUserEmail = 0;
        $sessionUserRole = 0;
        $sessionUserProfile = 0;
    }
    ?>
    <!-- session -->

</head>