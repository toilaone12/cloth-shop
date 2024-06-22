<?php
// truy vấn lấy dữ liệu
if (isset($_GET['catId'])) {

    $catId = $_GET['catId'];
    $query = "SELECT * FROM category WHERE ID = $catId";
    $result = $connect->query($query);
}
if ($result->num_rows > 0) {
    // Lấy dữ liệu từ kết quả truy vấn
    $row = $result->fetch_assoc();
?>

    <div id="wp-product">
        <h2><?= $row['Name'] ?> ! Xin Chào!</h2>
        <?php
        $query = "SELECT * FROM product WHERE category_ID=$catId";
        $result = $connect->query($query);
        if ($result->num_rows > 0) {
            $products = $result->fetch_all(MYSQLI_ASSOC);
        ?>
            <div id="list-product">
                <?php
                foreach ($products as $product) :

                ?>
                    <a href="/Ani_Fashion/site/?page_layout=chitetsanpham&ID=<?= $product['ID'] ?>" class="item" style=" text-decoration: none" ;>

                        <div>
                            <img src="../admin/images/<?= $product['images'] ?>" alt="" width="250" height="350px" />

                        </div>
                        <div class="name"><?= $product['Name']  ?></div>
                        <div class="desc"></div>
                        <div class="price"><?= number_format($product['price'], 0, "", ".") ?>VNĐ</div>
                        <input style="margin-top: 4px;border-radius: 10%;padding: 4px 15px;background: #00b4ff; color: white; border:none;" type="submit" name="themgiohang" value="Add to cart" class="button" />

                    </a>
                <?php endforeach; ?>
            </div>
        <?php
        }

        ?>

        <div class="list-page">
            <div class="item">
                <a href="">1</a>
            </div>
            <div class="item">
                <a href="">2</a>
            </div>
            <div class="item">
                <a href="">3</a>
            </div>
            <div class="item">
                <a href="">4</a>
            </div>
        </div>

    <?php
}

    ?>