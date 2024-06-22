<?php
// $connect = new mysqli('localhost', 'root', '', 'ani_fashions');
// if ($connect->errno) {
//     die("connect to db fail");
// }
//laays danh muc
$sqlGetCategory = "SELECT * FROM category ORDER BY ID";
$queryGetCategory = mysqli_query($connect, $sqlGetCategory);
//them moi san pham
if (isset($_POST['sbm'])) {
    if (empty($_POST['prd_name'])) {
        $errors['prd_name_empty'] = "ten san pham khong de trong";
    } else {
        $prd_name = $_POST['prd_name'];
    }
    //validate gia san pham
    if (empty($_POST['prd_price'])) {
        $errors['prd_price_empty'] = "giá sản phẩm không để trống";
    } else {
        $prd_price = $_POST['prd_price'];
    }
    if (isset($_FILES['prd_image'])) {
        if (empty($_FILES['prd_image']['name'])) {
            $errors['prd_image'] = "ảnh sản phẩm không để trống";
        }
    } else {
        $name = $_FILES['prd_image']['name'];
        $tmp_name = $_FILES['prd_image']['tmp_name'];
        $size = $_FILES['prd_image']['size'];
        $error = $_FILES['prd_image']['error'];
        $type_image = pathinfo($name, PATHINFO_EXTENSION);
        $allowed_type = array('jpg', 'png', 'jepg');
        $max_size = 8000000;
        $isUploadimage = TRUE;
        $path_upload =  "../images/product" . $name;

        if ($error > 0) {
            $error['prd_image_error'] = "upload";
            $isUploadimage = true;
        }
        if (!in_array($type_image, $allowed_type)) {
            $error['prd_image_type'] = "chỉ được upload hình ảnh dạng jpg,png,jpeg,...";
            $isUploadimage = false;
        }
        if ($size > $max_size) {
            $error['prd_size'] = "kích thước vượt quá quy định";
            $isUploadimage = false;
        }
        if (file_exists($des_folder)) {
            $error['prd_image'][] = "file đã tồn tại";
            $isUploadimage = false;
        }
        if ($isUploadimage) {
            move_uploaded_file($tmp_name, $des_folder);
        }
    }
}

// $sqlGetProduct= "SELECT * FROM product";
// $result = $connect->query($sqlGetProduct); // thua

if (isset($_POST['sbm'])) {
    if (isset($_FILES['prd_image'])) { //tồn ại input type=file / hoặc có thuộc tính enctype trong form
        if (!empty($_FILES['prd_image']['name'])) { //nếu đã nhaapk file lên ô input type=file thì mới xử lý uploat
            $name = $_FILES['prd_image']['name'];
            $tmp_name = $_FILES['prd_image']['tmp_name'];
            $error = $_FILES['prd_image']['error'];
            $size = $_FILES['prd_image']['size'];
            if ($error > 0) {
                die("Qúa trình uploat bị lỗi");
            } else {
                move_uploaded_file($tmp_name, "./images/" . $name);
                echo "Uploat file thành công";
                $sqlGetProduct = "INSERT INTO product(Name,price,images,status,category_ID) values ('" . $_POST['prd_name'] . " ','" . $_POST['prd_price'] . " ','" . $name . " ','" . $_POST['prd_status'] . " ','" . $_POST['cat_id'] . "')";
                $queryGetProduct = $connect->query($sqlGetProduct);
                header('location:/Ani_Fashion/admin/index.php?page_layout=product.php');
            }
            // echo "<pre>";
            // print_r($_FILES);
        }
    }
}
?>




<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý sản phẩm</a></li>
            <li class="active">Thêm sản phẩm</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <?php
                                if (isset($errors['prd_name_empty'])) {
                                    echo  $errors['prd_name_empty'];
                                }
                                ?>

                                <input name="prd_name" class="form-control" placeholder="">
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <?php
                                if (isset($errors['prd_price_empty'])) {
                                    echo    $errors['prd_price_empty'];
                                }
                                ?>
                                <input name="prd_price" type="number" min="0" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="prd_status" class="form-control">
                                    <option value="1" selected>Còn hàng</option>
                                    <option value="0">Hết hàng</option>
                                </select>
                            </div>

                            <class="col-md-6">
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select name="cat_id" class="form-control">
                                        <?php
                                        $id = 1;
                                        while ($category = mysqli_fetch_assoc($queryGetCategory)) {
                                            echo '<option value =' . $category['ID'] . '>' . $category['Name'] . '</option>';
                                        ?>
                                        <?php $id++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Mô tả sản phẩm</label>
                                        <textarea required name="prd_details" class="form-control" rows="3"></textarea>
                                    </div>
                                    <a href="?page_layout=product.php"><button name="sbm" type="submit"
                                            class="btn btn-success">
                                            Thêm mới</button></a>
                                    <button type="reset" class="btn btn-default">Làm mới</button>

                                </div>

                    </div>
                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        <?php
                        if (isset($errors['prd_image'])) {
                            echo    $errors['prd_image'];
                        }
                        ?>
                        <input type="file" name="prd_image" onchange="preview();" />
                        <div>
                            <img src="<?php echo $NewProcduct['images'] ?>" alt="" id="prd_image_id" width="300"
                                height="400" />
                        </div>
                        <br>

                    </div>

                    <div class="form-group">
                        <label>Sản phẩm nổi bật</label>
                        <div class="checkbox">
                            <label>
                                <input name="prd_featured" type="checkbox" value=1>Nổi bật
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            </form>
        </div>


    </div>
</div>
</div>
</div><!-- /.col-->
</div><!-- /.row -->

</div>
<!--/.main-->
<script>
function preview() {
    prd_image_id.src = URL.createObjectURL(event.target.files[0]);
}
</script>