<?php
// truy vấn lấy dữ liệu từ bảng product trong admin
include_once "important/connect.php";

// Truy vấn dữ liệu từ bảng product
if(isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']){
    $customer = json_decode($_COOKIE['customer_login'],true);
    $select = $connect->query("SELECT * FROM shopping_cart WHERE user_id = ".$customer['ID']);
}else{
    header("Location: index.php");
}
if(isset($_GET['page_layout']) && $_GET['page_layout']){
    $title = '';
    if($_GET['page_layout'] == 'info'){
        $title = 'Thông tin cá nhân';
    }else if($_GET['page_layout'] == 'password'){
        $title = 'Thay đổi mật khẩu';
    }else if($_GET['page_layout'] == 'order'){
        $title = 'Đơn hàng của tôi';
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
                            <div class="col-lg-8">
                                <?php
                                    if($_GET['page_layout'] == 'info'){
                                ?>
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6">
                                            <h6 class="checkout__title">Thông tin cá nhân</h6>
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
                                            <button type="submit" class="site-btn" name="update-info">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                    }else if($_GET['page_layout'] == 'password'){
                                ?>
                                <?php
                                    }else if($_GET['page_layout'] == 'order'){
                                        $title = 'Đơn hàng của tôi';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->