<?php
ob_start();
$NewProcduct = "";
if (isset($_GET['ID'])) {
    $ID = $connect->real_escape_string($_GET['ID']);
    //truy vấm để lấy thông tin danh mục dựa trên ID
    $query = "SELECT * FROM product WHERE ID = $ID";
    $result = $connect->query($query);
    // $NewCategory = $NewCategory->fectch_asoc;
    if ($result && $result->num_rows > 0) { // kiểm tra xem có tìm thấy danh mục không
        $NewProcduct = $result->fetch_assoc(); // lấy thông tin danh mục
    } else {
        // Hsử lý trường hợp k tìm thấy 
        echo "Product not found!";
    }

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
                    $prd_name = $_POST['prd_name'];
                    $prd_price = $_POST['prd_price'];
                    $prd_status = $_POST['prd_status'];
                    $cat_id = $_POST['cat_id'];

                    $sqlGetProduct = "UPDATE product set Name = '$prd_name', price = '$prd_price',images = '$name' ,status = '$prd_status',category_ID = '$cat_id' where ID= '" . $_GET['ID'] . "'";
                    $queryGetProduct = $connect->query($sqlGetProduct);
                    header('location:/Ani_Fashion/admin/index.php?page_layout=product.php');
                }
            }
        }
    }
}
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a>
            </li>
            <li><a href="">Quản lý sản phẩm</a></li>
            <li class="active">Sản phẩm số 1</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sản phẩm: Sản phẩm số 1</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <class="panel panel-default>
                <div class="panel-body">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="prd_name" required class="form-control" value="<?php echo $NewProcduct['Name'] ?>" placeholder="" />
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="number" value="<?php echo $NewProcduct['price'] ?>" name="prd_price" required value="" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select VALUE="<?php echo $NewProcduct['status'] ?>" name="prd_status" class="form-control">
                                    <option selected value="1">Còn hàng</option>
                                    <option value="2">Hết hàng</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select value="<?php echo $NewProcduct['category_ID'] ?>" name="cat_id" class="form-control">
                                    <option selected value="1">Dior</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea name="prd_details" required class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">
                                Cập nhật
                            </button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>


                        <div class="col-md-6">
                            <class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input type="file" name="prd_image" onchange="preview();" />
                                <div>
                                    <img src="./images/<?php echo $NewProcduct['images'] ?>" alt="" id="prd_image_id" width="300" height="400" />
                                </div>
                                </class>
                        </div>

                    </form>
                </div>
                </class>

        </div>
        <!-- /.col-->
    </div>
    <!-- /.row -->
</div>
<!--/.main-->

<script>
    function preview() {
        prd_image_id.src = URL.createObjectURL(event.target.files[0]);
    }
</script>