<?php
if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
} else {
    $id = '';
}
$sql_chitiet = mysqli_query($connect, "SELECT * FROM product WHERE ID ='$id'");
?>
<!-- page -->
<?php
while ($row_chitiet = mysqli_fetch_array($sql_chitiet)) {
?>
    <!-- Single Page -->
    <div class="banner-bootom-w3-agileits py-5">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->

            <!-- //tittle heading -->
            <div class="row">
                <div class="col-lg-5 col-md-8 single-right-left ">
                    <div class="grid images_3_of_2">
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="images/<?php echo $row_chitiet['images'] ?>">
                                    <div class="thumb-image">
                                        <img src="images/<?php echo $row_chitiet['images'] ?>" data-imagezoom="true" class="img-fluid" alt="">
                                    </div>
                                </li>


                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 single-right-left simpleCart_shelfItem">
                    <h3 class="mb-3"><?php echo $row_chitiet['Name'] ?></h3>
                    <p class="mb-3">
                        <del class="mx-2 font-weight-light"><?php echo ($row_chitiet['price']) ?></del>
                    </p>

                    <div class="product-single-w3l">
                        <p><?php echo $row_chitiet['Mô tả'] ?></p><br><br>
                    </div>
                    <div class="occasion-cart">
                        <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                            <form action="?quanly=giohang" method="post">
                                <fieldset>
                                    <input type="hidden" name="tensanpham" value="<?php echo $row_chitiet['Name'] ?>" />
                                    <input type="hidden" name="sanpham_id" value="<?php echo $row_chitiet['ID'] ?>" />
                                    <input type="hidden" name="giasanpham" value="<?php echo $row_chitiet['price'] ?>" />
                                    <input type="hidden" name="hinhanh" value="<?php echo $row_chitiet['images'] ?>" />
                                    <input type="hidden" name="soluong" value="1" />
                                    <input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button" />
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //Single Page -->
<?php
}
?>