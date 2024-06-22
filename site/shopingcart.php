<?php
session_start();

// Kiểm tra nếu sản phẩm ID và số lượng được gửi từ form
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    // Lấy thông tin sản phẩm từ form
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Kiểm tra nếu giỏ hàng đã tồn tại trong session
    if (isset($_SESSION['cart'])) {
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            // Nếu đã tồn tại, cập nhật số lượng sản phẩm
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            $_SESSION['cart'][$product_id] = $quantity;
        }
    } else {
        // Nếu giỏ hàng chưa tồn tại, tạo giỏ hàng mới và thêm sản phẩm vào
        $_SESSION['cart'] = array($product_id => $quantity);
    }

    // Chuyển hướng người dùng đến trang giỏ hàng hoặc trang sản phẩm sau khi thêm vào giỏ hàng
    header("Location: /Ani_Fashion/site/cart.php");
    exit;
} else {
    // Nếu sản phẩm ID hoặc số lượng không được gửi từ form, chuyển hướng người dùng về trang sản phẩm
    header("Location: /Ani_Fashion/site/product.php");
    exit;
}
