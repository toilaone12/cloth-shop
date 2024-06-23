<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']){
    $customer = json_decode($_COOKIE['customer_login'],true);
    $select = $connect->query("SELECT * FROM shopping_cart WHERE user_id = ".$customer['ID']);
    if(isset($_POST['order'])){
        $code = 'CODE'.rand(0000,9999);
        $order = [
            'id_customer' => $customer['ID'],
            'fullname' => $_POST['fullname'],
            'code' => $code,
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'note' => $_POST['note'] ? $_POST['note'] : '',
            'total' => $_POST['total'],
            'payment' => $_POST['payment'] == 'vnpay' ? 'Thanh toán bằng VNPAY' : 'Thanh toán khi nhận hàng',
        ];
        $_SESSION['order'] = $order;
        if($_POST['payment'] == 'vnpay'){
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = 'http://localhost/Ani_Fashion/site/index.php?page_layout=handle_order';
            $vnp_TmnCode = "O6QNEUV1"; //Website ID in VNPAY System
            $vnp_HashSecret = "KUVQBFF9UFQV01SB11MGF0QLARLXNJNJ"; //Secret key
            $vnp_TxnRef = $code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán bằng VNPAY';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $_POST['total'] * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            // Billing
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            $_POST['redirect'] = 'access';

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //Mã hóa dữ liệu
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            $returnData = array(
                'code' => '00',
                'message' => 'success',
                'data' => $vnp_Url
            );

            header("Location: " . $vnp_Url);
            // if ($code != "") {
            //     die();
            // } else {
            //     echo json_encode($returnData);
            // }
        }else{
            header("Location: index.php?page_layout=handle_order");
        }
    }
}else{
    header("Location: index.php");
}
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Kiểm tra đơn hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <a href="">Cửa hàng</a>
                        <span>Kiểm tra đơn hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form method="POST">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Thông tin đặt hàng</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Họ và tên<span>*</span></p>
                                    <input type="text" required name="fullname" placeholder="Họ tên">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Email<span>*</span></p>
                            <input type="email" required placeholder="Email" name="email">
                        </div>
                        <div class="checkout__input">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="number" required min="0" name="phone" placeholder="Số điện thoại">
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" required placeholder="Địa chỉ" name="address" class="checkout__input__add">
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú</p>
                            <input type="text" name="note" placeholder="Ghi chú">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                            <ul class="checkout__total__products">
                                <?php
                                    $total = 0;
                                    while($row = $select->fetch_assoc()){
                                        $selectProduct = $connect->query("SELECT * FROM product WHERE ID = ".$row['product_id']);
                                        $rowProduct = $selectProduct->fetch_assoc();
                                        $subtotal = $rowProduct['price'] * $row['quantity'];
                                        $total += $subtotal;
                                ?>
                                <li><?=$rowProduct['Name']?> (x<?=$row['quantity']?>) <span><?=number_format($subtotal,0,',','.')?> đ</span></li>
                                <?php } ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Thành tiền <span><?=number_format($total,0,',','.')?> đ</span></li>
                                <li>Tổng tiền <span><?=number_format($total,0,',','.')?> đ</span></li>
                            </ul>
                            <div class="shop__sidebar__size">
                                <label for="money" class="">Thanh toán khi nhận hàng
                                    <input type="radio" id="money" name="payment" value="money">
                                </label>
                                <label for="vnpay" class="">Thanh toán bằng VNPAY
                                    <input type="radio" id="vnpay" name="payment" value="vnpay">
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc-or">
                                Tôi đã đọc và chấp nhận các điều khoản & điều kiện
                                    <input type="checkbox" required name="terms" id="acc-or">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <input type="hidden" name="total" value="<?=$total?>">
                            <button type="submit" class="site-btn" name="order">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->