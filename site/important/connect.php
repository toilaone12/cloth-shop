<?php
// gọi 4 tên của csdl:
//server
//tên dăng nhập user giúp truy cập thẳng vào csdl mà k cần nhập 
//mật khẩu truy cập 
//tên database 
// tạo ra 1 biến để kết nối với 4 csdl trên sau đó gọi lần lượt 4 dữ liệu trên
// kiểm tra xem đã kết nối hay ch

function doConnection(): mysqli
{
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'ani_fashions';
    // Thực hiện các thao tác để kết nối đến cơ sở dữ liệu
    // $connect = mysqli_connect($server, $username, $password, $database);
    // if ($connect) {
    //     //nếu kết nối thành công thì in ra thông báo đã kết nối .
    //     //sử dụng hàm để kết nối tiếp
    //     //mysqLi_query($connect, "set names 'utf8' ");
    //     // echo 'Đã kết nối thành công';
    // } else {
    //     //nếu kết nối k thành công thì in ra thông báo kết nối thất bại .
    //     die('Không thể kết nối đến cơ sở dữ liệu: ' . mysqLi_connect_error());
    // }
    // return $connect;
    try {
        $connect = new mysqli($server, $username, $password, $database);
        // if ($connect) {
        //     die("ok");
        // } else {
        //     die("Not ok");
        // }
        return $connect;
        //code...
    } catch (\Throwable $th) {
        //throw $th;
        return false;
    };
}
