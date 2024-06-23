     <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         <div class="container-fluid">
             <div class="navbar-header">
                 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                     data-target="#sidebar-collapse">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                 </button>
                 <a class="navbar-brand" href="#"><span>ANI-</span>FASHIONS</a>
                 <ul class="user-menu">
                     <li class="dropdown pull-right">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg
                                 class="glyph stroked male-user">
                                 <use xlink:href="#stroked-male-user"></use>
                             </svg>
                             Admin <span class="caret"></span></a>
                         <ul class="dropdown-menu" role="menu">
                             <li>
                                 <a href="#"><svg class="glyph stroked male-user">
                                         <use xlink:href="#stroked-male-user"></use>
                                     </svg>
                                     Hồ sơ</a>
                             </li>
                             <li>
                                 <a href="/Ani_Fashion/admin/logout.php"><svg class="glyph stroked cancel">
                                         <use xlink:href="#stroked-cancel"></use>
                                     </svg>
                                     Đăng xuất</a>
                             </li>
                         </ul>
                     </li>
                 </ul>
             </div>
         </div>
         <!-- /.container-fluid -->
     </nav>

     <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
         <form role="search">
             <div class="form-group">
                 <input type="text" class="form-control" placeholder="Search" />
             </div>
         </form>
         <ul class="nav menu">
             <li class="active">
                 <a href="index.php?page_layout=admin"><svg class="glyph stroked dashboard-dial">
                         <use xlink:href="#stroked-dashboard-dial"></use>
                     </svg>
                     Trang chủ</a>
             </li>
             <li>
                 <a href="index.php?page_layout=user"><svg class="glyph stroked male user">
                         <use xlink:href="#stroked-male-user" />
                     </svg>
                     Quản lý thành viên</a>
             </li>
             <li>
                 <a href="index.php?page_layout=category"><svg class="glyph stroked open folder">
                         <use xlink:href="#stroked-open-folder" />
                     </svg>
                     Quản lý danh mục</a>
             </li>
             <li>
                 <a href="index.php?page_layout=product"><svg class="glyph stroked bag">
                         <use xlink:href="#stroked-bag"></use>
                     </svg>
                     Quản lý sản phẩm</a>
             </li>
             <li>
                 <a href="index.php?page_layout=orders"><svg class="glyph stroked bag">
                         <use xlink:href="#stroked-bag"></use>
                     </svg>
                     Quản lý đơn hàng</a>
             </li>
             <!-- <li>
                 <a href="index.php?page_layout=comment"><svg class="glyph stroked two messages">
                         <use xlink:href="#stroked-two-messages" />
                     </svg>
                     Quản lý bình luận</a>
             </li> -->
             <!-- <li>
                 <a href="index.php?page_layout=ads"><svg class="glyph stroked chain">
                         <use xlink:href="#stroked-chain" />
                     </svg>
                     Quản lý quảng cáo</a>
             </li>
             <li>
                 <a href="index.php?page_layout=setting"><svg class="glyph stroked gear">
                         <use xlink:href="#stroked-gear" />
                     </svg>
                     Cấu hình</a>
             </li> -->
         </ul>
     </div>