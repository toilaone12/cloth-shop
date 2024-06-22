<?php
// $connect = new mysqli('localhost', 'root', '', 'ani_fashions');
// if ($connect->errno) {
//     die("connect to db fail");
// }


$sqlGetCategory = "SELECT* FROM category";
$result = $connect->query($sqlGetCategory);

if (isset($_POST['sbm'])) {
    $sqlGetCategory = "INSERT INTO category(Name) values ('" . $_POST['prd_name'] . " ')";
    $queryGetCategory = $connect->query($sqlGetCategory);
    header('location:/Ani_Fashion/admin/index.php?page_layout=category.php');
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
            <li><a href="">Quản lý danh mục</a></li>
            <li class="active">Thêm danh mục</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm danh mục</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên danh mục</label>


                                    <input required name="prd_name" class="form-control" placeholder="" />


                                </div>
                                <div class="form-group">
                                    <a href="?page_layout=category.php"><button name="sbm" type="submit"
                                            class="btn btn-success">
                                            Thêm mới</button></a>
                                    <button type="reset" class="btn btn-default">Làm mới</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>