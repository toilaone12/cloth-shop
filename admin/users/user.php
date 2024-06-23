<?php

if ($connect) {
    $sqlGetUsers = "SELECT * FROM users ORDER BY user_level DESC";
    $queryGetUsers = mysqLi_query($connect, $sqlGetUsers);
}
?>
<?php
//phân trang danh mục
if (isset($_GET['page'])) { // kiểm tra sự tồn tại của danh mục
    $page = $_GET['page'];
} else {
    $page = 1; //trường hợp truy cập danh scahs danh mục đầu tiên
}
$rowsPerPage = 5;
$PerRow = $page * $rowsPerPage - $rowsPerPage;
$sqlGetUsers = "SELECT * FROM users ORDER BY user_level DESC, ID DESC LIMIT $PerRow,$rowsPerPage";
$queryGetUsers = mysqli_query($connect, $sqlGetUsers);
// để xây dựng thanh phân trang thì tính tổng số danh mục trong csdl chia cho số danh mục trên 1 trang có lẻ thì làm tròn á bây -->
// biến tổng số bản ghi sau đó thực thi câu truy vấn lấy toàn bộ trong danh mục sản phẩm
$totalRow = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM users"));
//biến tổng số trang
$totalPage = ceil($totalRow / $rowsPerPage); //ceil là để làm tròn
$listPage = "";
for ($i = 1; $i <= $totalPage; $i++) {
    if ($page == $i) {
        // nối chuỗi = cái trang hiện hành
        $listPage .= '<li class="active"><a class="page-link" href="index.php?page_layout=user&page=' . $i . '">' . $i . '</a></li>';
    } else {
        //= cái trang k có active
        $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page=' . $i . '">' . $i . '</a></li>';
    }
}

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a>
            </li>
            <li class="active">Danh sách thành viên</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách thành viên</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="?page_layout=add_user.php" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm thành viên
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Họ & Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Hành động</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;
                            while ($users = mysqli_fetch_assoc($queryGetUsers)) {


                            ?>
                                <tr>
                                    <td class=""><?php echo $id ?></td>
                                    <td class=""><?php echo $users['Name'] ?></td>
                                    <td class=""><?php echo $users['Email'] ?></td>
                                    <td class=""><?php
                                                    if ($users['user_level']) {  ?>
                                            <button type="button" class="btn btn-success btn-sm">Admin</button>
                                        <?php  } else { ?>
                                            <button type="button" class="btn btn-primary btn-sm">Member</button>

                                        <?php
                                                    }
                                        ?>
                                    </td>

                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_user.php&ID=<?php echo $users['ID'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="index.php?page_layout=delete_user.php&ID=<?php echo $users['ID'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            <?php $id++;
                            } ?>
                        </tbody>
                    </table>
                    <div class="panel-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page_layout=user&page=<?php echo $page - 1; ?>">&laquo;</a>
                                </li>
                                <?php echo $listPage; ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page_layout=user&page=<?php echo $page + 1; ?>">&raquo;</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.main-->