<?php
include_once "connect.php";
// Thực hiện truy vấn SQL để lấy dữ liệu từ bảng "category"
$connect = doConnection();
$listCate = "SELECT * FROM category";
$result = $connect->query($listCate);
if(isset($_GET['page_layout']) && $_GET['page_layout'] == 'logout'){
    setcookie('customer_login', '', time() - 3600, '/');
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ani Fashion</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+MX:wght@100..400&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>

<body>
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="?page_layout=login">Đăng nhập</a>
                <a href="#">FAQs</a>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Miễn phí vận chuyển, đảm bảo hoàn trả hàng trong vòng 30 ngày.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Miễn phí vận chuyển, đảm bảo hoàn trả hàng trong vòng 30 ngày.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <?php
                                    if(isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']){
                                        $customer = json_decode($_COOKIE['customer_login'],true);
                                        $user = $connect->query("SELECT * FROM users WHERE ID = ".$customer['ID']." LIMIT 1");
                                        $one = $user->fetch_assoc();
                                ?>
                                <a href="?page_layout=info" class="text-light"><?=$one['Name']?></a>
                                <a href="?page_layout=logout" class="text-light">Đăng xuất</a>
                                <?php
                                    }else{
                                ?>
                                <a href="?page_layout=login">Đăng nhập</a>
                                <?php
                                    }
                                ?>
                                <a href="#">FAQs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="index.php"><span class="font-playwriter logo-style text-dark">Ani Fashion</span></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="index.php">Trang chủ</a></li>
                            <li><a href="#">Danh mục</a>
                                <ul class="dropdown">
                                    <?php
                                        while($row = $result->fetch_assoc()){
                                    ?>
                                    <li><a href="?page_layout=category&id=<?=$row['ID']?>"><?=$row['Name']?></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Giới thiệu</a></li>
                            <li><a href="./contact.html">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                        <?php
                        if(isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']){
                            $customer = json_decode($_COOKIE['customer_login'],true);
                            $select = $connect->query("SELECT * FROM shopping_cart WHERE user_id = ".$customer['ID']);
                            $count = $select->num_rows;
                        ?>
                        <a href="?page_layout=cart "><img src="img/icon/cart.png" alt=""> <span class="number-cart"><?=$count?></span></a>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->