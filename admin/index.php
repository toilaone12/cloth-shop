<?php
// sesion khởi động nếu đăng nhập và người dùng thì tự điều hướng tới file connect.php sau đó khởi tạo connect để liên kết với connect.php
// quản lý phiên và kiểm soát đầu ra
session_start();
ob_start();

//    if(isset($_SESSION['users'])){
//     header("location: login.php");
//    }
include_once "connect.php";   // kết nối csdl
$connect = doConnection();
// unset($_SESSION);
// session_destroy();
// var_dump($_SESSION); die;
if (!isset($_SESSION['user_login'])) {
    header("Location:login.php");
}
if (!$_SESSION['user_login']['user_level']) {
    header('Location:/Ani_Fashion/site/?page_layout=index.php');
}


?>


<?php
// gọi file các phần chung
include_once "header.php";
include_once "leftside.php";
//  include_once "admin.php";

?>

<?php
// hiển thị trang hoạt động 
// sử dụng câu lệnh chuyển đổi để xác định trang nào sẽ được đưa vào dựa trên tham số `page_layout` trong URL
if (isset($_GET['page_layout'])) {
    $page = $_GET['page_layout'];
    switch (str_replace(".php", "", $page)) {
        case 'admin.php':
            include_once('admin.php');
        case 'category':
            include_once('category/category.php');
            break;
        case 'add_category':
            include_once "./category/add_category.php";
            break;
        case 'edit_category':
            include_once('./category/edit_category.php');
            break;
        case 'delete_category':
            include_once('./category/delete_category.php');
            break;

        case 'user':
            include_once('users/user.php');
            break;
        case 'add_user':
            include_once "./users/add_user.php";
            break;
        case 'edit_user':
            include_once "./users/edit_user.php";
            break;
        case 'delete_user':
            include_once "./users/delete_user.php";
            break;

        case 'orders':
            include_once './orders/orders.php';
            break;
        case 'order':
            include_once './orders/order.php';
            break;
        case 'order_detail':
            include_once "orders/order_detail.php";
            break;

        case 'product':
            include_once('product/product.php');
            break;
        case 'add_products':
            include_once "./product/add_products.php";
            break;
        case 'edit_product':
            include_once "./product/edit_products.php";
            break;
        case 'delete_product':
            include_once "./product/delete_product.php";
            break;

        default:
            include_once "admin.php";
            break;
    }
} else {
    include_once "admin.php";
    //           break;
}

?>