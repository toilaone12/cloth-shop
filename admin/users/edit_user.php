<?php
ob_start();

if (isset($_POST['sbm'])) {
    $sqlGetUser = "UPDATE users SET Name='" . $_POST['user_full'] . "', Email= '" . $_POST['user_mail'] . "', user_level='" . $_POST['user_level'] . "' WHERE  ID= '" . $_GET['ID'] . "'";
    $queryGetUser = $connect->query($sqlGetUser);
    header('location:/Ani_Fashion/admin/index.php?page_layout=user.php');
}
$NewUser = "";
if (isset($_GET['ID'])) {
    $ID = $connect->real_escape_string($_GET['ID']);
    //truy vấm để lấy thông tin danh mục dựa trên ID
    $query = "SELECT * FROM users WHERE ID = $ID";
    $result = $connect->query($query);
    // $NewCategory = $NewCategory->fectch_asoc;
    if ($result && $result->num_rows > 0) { // kiểm tra xem có tìm thấy danh mục không
        $NewUser = $result->fetch_assoc(); // lấy thông tin danh mục
    } else {
        // Hsử lý trường hợp k tìm thấy 
        echo "User not found!";
    }
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý thành viên</a></li>
            <li class="active">Nguyễn Thị Thu Hương</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thành viên: </h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <div class="alert alert-danger">Email đã tồn tại, Mật khẩu không khớp !</div>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Họ & Tên</label>
                                <input type="text" value="<?php echo $NewUser['Name'] ?>" name="user_full" required
                                    class="form-control" placeholder="Họ Và Tên...">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="<?php echo $NewUser['Email'] ?>" name="user_mail" required
                                    class="form-control">

                            </div>

                            <div class="form-group">
                                <label>Quyền</label>
                                <select value="<?php echo $NewUser['user_level'] ?>" name="user_level"
                                    class="form-control">
                                    <option value='1'>Admin</option>
                                    <!-- <option value='0' selected>Member</option> -->
                                </select>
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div>
<!--/.main-->