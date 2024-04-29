<?php
// Import File
include('private_files/system_configure_setting.php');
function get_device_info()
{
    $isMobileDevice =  is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile"));
    if ($isMobileDevice == 1) {
        return 'Mobile & Tablet';
    } else {
        return 'Computer & Laptop';
    }
}
$device = get_device_info();
function get_browser_info()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) {
        return 'Opera';
    } elseif (strpos($user_agent, 'Edge')) {
        return 'Edge';
    } elseif (strpos($user_agent, 'Chrome')) {
        return 'Chrome';
    } elseif (strpos($user_agent, 'Safari')) {
        return 'Safari';
    } elseif (strpos($user_agent, 'Firefox')) {
        return 'Firefox';
    } elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) {
        return 'Internet Explorer';
    } else {
        return 'Other';
    }
}
$browser = get_browser_info();
date_default_timezone_set("Asia/Kolkata");
$dateObject = new DateTime(date("h:m", time()));
$time = $dateObject->format('h:i A');
$date = Date('d-M-Y');
//  Fetch current trafic count
$trafic_count = array();
$sql_fetch_trafic_record = "SELECT * FROM trafic ORDER BY trafic_id DESC";
$result_sql_fetch_trafic_record = mysqli_query($conn, $sql_fetch_trafic_record) or die("Query Failed!!");
if (mysqli_num_rows($result_sql_fetch_trafic_record) > 0) {
    while ($row_sql_fetch_trafic_record = mysqli_fetch_assoc($result_sql_fetch_trafic_record)) {
        $trafic_count[] = $row_sql_fetch_trafic_record['trafic_count'];
    }

    $newTraficCount = $trafic_count[0] + 1;
    // Insert Record
    $sql_insert_trafic_record = "INSERT INTO trafic (trafic_count, trafic_device, trafic_browser, trafic_time, trafic_date)
                             VALUES ('{$newTraficCount}','{$device}','{$browser}','{$time}','{$date}')";
    if (mysqli_query($conn, $sql_insert_trafic_record)) {
    }
}
