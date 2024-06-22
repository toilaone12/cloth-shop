<?php
include_once "../important/connect.php";
$connect = doConnection();
if (is_object($connect)) {
    if (isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']) {
        if (isset($_POST["id"])) {
            header('Content-Type: application/json');
            $id = isset($_POST['id']) && $_POST['id'] ? intval($_POST['id']) : 0;
            $delete = $connect->query("DELETE FROM shopping_cart WHERE id = $id");
            if($delete) {
                echo json_encode(['res' => 'success']);
                exit;
            }else{
                echo json_encode(['res' => 'error','text' => "Có vấn đề truy vấn"]);
                exit;
            }
        }else{
            header('Location: login.php');
            exit;
        }
    } else {
        header('Location: login.php');
        exit;
    }
}
