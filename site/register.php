<?php
$connect = new mysqli('localhost', 'root', '', 'ani_fashions');
if ($connect->errno) {
  die("connect to db fail");
}
// include "./users/user.php";
session_start();
ob_start();


if (isset($_POST['register'])) {
  $fullname = $connect->real_escape_string($_POST['fullname']);
  $email = $connect->real_escape_string($_POST['email']);
  $password = $connect->real_escape_string($_POST['password']);
  $repassword = $connect->real_escape_string($_POST['repassword']);
  if($repassword == $password){
    $check = $connect->query("SELECT * FROM users WHERE Email = '".$email."'");
    if(!$check->num_rows){
      $insert = $connect->query("INSERT INTO users (`Name`,`Email`,`user_level`,`password`) VALUES ('$fullname','$email',0,'$password')");
      if ($insert) {
        $error_message = '<div class="alert alert-success">Tạo tài khoản thành công</div>';
      } else {
        $error_message = '<div class="alert alert-danger">Tên đăng nhập hoặc mật khẩu không đúng</div>';
      }
    }else{
      $error_message = '<div class="alert alert-danger">Tài khoản đã tồn tại</div>';
    }
  }else{
    $error_message = '<div class="alert alert-danger">Mật khẩu không trùng khớp</div>';
  }
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng ký</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="./css/login.css" rel="stylesheet" />
</head>
<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <h4 class="mt-1 mb-3 pb-1">Chào mừng đến với Ani Fashion</h4>
                </div>
                <h3 class="text-center mb-5">Đăng ký</h3>
                <?php
                  if(isset($error_message) && $error_message){
                    echo $error_message;
                  }
                ?>
                <form method="POST">
                  <div data-mdb-input-init class="form-outline mb-2">
                    <label class="form-label" for="form2Example111">Họ tên</label>
                    <input type="text" name="fullname" id="form2Example111" required class="form-control"
                      placeholder="Họ tên" />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-2">
                    <label class="form-label" for="form2Example11">Tên đăng nhập</label>
                    <input type="email" name="email" id="form2Example11" required class="form-control"
                      placeholder="Tên đăng nhập" />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-2">
                    <label class="form-label" for="form2Example22">Mật khẩu</label>
                    <input type="password" name="password" id="form2Example22" required class="form-control" placeholder="Mật khẩu" />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example222">Nhập lại mật khẩu</label>
                    <input type="password" name="repassword" id="form2Example222" required class="form-control" placeholder="Nhập lại mật khẩu" />
                  </div>

                  <div class="text-center pt-1 mb-3 pb-1">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg mb-3" type="submit" name="register">Đăng ký</button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Bạn đã có tài khoản?</p>
                    <a href="login.php" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger">Đăng nhập</a>
                  </div>

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4"></h4>
                <p class="small mb-0"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.row -->

<body></body>

</html>