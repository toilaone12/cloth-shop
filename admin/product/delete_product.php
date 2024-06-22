<?php
ob_start();


if (isset($_GET["ID"])) {
    $ID = $_GET["ID"];

    $sqlDeleteProduct = "DELETE FROM product WHERE ID = ?";
    $result = $connect->prepare($sqlDeleteProduct);
    $result->bind_param("i", $ID); //được sử dụng để gán giá trị cho các tham số trong câu lệnh SQL đã được chuẩn bị trên. 
    $result->execute(); // nếu thự thi thành công thì  $result->execute(); trả về true của false
    $result->close(); // được sử dụng để đóng đối tượng kết quả sau khi bạn đã hoàn thành việc thực thi một truy vấn SQL 

    // chuyển hướng sau khi xóa
    header('location: /Ani_Fashion/admin/index.php?page_layout=product.php');
    exit; //Đảm bảo tập lệnh dừng thực thi sau khi chuyển hướng
}
