<?php
// truy vấn lấy dữ liệu từ bảng product trong admin
include_once "important/connect.php";

// Truy vấn dữ liệu từ bảng product
if(isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']){
    $customer = json_decode($_COOKIE['customer_login'],true);
    $user = $connect->query("SELECT * FROM users WHERE ID = ".$customer['ID']." LIMIT 1");
    $one = $user->fetch_assoc();
}else{
    header("Location: index.php");
}
if(isset($_GET['page_layout']) && $_GET['page_layout']){
    $title = '';
    if($_GET['page_layout'] == 'info'){
        $title = 'Thông tin cá nhân';
        if(isset($_POST['update-info'])){
            $fullname = $connect->real_escape_string($_POST['fullname']);
            $email = $connect->real_escape_string($_POST['email']);
            $update = $connect->query("UPDATE users SET Name = '$fullname', Email = '$email' WHERE ID = ".$customer['ID']);
            if($update) {
                $mess = '<p class="text-success small">Thay đổi tài khoản thành công</p>';
            }else{
                $mess = '<p class="text-danger small">Thay đổi tài khoản thất bại</p>';
            }
        }
    }else if($_GET['page_layout'] == 'password'){
        $title = 'Thay đổi mật khẩu';
        if(isset($_POST['update-password'])){
            $password = $connect->real_escape_string($_POST['password']);
            $repassword = $connect->real_escape_string($_POST['repassword']);
            if($password == $repassword){
                $update = $connect->query("UPDATE users SET password = '$repassword' WHERE ID = ".$customer['ID']);
                if($update) {
                    $mess = '<p class="text-success small">Thay đổi mật khẩu thành công</p>';
                }else{
                    $mess = '<p class="text-danger small">Thay đổi mật khẩu thất bại</p>';
                }
            }else{
                $mess = '<p class="text-danger small">Mật khẩu không trùng khớp</p>';
            }
        }
    }else if($_GET['page_layout'] == 'order'){
        $title = 'Đơn hàng của tôi';
        $orders = $connect->query("SELECT * FROM orders WHERE user_id = ".$customer['ID']);
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
                    <h4><?=$title?></h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <span><?=$title?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="product__details__pic">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <a href="?page_layout=info" class="d-block mb-3 btn btn-secondary <?=$_GET['page_layout'] == 'info' ? 'active' : ''?>">Thông tin cá nhân</a>
                                <a href="?page_layout=password" class="d-block mb-3 btn btn-secondary <?=$_GET['page_layout'] == 'password' ? 'active' : ''?>">Đổi mật khẩu</a>
                                <a href="?page_layout=order" class="d-block mb-3 btn btn-secondary <?=$_GET['page_layout'] == 'order' ? 'active' : ''?>">Đơn hàng của tôi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 mb-5">
                <div class="product__details__content">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <?php
                                if($_GET['page_layout'] == 'info'){
                            ?>
                            <div class="col-lg-8">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6">
                                            <?php
                                                if(isset($mess) && $mess){
                                                    echo $mess;
                                                    $mess = '';
                                                    unset($mess);
                                                }
                                            ?>
                                            <h6 class="checkout__title">Thông tin cá nhân</h6>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="checkout__input">
                                                        <p>Họ và tên<span>*</span></p>
                                                        <input type="text" required name="fullname" value="<?=$one['Name']?>" placeholder="Họ tên">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkout__input">
                                                <p>Email<span>*</span></p>
                                                <input type="email" required placeholder="Email" value="<?=$one['Email']?>" name="email">
                                            </div>  
                                            <button type="submit" class="site-btn" name="update-info">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                                }else if($_GET['page_layout'] == 'password'){
                            ?>
                            <div class="col-lg-8">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6">
                                            <?php
                                                if(isset($mess) && $mess){
                                                    echo $mess;
                                                    $mess = '';
                                                    unset($mess);
                                                }
                                            ?>
                                            <h6 class="checkout__title">Đổi mật khẩu</h6>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="checkout__input">
                                                        <p>Tên đăng nhập<span>*</span></p>
                                                        <input type="text" required name="username" disabled value="<?=$one['Email']?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkout__input">
                                                <p>Mật khẩu<span>*</span></p>
                                                <input type="password" required placeholder="Mật khẩu" name="password">
                                            </div>
                                            <div class="checkout__input">
                                                <p>Nhập lại mật khẩu<span>*</span></p>
                                                <input type="password" required placeholder="Nhập lại mật khẩu" name="repassword">
                                            </div>    
                                            <button type="submit" class="site-btn" name="update-password">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                                }else if($_GET['page_layout'] == 'order'){
                            ?>
                            <div class="col-lg-12">
                                <?php
                                    while($order = $orders->fetch_assoc()){
                                ?>
                                <div class="card bg-secondary mb-3">
                                    <div class="col-lg-12 my-3">
                                        <div class="d-flex align-items-baseline justify-content-between mb-2">
                                            <h3 class="text-light">Đơn hàng #<?=$order['code']?></h3>
                                            <?php if ($order['status'] == 0 || $order['status'] == 1 || $order['status'] == 2){ ?>
                                                <div class="badge badge-warning text-light"><?= $order['status'] == 0 ? 'Đang chờ nhận đơn' : ($order['status'] == 1 ? 'Đã nhận đơn' : 'Đang giao đơn') ?></div>
                                            <?php }elseif ($order['status'] == 3){ ?>
                                                <div class="badge badge-success text-light">Giao thành công</div>
                                            <?php }else{?>
                                                <div class="badge badge-danger text-light">Đã hủy đơn</div>
                                            <?php } ?>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-light">Người đặt: <?= $order['fullname'] ?></p>
                                            <p class="text-light">Tổng tiền: <?= number_format($order['total'],0,',','.') ?> đ (Đã bao gồm phụ phí)</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-light">Phương thức thanh toán: <?= $order['payment'] ?></p>
                                        </div>
                                        <a href="?page_layout=order_detail&id=<?=$order['id']?>" class="btn btn-info">Xem chi tiết</a>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->