<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Bộ sưu tập mùa hè</h6>
                            <h2>Bộ sưu tập thu đông năm 2024</h2>
                            <p>Một thương hiệu chuyên biệt tạo ra các sản phẩm thiết yếu sang trọng. Được chế tác một cách có đạo đức với cam kết không lay chuyển đối với chất lượng xuất sắc.</p>
                            <a href="#" class="primary-btn">Xem ngay <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Bộ sưu tập mùa hè</h6>
                            <h2>Bộ sưu tập thu đông năm 2024</h2>
                            <p>Một thương hiệu chuyên biệt tạo ra các sản phẩm thiết yếu sang trọng. Được chế tác một cách có đạo đức với cam kết không lay chuyển đối với chất lượng xuất sắc.</p>
                            <a href="#" class="primary-btn">Xem ngay <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<?php 
    // random danh mục bất kỳ
    $resultAllProduct = $connect->query('SELECT * FROM product WHERE status = 1 ORDER BY ID DESC LIMIT 8');
?>
<!-- Product Section Begin -->
<section class="product spad mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Tất cả sản phẩm</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php
                while($rowAllProduct = $resultAllProduct->fetch_assoc()){
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="../admin/images/<?=$rowAllProduct['images']?>">
                        <span class="label">Mới nhất</span>
                    </div>
                    <div class="product__item__text">
                        <h6>Sản phẩm: <?=$rowAllProduct['Name']?></h6>
                        <div class="d-flex">
                            <a class="add-cart cursor-pointer" data-id="<?=$rowAllProduct['ID']?>">+ Thêm vào giỏ hàng</a>
                            <a href="?page_layout=chitietsanpham&id=<?=$rowAllProduct['ID']?>" class="cursor-pointer" style="left: 68%;top: 23px;">Xem chi tiết</a>
                        </div>
                        <h5><?=number_format($rowAllProduct['price'],0,',','.')?> đ</h5>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Instagram Section Begin -->
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-1.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-2.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-3.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-4.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-5.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-6.jpg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section End -->
