<?php
if ($connect) {
    if(isset($_GET['id']) && $_GET['id']){
        $order = $connect->query("SELECT * FROM orders WHERE id = ".$_GET['id']);
        $detail = $connect->query("SELECT * FROM orders_detail WHERE id_order = ".$_GET['id']);
        if($detail->num_rows){
            $list = $detail;
            $one = $order->fetch_assoc();
            if(isset($_GET['status']) && $_GET['status']){
                $update = $connect->query("UPDATE orders SET status = ".$_GET['status'].", order_date = '".date("Y-m-d")."' WHERE id = ".$_GET['id']);
                if($update){
                    header("Location: ?page_layout=order_detail.php&id=".$_GET['id']);
                    exit;
                }
            }
        }else{
            header("Location: ?page_layout=orders");
            exit;
        }
    }else{
        header("Location: ?page_layout=orders");
        exit;
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
            <li class="active">Chi tiết đơn hàng</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Chi tiết đơn hàng</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="d-flex justify-content-between border-bottom">
                        <div class="">
                            <h4>Thông tin mua hàng</h4>
                            <p>Họ tên người mua: <?=$one['fullname']?></p>
                            <p>Số điện thoại: <?=$one['phone']?></p>
                            <p>Địa chỉ: <?=$one['address']?></p>
                            <p>Ghi chú: <?=$one['note']?></p>
                            <p>Ngày cập nhật đơn: <?php echo date('d/m/Y',strtotime($one['order_date'])) ?></p>
                            <p>
                                Tình trạng đơn: 
                                <span class="btn <?php echo $one['status'] == 0 || $one['status'] == 1 || $one['status'] == 2 ? 'btn-warning' : ($one['status'] == 3 ? 'btn-success' : 'btn-danger') ?>">
                                    <?php echo $one['status'] == 0 ? 'Chưa nhận đơn' : ($one['status'] == 1 ? 'Đang nhận đơn' : ($one['status'] == 2 ? 'Đang giao đơn' : ($one['status'] == 3 ? 'Giao thành công' : 'Đã hủy đơn'))) ?>
                                </span>
                            </p>
                        </div>
                        <div class="">
                            <h4>Chức năng</h4>
                            <a href="?page_layout=order_detail.php&id=<?=$one['id']?>&status=1" class="<?=$one['status'] == 3 || $one['status'] == 4 ? 'disabled' : ''?> btn btn-warning d-block mb-2">Nhận đơn</a>
                            <a href="?page_layout=order_detail.php&id=<?=$one['id']?>&status=2" class="<?=$one['status'] == 3 || $one['status'] == 4 ? 'disabled' : ''?> btn btn-info d-block mb-2">Giao đơn</a>
                            <a href="?page_layout=order_detail.php&id=<?=$one['id']?>&status=3" class="<?=$one['status'] == 3 || $one['status'] == 4 ? 'disabled' : ''?> btn btn-success d-block mb-2">Giao thành công</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá tiền</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 0;
                            $total = 0;
                            while ($one = mysqli_fetch_assoc($list)) {
                                $stt++;
                                $subtotal = $one['price'] * $one['quantity'];
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td class=""><?php echo $stt ?></td>
                                    <td class=""><img src="./images/<?php echo $one['image'] ?>" width="50" height="50" alt=""></td>
                                    <td class=""><?php echo $one['name'] ?></td>
                                    <td class="">x<?php echo $one['quantity'] ?></td>
                                    <td class=""><?php echo number_format($one['price'],0,',','.') ?> đ</td>
                                    <td class=""><?php echo number_format($subtotal ,0,',','.') ?> đ</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>
<!--/.main-->