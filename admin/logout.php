<?php
include('private_files/system_configure_setting.php');
session_start();
session_unset();
session_destroy();
echo "<script>window.location.href='https://cibadress.com/app/project.dev'</script>";
