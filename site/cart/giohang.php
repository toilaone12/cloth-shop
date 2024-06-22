<?php
    if(isset($_COOKIE['customer_login']) && $_COOKIE['customer_login']){
        $customer = json_decode($_COOKIE['customer_login'],true);
        $select = $connect->query("SELECT * FROM shopping_cart WHERE user_id = ".$customer['ID']);
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
                    <h4>Giỏ hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <a href="">Cửa hàng</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
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
                                while($row = $select->fetch_assoc()){
                                    $selectProduct = $connect->query("SELECT * FROM product WHERE ID = ".$row['product_id']);
                                    $rowProduct = $selectProduct->fetch_assoc();
                                    $subtotal = $rowProduct['price'] * $row['quantity'];
                                    $total += $subtotal;
                            ?>
                            <tr>
                                <td class="product__cart__item" data-id="<?=$row['id']?>">
                                    <div class="product__cart__item__pic">
                                        <img src="../admin/images/<?=$rowProduct['images']?>" style="object-fit: contain;" width="90" height="90" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6><?=$rowProduct['Name']?></h6>
                                        <h5><?=number_format($rowProduct['price'],0,',','.')?> đ</h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2">
                                            <input type="text" class="quantity-cart" data-id="<?=$row['id']?>" value="<?=$row['quantity']?>">
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price"><?=number_format($subtotal,0,',','.')?> đ</td>
                                <td class="cart__close cursor-pointer delete-cart" data-id="<?=$row['id']?>"><i class="fa fa-close mr-2"></i></td>
                                <td class="cart__close cursor-pointer update-cart" data-id="<?=$row['id']?>"><i class="fa fa-spinner"></i></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="index.php">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Tổng tiền giỏ hàng</h6>
                    <ul>
                        <li>Tổng tiền <span><?=number_format($total,0,',','.')?> đ</span></li>
                    </ul>
                    <a href="?page_layout=checkout" class="primary-btn">Kiểm tra đơn hàng</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->