<?php
include_once "connect.php";
// Thực hiện truy vấn SQL để lấy dữ liệu từ bảng "category"
$connect = doConnection();
$listCate = "SELECT * FROM category ORDER BY RAND() LIMIT 5";
$result = $connect->query($listCate);
?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><span class="font-playwriter text-light logo-style">Ani Fashion</span></a>
                    </div>
                    <p>Khách hàng là trung tâm của mô hình kinh doanh độc đáo của chúng tôi, trong đó bao gồm cả thiết kế.</p>
                    <a href="#"><img src="img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Danh mục sản phẩm</h6>
                    <ul>
                        <?php
                            while($row = $result->fetch_assoc()){
                        ?>
                        <li><a href="./about.html"><?=$row['Name']?></a></li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Chính sách hỗ trợ</h6>
                    <ul>
                        <li><a href="#">Chính sách bảo hành</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Chính sách vận chuyển</a></li>
                        <li><a href="#">Chính sách hoàn tiền</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>Hòm thư góp ý</h6>
                    <div class="footer__newslatter">
                        <form action="#">
                            <input type="text" placeholder="Email của bạn">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
    $(function(){
        const notyf = new Notyf({
            duration: 5000,
            ripple: true,
            position: {
                x: 'right',
                y: 'top',
            },
            dismissible: true,
        });
        let idCustomer = "<?=isset($_COOKIE['customer_login']) && $_COOKIE['customer_login'] ? json_decode($_COOKIE['customer_login'],true)['ID'] : '' ?>";
        // Add cart
        $('.add-cart').on('click', function(){
            let id = $(this).attr('data-id');
            let quantity = $('.quantity-detail').val();
            quantity = quantity ? quantity : 1;
            if(!idCustomer){
                location.href = "login.php";
                return false;
            }
            $.ajax({
                url: "cart/add_cart.php",
                method: "POST",
                data: {
                    id: id,
                    id_customer: idCustomer,
                    quantity: quantity,
                },
                dataType: 'json',
                success: function(data){
                    if(data.res == 'success'){
                        $('.number-cart').text(data.count);
                        notyf.success(data.text);
                    }else{
                        notyf.error(data.text);
                    }
                }
            })
        })
        //Update cart
        $('.update-cart').on('click', function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            let quantity = $(`.quantity-cart[data-id="${id}"]`).val();
            $.ajax({
                url: "cart/update_cart.php",
                method: "POST",
                data: {
                    id_customer: idCustomer,
                    id: id,
                    quantity: quantity,
                },
                dataType: 'json',
                success: function(data){
                    if(data.res == 'success'){
                        location.reload();
                    }else{
                        notyf.error(data.text);
                    }
                }
            })
        })
        //delete cart
        $('.delete-cart').on('click', function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            $.ajax({
                url: "cart/delete_cart.php",
                method: "POST",
                data: {
                    id_customer: idCustomer,
                    id: id,
                },
                dataType: 'json',
                success: function(data){
                    if(data.res == 'success'){
                        location.reload();
                    }else{
                        notyf.error(data.text);
                    }
                }
            })
        })
        //sx san pham
        $('.choose-sx').on('change', function(e){
            e.preventDefault();
            let link = $(this).val();
            location.href = link;
            // console.log();
        })
    });
</script>
</body>

</html>