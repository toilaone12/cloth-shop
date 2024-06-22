<?php
session_start();
if (isset($_SESSION['user_login'])) {
    unset($_SESSION['user_login']);
}
echo json_encode($_SESSION);
header('Location:login.php'); // nếu bản ghi đã tồn tại thì chuyển sang file user.php