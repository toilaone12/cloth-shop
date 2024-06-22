<?php
include_once "../important/connect.php";
$connect = doConnection();
if (is_object($connect)) {
    if (isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']) {
        header('Content-Type: application/json');
        $id = isset($_POST['id']) && $_POST['id'] ? intval($_POST['id']) : 0;
        $quantity = isset($_POST['quantity']) && $_POST['quantity'] ? intval($_POST['quantity']) : 0;
        $id_customer = isset($_POST['id_customer']) && $_POST['id_customer'] ? intval($_POST['id_customer']) : 0;
        $selectCart = $connect->query("SELECT * FROM shopping_cart WHERE id = $id AND user_id = $id_customer LIMIT 1");
        $rowSelectCart = $selectCart->fetch_assoc();
        $update = $connect->query("UPDATE shopping_cart SET `quantity` = $quantity WHERE id = ".$rowSelectCart['id']);
        if($update) {
            echo json_encode(['res' => 'success']);
            exit;
        }else{
            echo json_encode(['res' => 'error','text' => "Có vấn đề truy vấn"]);
            exit;
        }
    } else {
        header('Location: login.php');
        exit;
    }
}
