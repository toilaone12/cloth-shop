<?php
// truy vấn lấy dữ liệu từ bảng product trong admin
include_once "important/connect.php";

// Truy vấn dữ liệu từ bảng product
if (isset($_GET['id'])) {
    $id = $connect->real_escape_string($_GET['id']);
    //truy vấm để lấy thông tin sản phẩm dựa trên id
    $query = "SELECT * FROM product WHERE ID = $id";
    $result = $connect->query($query);
    // $NewCategory = $NewCategory->fectch_asoc;
    // Kiểm tra xem có dữ liệu trả về không
    if ($result->num_rows > 0) {
        // Lấy dữ liệu từ kết quả truy vấn
        $row = $result->fetch_assoc();

        // Hiển thị thông tin sản phẩm trên trang chi tiết
        // Thêm mã HTML để hiển thị hình ảnh sản phẩm, ví dụ: <img src='path_to_image'>
?>
<section class="breadcrumb-option mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Chi tiết sản phẩm</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <a href="">Cửa hàng</a>
                        <span>Chi tiết sản phẩm</span>
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
            <div class="col-5">
                <div class="product__details__pic">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                        <div class="product__details__pic__item">
                                            <img src="../admin/images/<?= $row['images'] ?>" width="427" height="533" style="object-fit:cover;" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="product__details__content">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8">
                                <div class="product__details__text text-left">
                                    <h4>Sản phẩm: <?= $row['Name'] ?></h4>
                                    <h3>Giá: <?= number_format($row['price'], 0, ',', '.') ?> đ</h3>
                                    <p>Mô tả: <?= $row['Mô tả'] ? $row['Mô tả'] : 'Không có' ?></p>
                                    <div class="product__details__cart__option">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" min="1" name="quantity" class="quantity-detail" value="1">
                                            </div>
                                        </div>
                                        <a class="primary-btn add-cart text-light cursor-pointer" data-id="<?=$row['ID']?>">Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-5" role="tabpanel">
                            <div class="product__details__tab__content mb-5">
                                <b><?= $row['Mô tả'] ? $row['Mô tả'] : 'Không có mô tả' ?></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->
<?php
    } else {
        header("Location: index.php");
    }
}

// Đóng kết nối
$connect->close();
?>