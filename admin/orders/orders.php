<?php
if ($connect) {
    $sqlGetOrders = "SELECT * FROM orders";
    $queryGetOrders = mysqli_query($connect, $sqlGetOrders);
}
?>
<?php
$product = mysqli_query($connect, "SELECT product.*, category.name AS 'Name' FROM product JOIN category ON product.ID = category.ID");

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
            <li class="active">Quản lý đơn hàng</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý đơn hàng</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table">

                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Ngày thay đổi đơn</th>
                                <th scope="col">Phương thức</th>
                                <th scope="col">Tình trạng đơn</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 0;
                            while ($orders = mysqli_fetch_assoc($queryGetOrders)) {
                                $id++;
                            ?>
                                <tr>
                                    <td class=""><?php echo $id ?></td>
                                    <td class=""><?php echo $orders['fullname'] ?></td>
                                    <td class=""><?php echo $orders['phone'] ?></td>
                                    <td class=""><?php echo $orders['address'] ?></td>
                                    <td class="" width="150"><?php echo number_format($orders['total'],0,',','.') ?> đ</td>
                                    <td class=""><?php echo date('d/m/Y',strtotime($orders['order_date'])) ?></td>
                                    <td class=""><?php echo $orders['payment'] ?></td>
                                    <td class="">
                                        <?php if ($orders['status'] == 0) { ?>
                                            <span class="label btn-warning">Chưa nhận đơn</span>
                                        <?php } else if ($orders['status'] == 1) { ?>
                                            <span class="label btn-warning">Đã nhận đơn</span>
                                        <?php } else if ($orders['status'] == 2) { ?>
                                            <span class="label btn-warning">Đang vận chuyển đơn</span>
                                        <?php } else if ($orders['status'] == 3) { ?>
                                            <span class="label btn-success">Giao đơn thành công</span>
                                        <?php } else if ($orders['status'] == 4) { ?>
                                            <span class="label btn-danger">Đã hủy đơn</span>
                                        <?php } ?>
                                    </td>
    
                                    <td class="form-group">
                                        <a href="?page_layout=order_detail.php&id=<?php echo $orders['id'] ?>" class="btn btn-primary" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-pencil"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $id++;
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#">&laquo;</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">&raquo;</a>
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