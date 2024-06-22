<?php
ob_start();

    if (isset($_POST['sbm'])) {
        $sqlGetCategory = "UPDATE category SET Name='" .$_POST['name_up']."' WHERE  ID= '".$_GET['ID']."'";
        $queryGetCategory = $connect->query($sqlGetCategory);
        header('location:/Ani_Fashion/admin/index.php?page_layout=category.php');
    }
$NewCategory = "";
if(isset($_GET['ID'])){
    $ID = $connect->real_escape_string($_GET['ID']);
    //truy vấm để lấy thông tin danh mục dựa trên ID
    $query = "SELECT * FROM category WHERE ID = $ID";
    $result = $connect->query($query);
    // $NewCategory = $NewCategory->fectch_asoc;
    if ($result && $result->num_rows > 0) { // kiểm tra xem có tìm thấy danh mục không
                $NewCategory = $result->fetch_assoc(); // lấy thông tin danh mục
            } else {
                // Hsử lý trường hợp k tìm thấy 
                echo "Category not found!";
            }
    
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý danh mục</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh mục</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">

                        <div class="alert alert-danger">Danh mục đã tồn tại !</div>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" value="<?php echo $NewCategory['Name'] ?> " name="name_up" required
                                    value="" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div>
    <!--/.main-->