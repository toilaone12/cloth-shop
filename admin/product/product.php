<?php
if ($connect) {

    $sqlGetProduct = "SELECT * FROM product";
    $queryGetProduct = mysqli_query($connect, $sqlGetProduct);
}
?>
<?php
//phân trang danh mục
if (isset($_GET['page'])) { // kiểm tra sự tồn tại của danh mục
    $page = $_GET['page'];
} else {
    $page = 1; //trường hợp truy cập danh scahs danh mục đầu tiên
}
$rowsPerPage = 2;
$PerRow = $page * $rowsPerPage - $rowsPerPage;
$sqlGetProduct = "SELECT * FROM product ORDER BY ID ASC LIMIT $PerRow,$rowsPerPage";
$queryGetProduct = mysqli_query($connect, $sqlGetProduct);
// để xây dựng thanh phân trang thì tính tổng số danh mục trong csdl chia cho số danh mục trên 1 trang có lẻ thì làm tròn á bây -->
// biến tổng số bản ghi sau đó thực thi câu truy vấn lấy toàn bộ trong danh mục sản phẩm
$totalRow = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product"));
//biến tổng số trang
$totalPage = ceil($totalRow / $rowsPerPage); //ceil là để làm tròn
$listPage = "";
for ($i = 1; $i <= $totalPage; $i++) {
    if ($page == $i) {
        // nối chuỗi = cái trang hiện hành
        $listPage .= '<li class="active"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
    } else {
        //= cái trang k có active
        $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
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
            <li class="active">Danh sách sản phẩm</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="?page_layout=add_products.php" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
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
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Ảnh sản phẩm</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Hành động</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;
                            while ($product = mysqli_fetch_assoc($queryGetProduct)) {

                            ?>
                                <tr>
                                    <td class=""><?php echo $id ?></td>
                                    <td class=""><?php echo $product['Name'] ?></td>
                                    <td class=""><?php echo $product['price'] ?>VNĐ</td>
                                    <td class=""><img width="100" height="150" value="" src="/Ani_Fashion/admin/images/<?php echo $product['images'] ?>"></td>
                                    <td class=""><?php
                                                    if ($product['status']) {  ?>
                                            <button type="button" class="btn btn-success btn-sm">Còn Hàng</button>
                                        <?php  } else { ?>
                                            <button type="button" class="btn btn-primary btn-sm">Hết Hàng </button>
                                        <?php
                                                    }
                                        ?>
                                    <td class="">
                                        <?php
                                        $sqlGetCategory = "SELECT * FROM category where ID = {$product['category_ID']}";
                                        // Thực hiện truy vấn để lấy tên của các danh mục
                                        $queryGetCategory = mysqli_query($connect, $sqlGetCategory);
                                        // Kiểm tra nếu truy vấn thành công
                                        if ($queryGetCategory) {
                                            $result = mysqli_fetch_all($queryGetCategory, MYSQLI_ASSOC);
                                            foreach ($result as $cate) {
                                                echo $cate["Name"];
                                            }
                                        } else {
                                            echo "Query failed: " . mysqli_error($connect);
                                        }


                                        ?>

                                    </td>

                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_product.php&ID=<?php echo $product['ID'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="index.php?page_layout=delete_product.php&ID=<?php echo $product['ID'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            <?php $id++;
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="index.php?page_layout=product&page=<?php echo $page - 1; ?>">&laquo;</a>
                            </li>
                            <?php echo $listPage; ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?page_layout=product&page=<?php echo $page + 1; ?>">&raquo;</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>

<!--/.main -->