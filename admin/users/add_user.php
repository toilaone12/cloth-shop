<?php
$connect = new mysqli('localhost', 'root', '', 'ani_fashions');
if ($connect->errno) {
    die("connect to db fail");
}
// $sqlGetUsers = "SELECT * FROM users";
// $result = $connect->query($sqlGetUsers);


if (isset($_POST['sbm'])) {
    // $sqlGetUsers = "INSERT INTO users(Name, Email, user_level, password) values ('" . $_POST['user_full'] . " ','" . $_POST['user_mail'] . " ','" . $_POST['user_level'] . " ','" . $_POST['user_pass'] . " ')";
    // $queryGetUsers= $connect->query( $sqlGetUsers);
    // header('location:/Ani_Fashion/admin/index.php?page_layout=user.php');
    $uselfull =  $_POST['user_full'];
    // $usermail =   $_POST['user_mail'];
    $userpass = $_POST['user_pass'];
    $userpass = $_POST['user_re_pass'];
    $userlevel = $_POST['user_level'];


    if (empty($_POST['user_full'])) {
        $errInput['user_full_empty'] = 'Tên không được để trống'; // nếu chưa tao dc thì biến tạo mảng có key là user_full_empty
    } else {
        $userfull = $_POST['user_full']; //nếu đã nhập tên thì tạo biến $user_full
    }
    //ktra mail
    if (empty($_POST['user_mail'])) {
        $errInput['user_mail_empty'] = 'Email không được để trống'; // nếu chưa tao dc thì biến tạo mảng có key là user_full_empty
    } else {
        $usermail = $_POST['user_mail']; //nếu đã nhập tên thì tạo biến $user_full
    }

    //kiểm tra mật khẩu có khớp không
    if (empty($_POST['user_pass'])) {
        $errInput['user_pass_empty'] = 'mật khẩu không được để trống'; // nếu chưa tao dc thì biến tạo mảng có key là user_full_empty
    } else {
        $userfull = $_POST['user_pass']; //nếu đã nhập tên thì tạo biến $user_full
    }
    //nhập lại mkh
    if (empty($_POST['user_re_pass'])) {
        $errInput['user_re_pass_empty'] = 'Email không được để trống'; // nếu chưa tao dc thì biến tạo mảng có key là user_full_empty
    } else {
        $userRepass = $_POST['user_re_pass']; //nếu đã nhập tên thì tạo biến $user_full
    }
    // if(empty( $userlevel)){
    //     $errInput['user_level'] = 'Quyền không được để trống'; // nếu chưa tao dc thì biến tạo mảng có key là user_full_empty
    // }else{
    //     $userfull=$_POST['user_level']; //nếu đã nhập tên thì tạo biến $user_full
    // }

    //ktra mkh khớp không
    $checkPasswordMatch = true; // giả sử  ban đâu là mkh k khớp
    if (isset($userpass) && isset($userRepass)) {
        if ($userpass != $userRepass) {
            $errInput['pass-not-match'] = 'Mật khẩu không khớp';
            $checkPasswordMatch = false;
        }
    }

    //ktra sự tồn tại của email
    $checkMailNotExits = true; // giả sử  ban đâu là mkh k khớp
    if (isset($usermail)) {
        $sqlCheckMailNotExits = "SELECT * FROM users WHERE Email = '$usermail' ";
        $queryCheckMailNotExits = mysqli_query($connect, $sqlCheckMailNotExits);
        if (mysqli_num_rows($queryCheckMailNotExits) > 0) {
            $errInput['email_exists'] = 'Email đã tồn tại';
            $checkMailNotExits = false;
        }
    }
    // thêm mới dữ liệu vào cwo sở dữ liệu
    if (isset($uselfull) && isset($usermail) && isset($userpass) && ($checkPasswordMatch == true) && ($checkMailNotExits == true)) {
        $sqlGetUsers = "INSERT INTO users(Name, Email, user_level, password) values ('" . $_POST['user_full'] . " ','" . $_POST['user_mail'] . " ','" . $_POST['user_level'] . " ','" . $_POST['user_pass'] . " ')";
        $queryGetUsers = $connect->query($sqlGetUsers);
        header('location:/Ani_Fashion/admin/index.php?page_layout=user.php');
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
            <li class="active">Thêm thành viên</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm thành viên</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <div class="alert alert-danger">Email đã tồn tại !</div>
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <label>Họ & Tên</label>
                                <input name="user_full" class="form-control" placeholder="">
                                <span class="text-danger">
                                    <?php
                                    if (isset($errInput['user_full_empty'])) {
                                        echo $errInput['user_full_empty'];
                                    }
                                    ?>
                                </span>


                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="user_mail" type="text" class="form-control">
                                <span class="text-danger">
                                    <?php
                                    if (isset($errInput['user_mail_empty'])) {
                                        echo $errInput['user_mail_empty'];
                                    } else if (isset($errInput['name_exists'])) {
                                        echo $errInput['email_exists'];
                                    }
                                    ?>
                                </span>

                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input name="user_pass" type="password" class="form-control">
                                <?php
                                if (isset($errInput['user_pass_empty'])) {
                                    echo $errInput['user_pass_empty'];
                                }
                                ?>

                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input name="user_re_pass" type="password" class="form-control">
                                <?php
                                if (isset($errInput['user_re_pass_empty'])) {
                                    echo $errInput['user_re_pass_empty'];
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select name="user_level" class="form-control">
                                    <option value="1">Admin</option>
                                    <option values="0">Member</option>

                                </select>
                            </div>
                            <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div>