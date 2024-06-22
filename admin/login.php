<?php
$connect = new mysqli('localhost', 'root', '', 'ani_fashions');
if ($connect->errno) {
    die("connect to db fail");
}
// include "./users/user.php";
session_start();
ob_start();

if (isset($_SESSION['user_login'])) {
    header("location:index.php");
}

if (isset($_POST['btn_login'])) {
    $mail = $_POST['mail'];
    $password = $_POST['pass'];
    $sqlLogin = "SELECT * FROM  users where Email = '$mail' AND password = '$password' ";
    $result = $connect->query($sqlLogin);

    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();
        $_SESSION['user_login'] = $result;
        header('Location:index.php'); // nếu bản ghi đã tồn tại thì chuyển sang file user.php
    } else {
        $error_message = '<div class="alert alert-danger">Tên đăng nhập hoặc mật khẩu không đúng</div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AdminHub</title>

    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/datepicker3.css" rel="stylesheet" />
    <link href="css/bootstrap-table.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">ANIFASHIONS- AdminHub</div>
                <div class="panel-body">

                    <?php
                    if (isset($error_message)) {
                        echo $error_message;
                    }
                    ?>

                    <form role="form" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus />
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="" />
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me" />Nhớ tài khoản
                                </label>
                            </div>

                            <button type="submit" name="btn_login" class="btn btn-primary">Đăng nhập</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row -->

</body>

</html>