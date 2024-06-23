<?php
    $totalProduct = $connect->query("SELECT * FROM product")->num_rows;
    $totalCustomer = $connect->query("SELECT * FROM users WHERE user_level = 0")->num_rows;
    $totalAdmin = $connect->query("SELECT * FROM users WHERE user_level = 1")->num_rows;
    $date = date('Y-m-d');
    $totalOrder = $connect->query("SELECT * FROM orders WHERE order_date = '".$date."'")->num_rows;
    $totalComplete = $connect->query("SELECT * FROM orders WHERE order_date = '".$date."' AND status = 3")->num_rows;
    $totalCancel = $connect->query("SELECT * FROM orders WHERE order_date = '".$date."' AND status = 4")->num_rows;
    $totalPending = $connect->query("SELECT * FROM orders WHERE order_date = '".$date."' AND status in (1,2)")->num_rows;
    $total = $connect->query("SELECT SUM(total) as total FROM orders WHERE order_date = '".$date."'")->fetch_assoc()['total'];
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
            <li class="active">Trang chủ quản trị</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Trang chủ quản trị</h1>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-blue panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked bag">
                            <use xlink:href="#stroked-bag"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?=$totalProduct?></div>
                        <div class="text-muted" style="margin-bottom: 10px;">Sản Phẩm</div>
                        <a href="?page_layout=product" class="btn btn-default">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fa-solid fa-users fs-65"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?=$totalAdmin?></div>
                        <div class="text-muted" style="margin-bottom: 10px;">Quản trị viên</div>
                        <a href="?page_layout=user" class="btn btn-default">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fa-solid fa-users fs-65"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?=$totalCustomer?></div>
                        <div class="text-muted" style="margin-bottom: 10px;">Khách hàng</div>
                        <a href="?page_layout=user" class="btn btn-default">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fa-solid fa-file-invoice fs-65"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?=$totalOrder?></div>
                        <div class="text-muted" style="margin-bottom: 10px;">Tổng đơn hàng hôm nay</div>
                        <a href="?page_layout=orders" class="btn btn-default">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-success panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fa-solid fa-file-invoice fs-65"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?=$totalComplete?></div>
                        <div class="text-muted" style="margin-bottom: 10px;">Đơn hàng thành công hôm nay</div>
                        <a href="?page_layout=orders" class="btn btn-default">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fa-solid fa-file-invoice fs-65"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?=$totalCancel?></div>
                        <div class="text-muted" style="margin-bottom: 10px;">Đơn hàng đã hủy hôm nay</div>
                        <a href="?page_layout=orders" class="btn btn-default">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fa-solid fa-file-invoice fs-65"></i>  
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?=$totalPending?></div>
                        <div class="text-muted" style="margin-bottom: 10px;">Đơn hàng đang chờ hôm nay</div>
                        <a href="?page_layout=orders" class="btn btn-default">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fa-solid fa-dollar-sign fs-65"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?=number_format($total,0,',','.')?> đ   </div>
                        <div class="text-muted" style="margin-bottom: 10px;">Doanh thu hôm nay</div>
                        <a href="?page_layout=orders" class="btn btn-default">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>

<body>
    <!-- hiệu ứng mưa  -->
    <!-- <div class="container">
        <div class="cloud"></div>
    </div>
    <script>
        function rain() {
            let cloud = document.querySelector('.cloud.');
            let e = document.createDocumentFragment('div');
            let left = Math.floor(Math.random() * 310);
            let width = Math.random() * 5;
            let height = Math.random() * 50;
            let duration = Math.random() * 0.5;
            e.classList.add('drop');
            cloud.appendChild(e);
            e.style.left = left + 'px';
            e.style.width = 0.5 + width + 'px';
            e.style.height = 0.5 + height + 'px';
            e.style.animationDuration = 1 + duration + 's';
            setTimeout(function() {
                cloud.appendChild(e)
            }, 2000)
        }
        setInterval(function() {
            rain();
        }, 20);
    </script> -->
    </div>
</body>

<!--/.main-->