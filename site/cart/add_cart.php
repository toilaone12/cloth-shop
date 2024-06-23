<?php
include_once "../important/connect.php";
$connect = doConnection();
if (is_object($connect)) {
    if (isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']) {
        header('Content-Type: application/json');
        $quantity = isset($_POST['quantity']) && $_POST['quantity'] ? intval($_POST['quantity']) : 0;
        $id = isset($_POST['id']) && $_POST['id'] ? intval($_POST['id']) : 0;
        $id_customer = isset($_POST['id_customer']) && $_POST['id_customer'] ? intval($_POST['id_customer']) : 0;
        $selectCart = $connect->query("SELECT * FROM shopping_cart WHERE product_id = $id AND user_id = $id_customer LIMIT 1");
        if($selectCart->num_rows == 0){
            $insert = $connect->query("INSERT INTO shopping_cart (`quantity`,`product_id`,`user_id`) VALUES ($quantity,$id,$id_customer)");
            if($insert) {
                $select = $connect->query("SELECT * FROM shopping_cart WHERE user_id = ".$id_customer);
                $count = $select->num_rows;
                echo json_encode(['res' => 'success','text' => "Thêm vào giỏ hàng thành công", 'count' => intval($count)]);
                exit;
            }else{
                echo json_encode(['res' => 'error','text' => "Có vấn đề truy vấn thêm giỏ hàng", 'count' => '']);
                exit;
            }
        }else{
            $rowSelectCart = $selectCart->fetch_assoc();
            $quantityUpdate = $rowSelectCart['quantity'] + $quantity;
            $update = $connect->query("UPDATE shopping_cart SET `quantity` = $quantityUpdate WHERE id = ".$rowSelectCart['id']);
            if($update) {
                $select = $connect->query("SELECT * FROM shopping_cart WHERE user_id = ".$id_customer);
                $count = $select->num_rows;
                echo json_encode(['res' => 'success','text' => "Thêm vào giỏ hàng thành công", 'count' => intval($count)]);
                exit;
            }else{
                echo json_encode(['res' => 'error','text' => "Có vấn đề truy vấn cập nhật giỏ hàng", 'count' => '']);
                exit;
            }
        }
    } else {
        header('Location: login.php');
        exit;
    }
}
