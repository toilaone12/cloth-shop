<?php
    $id = isset($_GET['id']) && $_GET['id'] ? intval($_GET['id']) : 0;
    if($id){
        $category = $connect->query('SELECT * FROM category WHERE ID = '.$id);
        $allCategory = $connect->query('SELECT * FROM category');
        $arrAllCategory = [];
        while ($rowAllCate = $allCategory->fetch_assoc()){
            $products = $connect->query("SELECT * FROM product WHERE category_ID = ".$rowAllCate['ID']);
            $count = $products->num_rows;
            $arrAllCategory[] = [
                'id' => $rowAllCate['ID'],
                'name' => $rowAllCate['Name'],
                'count' => $count,
            ];
        }
        if($category->num_rows){
            $one = $category->fetch_assoc();
            $cons = "SELECT * FROM product WHERE category_ID = ".$id;
            if(isset($_GET['keyword']) && $_GET['keyword']){
                $keyword = addslashes($_GET['keyword']);
                $cons .= " and lower(Name) LIKE '%".$keyword."%'";
            }
            if(isset($_GET['max']) && $_GET['max']){
                $max = intval($_GET['max']);
                $cons .= " and price <= ".$max;
            }
            if(isset($_GET['min']) && $_GET['min']){
                $min = intval($_GET['min']);
                $cons .= " and price >= ".$min;
            }
            if(isset($_GET['desc']) && $_GET['desc']){
                $cons .= " ORDER BY price DESC";
            }
            if(isset($_GET['asc']) && $_GET['asc']){
                $cons .= " ORDER BY price ASC";
            }
            $products = $connect->query($cons);
        }else{
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }

    function getLink($array){
        $getLinks = $_GET;
        $arrLink = array_merge($getLinks,$array);
        $links = '?';
        foreach($arrLink as $key => $link){
            $links .= $key.'='.$link.'&';
        }
        $links = rtrim($links,'&');
        return $links;
    }
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4><?=$one['Name']?></h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <span><?=$one['Name']?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form method="GET">
                            <input type="hidden" name="page_layout" value="category">
                            <input type="hidden" name="id" value="<?=$id?>">
                            <?php
                                if(isset($_GET['min']) && $_GET['min']){
                            ?>
                            <input type="hidden" name="min" value="<?=$_GET['min']?>">
                            <?php
                                }
                            ?>
                            <?php
                                if(isset($_GET['max']) && $_GET['max']){
                            ?>
                            <input type="hidden" name="max" value="<?=$_GET['max']?>">
                            <?php
                                }
                            ?>
                            <input type="text" name="keyword" value="<?=isset($_GET['keyword']) && $_GET['keyword'] ? $_GET['keyword'] : '' ?>" placeholder="Tìm kiếm...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <?php
                                                    foreach($arrAllCategory as $one){
                                                ?>
                                                <li><a href="?page_layout=category&id=<?=$one['id']?>"><?=$one['name']?> (<?=$one['count']?>)</a></li>
                                                <?php
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Lọc giá</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="<?=getLink(['min' => '5000000', 'max' => '10000000'])?>">5.000.000đ - 10.000.000đ</a></li>
                                                <li><a href="<?=getLink(['min' => '10000000', 'max' => '15000000'])?>">10.000.000đ - 15.000.000đ</a></li>
                                                <li><a href="<?=getLink(['min' => '15000000', 'max' => '20000000'])?>">15.000.000đ - 20.000.000đ</a></li>
                                                <li><a href="<?=getLink(['min' => '20000000', 'max' => '25000000'])?>">20.000.000đ - 25.000.000đ</a></li>
                                                <li><a href="<?=getLink(['min' => '25000000', 'max' => '30000000'])?>">25.000.000đ - 30.000.000đ</a></li>
                                                <li><a href="<?=getLink(['min' => '30000000', 'max' => '1000000000'])?>">30.000.000đ+</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sắp xếp theo:</p>
                                <select class="choose-sx">
                                    <option value="asc">Giá từ thấp đến cao</option>
                                    <option value="desc">Giá từ cao đến thấp</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        while($product = $products->fetch_assoc()){
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="../admin/images/<?=$product['images']?>">
                            </div>
                            <div class="product__item__text">
                                <h6>Sản phẩm: <?=$product['Name']?></h6>
                                <div class="d-flex">
                                    <a class="add-cart cursor-pointer" data-id="<?=$product['ID']?>">+ Thêm vào giỏ hàng</a>
                                    <a href="?page_layout=chitietsanpham&id=<?=$product['ID']?>" class="cursor-pointer" style="left: 68%;top: 23px;">Xem chi tiết</a>
                                </div>
                                <h5><?=number_format($product['price'],0,',','.')?> đ</h5>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->