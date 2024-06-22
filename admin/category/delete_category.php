<?php
// ob_start();

// require "connect.php";
// if(isset($_GET["ID"])){
//     $ID = $_GET["ID"];
//     $sqlGetCategory = "DELETE FROM category SET Name='" .$_POST['name_up']."' WHERE  ID= '".$_GET['ID']."'";
//     $queryGetCategory = mysqli_query($connect, $sqlGetCategory);
//     header('location:/Ani_Fashion/admin/index.php?page_layout=category.php');
//     if(isset($_GET['ID'])){
//         $ID = $connect->real_escape_string($_GET['ID']);
//         //truy vấm để lấy thông tin danh mục dựa trên ID
//         $query = "DELETE FROM category WHERE ID = $ID";
//         $result = $connect->query($query);
//     }        
// }
?>
<?php
ob_start();


if(isset($_GET["ID"])) {
    $ID = $_GET["ID"];
    
    $sqlDeleteCategory = "DELETE FROM category WHERE ID = ?";
    $result = $connect->prepare($sqlDeleteCategory);
    $result->bind_param("i", $ID); //được sử dụng để gán giá trị cho các tham số trong câu lệnh SQL đã được chuẩn bị trên. 
    $result->execute(); // nếu thự thi thành công thì  $result->execute(); trả về true của false
    $result->close(); // được sử dụng để đóng đối tượng kết quả sau khi bạn đã hoàn thành việc thực thi một truy vấn SQL 

    // chuyển hướng sau khi xóa
    header('location: /Ani_Fashion/admin/index.php?page_layout=category.php');
    exit; //Đảm bảo tập lệnh dừng thực thi sau khi chuyển hướng
}
?>