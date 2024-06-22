<?php
if(isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']){
    $order = $_SESSION['order'];
    if(isset($order) && $order){
        $code = $order['code'];
        $fullname = $order['fullname'];
        $phone = $order['phone'];
        $address = $order['address'];
        $note = $order['note'];
        $email = $order['email'];
        $total = $order['total'];
        $payment = $order['payment'];
        $date = date('Y-m-d');
        $status = 0;
        $isDelete = 0;
        $insertOrder = $connect->query("INSERT INTO orders VALUES ('','$code','$fullname','$email','$phone','$address',$total,'$note','$payment','$date',$status,$isDelete)");
        if($insertOrder){
            $idOrder = $connect->insert_id;
            $select = $connect->query("SELECT * FROM shopping_cart WHERE user_id = ".$order['id_customer']);
            $isCheck = true;
            while($row = $select->fetch_assoc()){
                $selectProduct = $connect->query("SELECT * FROM product WHERE ID = ".$row['product_id']);
                $rowProduct = $selectProduct->fetch_assoc();
                $image = $rowProduct['images'];
                $name = $rowProduct['Name'];
                $quantity = $row['quantity'];
                $price = $rowProduct['price'];
                $insertDetailOrder = $connect->query("INSERT INTO orders_detail VALUES ('',$idOrder,'$code','$image','$name','$quantity','$price')");
                if(!$insertDetailOrder){
                    $isCheck = false;
                }
            }
            // var_dump($isCheck); die;
            if($isCheck){
                $delete = $connect->query("DELETE FROM shopping_cart WHERE user_id = ".$order['id_customer']);
                if($delete){
                    unset($_SESSION['order']);
                    session_destroy();
                    header("Location: ?page_layout=cart");
                }else{
                    header("Location: ?page_layout=checkout");
                }
            }
        }
    }else{
        header("Location: ?page_layout=checkout");
    }
}else{
    header("Location: index.php");
}
?>