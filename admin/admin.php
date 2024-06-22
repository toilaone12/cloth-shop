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
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-blue panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked bag">
                            <use xlink:href="#stroked-bag"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">120</div>
                        <div class="text-muted">Sản Phẩm</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked empty-message">
                            <use xlink:href="#stroked-empty-message"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">52</div>
                        <div class="text-muted">Bình Luận</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked male-user">
                            <use xlink:href="#stroked-male-user"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">24</div>
                        <div class="text-muted">Thành Viên</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked app-window-with-content">
                            <use xlink:href="#stroked-app-window-with-content"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">25.2k</div>
                        <div class="text-muted">Quảng Cáo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>

<body>
    <!-- hiệu ứng mưa  -->
    <div class="container">
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
    </script>
    </div>
</body>

<!--/.main-->