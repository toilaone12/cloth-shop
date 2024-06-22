<?php
if ($connect) {
    $sqlGetCategory = "SELECT * FROM category";
    $queryGetCategory = mysqli_query($connect, $sqlGetCategory);
    if (isset($_GET['ID'])) {
        $IsDeleted = "UPDATE category SET IsDeleted = 1 WHERE  ID= '" . $_GET['ID'] . "'";
        $IsDeleted = $connect->query($IsDeleted);
        header('location:/Ani_Fashion/admin/index.php?page_layout=category.php');
    }
}
?>
<?php
// phân trang danh mục nè


//index.php?page_layout=category
//index.php?page_layout=category&page=1or2or2...
// trang 1 | 0 - 4 | select * from category limit 0,5 ... 1 trang hiển thị 5 danh mục á bây
//$rowsPerPage=5 biến thể hiện số danh mục hiển thị trên mỗi trang
//$Page  //trang hiện hành đang xem trag 1 là 1 ..
//$PerRow = $Page*$rowsPerPage-$rowsPerPage 
//test công thức = trang 1 * row = 5 - row = 5 = 0 đúng với csdl
if (isset($_GET['page'])) { // kiểm tra sự tồn tại của danh mục
    $page = $_GET['page'];
} else {
    $page = 1; //trường hợp truy cập danh scahs danh mục đầu tiên
}
$rowsPerPage = 5;
$PerRow = $page * $rowsPerPage - $rowsPerPage;
$sqlGetCategory = "SELECT * FROM category ORDER BY ID ASC LIMIT $PerRow,$rowsPerPage";
$queryGetCategory = mysqli_query($connect, $sqlGetCategory);
// để xây dựng thanh phân trang thì tính tổng số danh mục trong csdl chia cho số danh mục trên 1 trang có lẻ thì làm tròn á bây -->
// biến tổng số bản ghi sau đó thực thi câu truy vấn lấy toàn bộ trong danh mục sản phẩm
$totalRow = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM category"));
//biến tổng số trang
$totalPage = ceil($totalRow / $rowsPerPage); //ceil là để làm tròn
$listPage = "";
for ($i = 1; $i <= $totalPage; $i++) {
    if ($page == $i) {
        // nối chuỗi = cái trang hiện hành
        $listPage .= '<li class="active"><a class="page-link" href="index.php?page_layout=category&page=' . $i . '">' . $i . '</a></li>';
    } else {
        //= cái trang k có active
        $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page=' . $i . '">' . $i . '</a></li>';
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
            <li class="active">Quản lý danh mục</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý danh mục</h1>
        </div>
    </div>
    <div id="toolbar" class="btn-group">
        <a href="?page_layout=add_category.php" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm danh mục
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
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;
                            while ($category = mysqli_fetch_assoc($queryGetCategory)) {


                            ?>
                                <tr>
                                    <td class=""><?php echo $id ?></td>
                                    <td class=""><?php echo $category['Name'] ?></td>

                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_category.php&ID=<?php echo $category['ID'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="index.php?page_layout=delete_category.php&ID=<?php echo $category['ID'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $id++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- thanh phân trang  -->
    <div class="panel-footer">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="index.php?page_layout=category&page=<?php echo $page - 1; ?>">&laquo;</a>
                </li>
                <?php echo $listPage; ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page_layout=category&page=<?php echo $page + 1; ?>">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
</div>