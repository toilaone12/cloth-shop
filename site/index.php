<?php
session_start();
ob_start();
include_once "./important/connect.php";

include_once "./important/header.php";
?>
<?php
// hiern thị trang hoạt động
if (isset($_GET['page_layout'])) {
    $page = $_GET['page_layout'];
    switch ($page) {
        case 'chitietsanpham':
            include_once('page/chitietsanpham.php');
            break;
        case 'chitiet':
            include_once('./page/chitiet.php');
            break;
        case 'danhmuc':
            include_once('page/danhmuc.php');
            break;
        case 'cart':
            include_once('./cart/giohang.php');
            break;
        case 'gioithieu':
            include_once('gioithieu.php');
            break;
        case 'checkout':
            include_once('./order/checkout.php');
            break;
        case 'handle_order':
            include_once('./order/handle_order.php');
            break;
        case 'login': 
            header("Location: login.php");
            break;
        default:
            include_once "./page/home.php";
            break;
    }
} else {
    include_once "./page/home.php";
}
include_once "./important/footer.php";

?>