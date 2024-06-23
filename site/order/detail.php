<?php
if(isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']){
    $customer = json_decode($_COOKIE['customer_login'],true);
    $id = isset($_GET['id']) && $_GET['id'] ? intval($_GET['id']) : 0;
    if($id){
        $user = $connect->query("SELECT * FROM users WHERE ID = ".$customer['ID']." LIMIT 1");
        $order = $connect->query("SELECT * FROM orders WHERE id = ".$id);
        $details = $connect->query("SELECT * FROM orders_detail WHERE id_order = ".$id);
        $one = $user->fetch_assoc();
        $order = $order->fetch_assoc();
        if(isset($_GET['status']) && $_GET['status'] == 4){
            $update = $connect->query("UPDATE orders SET status = 4, order_date = '".date("Y-m-d")."' WHERE id = ".$id);
            if($update){
                header("Location: ?page_layout=order_detail&id=".$id);
                exit;
            }
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
?>
<section class="breadcrumb-option mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Chi tiết đơn hàng #<?=$order['code']?></h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <span>Chi tiết đơn hàng #<?=$order['code']?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="row">
                    <div class="col-md-12 mb-15">
                        <div class="bg-bronde rounded p-3">
                            <div class="d-flex align-items-baseline justify-content-between mb-2">
                                <h3 class=" ">Đơn hàng #<?=$order['code']?></h3>
                                <?php if ($order['status'] == 0 || $order['status'] == 1 || $order['status'] == 2){ ?>
                                    <div class="badge badge-warning text-light"><?= $order['status'] == 0 ? 'Đang chờ nhận đơn' : ($order['status'] == 1 ? 'Đã nhận đơn' : 'Đang giao đơn') ?></div>
                                <?php }elseif ($order['status'] == 3){ ?>
                                    <div class="badge badge-success text-light">Giao thành công</div>
                                <?php }else{?>
                                    <div class="badge badge-danger text-light">Đã hủy đơn</div>
                                <?php } ?>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p>Người đặt: <?= $order['fullname']?></p>
                                <p>Thành tiền: <?= number_format($order['total'],0,',','.')?> đ </p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p>Số điện thoại: <?= $order['phone']?></p>
                                <p>Phương thức thanh toán: <?= $order['payment']?></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p>Tổng tiền: <?= number_format($order['total'],0,',','.')?> đ (Đã bao gồm phụ phí)</p>
                            </div>
                            <div class="mb-2">
                                <p>Địa chỉ nhận hàng: <?= $order['address']?></p>
                                <p>Ghi chú: <?= !$order['note'] ? 'Không có' : $order['note']?></p>
                            </div>
                            <a href="?page_layout=order_detail&id=<?=$order['id']?>&status=4" class="btn btn-danger <?=$order['status'] == 3 || $order['status'] == 4 ? 'disabled' : ''?>">Hủy đơn hàng</a>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <section class="shopping-cart">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="shopping__cart__table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Số lượng</th>
                                                        <th>Tổng tiền</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total = 0;
                                                        while($detail = $details->fetch_assoc()){
                                                            $subtotal = $detail['price'] * $detail['quantity'];
                                                            $total += $subtotal;
                                                    ?>
                                                    <tr>
                                                        <td class="product__cart__item" data-id="<?=$row['id']?>">
                                                            <div class="product__cart__item__pic">
                                                                <img src="../admin/images/<?=$detail['image']?>" style="object-fit: contain;" width="90" height="90" alt="">
                                                            </div>
                                                            <div class="product__cart__item__text">
                                                                <h6><?=$detail['name']?></h6>
                                                                <h5><?=number_format($detail['price'],0,',','.')?> đ</h5>
                                                            </div>
                                                        </td>
                                                        <td class="quantity__item">
                                                            <div class="quantity">
                                                                x <?=$detail['quantity']?>
                                                            </div>
                                                        </td>
                                                        <td class="cart__price"><?=number_format($subtotal,0,',','.')?> đ</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>