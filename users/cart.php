<?php
session_start();
// session_destroy();
$con = new PDO('mysql:host=localhost;dbname=onlinedukon', 'root', 'root');
if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE id='{$id}'";
    $sttm = $con->query($sql);
    $product = $sttm->fetch(PDO::FETCH_ASSOC);
    // $product = array('id' => $product['id'], 'name' => $product['name'], 'price' => $product['price'],'img' => $product['img'],'count'=>$product['count'],'user_id'=>$product['user_id'],'category_id'=>$product['category_id'],'quantity'=>$_GET['quant']);

    $key = array_search($product, $_SESSION['carts']);
    unset($_SESSION['carts'][$key]);
}
// if(isset($_GET['quantity'])){
//     $key=$_GET['order'];
//     $quantity=$_GET['quantity'];
//     if ($quantity==0){
//         $_SESSION['carts'][$key]['quantity'] -= 1;
//     }elseif($quantity==1){
//         $_SESSION['carts'][$key]['quantity'] += 1;
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vereesa - Shopping Cart</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/chosen.min.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/lightbox.min.css">
    <link rel="stylesheet" href="assets/js/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="assets/css/jquery.scrollbar.min.css">
    <link rel="stylesheet" href="assets/css/mobile-menu.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="inblog-page">
    <header class="header style7">
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-left">
                    <div class="header-message">
                        Welcome to our online store!
                    </div>
                </div>
                <div class="top-bar-right">
                    <div class="header-language">
                        <div class="vereesa-language vereesa-dropdown">
                            <a href="#" class="active language-toggle" data-vereesa="vereesa-dropdown">
                                <span>
                                    English (USD)
                                </span>
                            </a>
                            <ul class="vereesa-submenu">
                                <li class="switcher-option">
                                    <a href="#">
                                        <span>
                                            French (EUR)
                                        </span>
                                    </a>
                                </li>
                                <li class="switcher-option">
                                    <a href="#">
                                        <span>
                                            Japanese (JPY)
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="header-user-links">
                        <li>
                            <a href="login.php">Login </a>
                            <a href="register.php"> Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="main-header">
                <div class="row">
                    <div class="col-lg-3 col-sm-4 col-md-3 col-xs-7 col-ts-12 header-element">
                        <div class="logo">
                            <a href="index.html">
                                <img src="assets/images/logo.png" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-8 col-md-6 col-xs-5 col-ts-12">
                        <div class="block-search-block">
                            <form class="form-search form-search-width-category">
                                <div class="form-content">
                                    <div class="category">
                                        <select title="cate" data-placeholder="All Categories" class="chosen-select"
                                            tabindex="1">
                                            <option value="United States">Accessories</option>
                                            <option value="United Kingdom">Chairs</option>
                                            <option value="Afghanistan">Tables</option>
                                            <option value="Aland Islands">Sofas</option>
                                            <option value="Albania">New Arrivals</option>
                                            <option value="Algeria">Storage</option>
                                        </select>
                                    </div>
                                    <div class="inner">
                                        <input type="text" class="input" name="s" value="" placeholder="Search here">
                                    </div>
                                    <button class="btn-search" type="submit">
                                        <span class="icon-search"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-sm-12 col-md-3 col-xs-12 col-ts-12">
                        <div class="header-control">
                            <div class="block-account block-header vereesa-dropdown">
                                <a href="javascript:void(0);" data-vereesa="vereesa-dropdown">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                </a>
                                <div class="header-account vereesa-submenu">
                                    <div class="header-user-form-tabs">
                                        <ul class="tab-link">
                                            <li class="active">
                                                <a data-toggle="tab" aria-expanded="true" href="#header-tab-login">Login</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" aria-expanded="true" href="#header-tab-rigister">Register</a>
                                            </li>
                                        </ul>
                                        <div class="tab-container">
                                            <div id="header-tab-login" class="tab-panel active">
                                                <form method="post" class="login form-login">
                                                    <p class="form-row form-row-wide">
                                                        <input type="email" placeholder="Email" class="input-text">
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        <input type="password" class="input-text" placeholder="Password">
                                                    </p>
                                                    <p class="form-row">
                                                        <label class="form-checkbox">
                                                            <input type="checkbox" class="input-checkbox">
                                                            <span>
                                                                Remember me
                                                            </span>
                                                        </label>
                                                        <input type="submit" class="button" value="Login">
                                                    </p>
                                                    <p class="lost_password">
                                                        <a href="#">Lost your password?</a>
                                                    </p>
                                                </form>
                                            </div>
                                            <div id="header-tab-rigister" class="tab-panel">
                                                <form method="post" class="register form-register">
                                                    <p class="form-row form-row-wide">
                                                        <input type="email" placeholder="Email" class="input-text">
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        <input type="password" class="input-text" placeholder="Password">
                                                    </p>
                                                    <p class="form-row">
                                                        <input type="submit" class="button" value="Register">
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="menu-bar mobile-navigation menu-toggle" href="#">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="header-nav-container">
            <div class="container">
                <div class="header-nav-wapper main-menu-wapper">
                    <div class="header-nav">
                        <div class="container-wapper">
                            <ul class="vereesa-clone-mobile-menu vereesa-nav main-menu " id="menu-main-menu">
                                <li class="menu-item">
                                    <a href="about.html" class="vereesa-menu-item-title" title="About">About</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="header-device-mobile">
        <div class="wapper">
            <div class="item mobile-logo">
                <div class="logo">
                    <a href="#">
                        <img src="assets/images/logo.png" alt="img">
                    </a>
                </div>
            </div>
            <div class="item item mobile-search-box has-sub">
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </span>
                </a>
                <div class="block-sub">
                    <a href="#" class="close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    <div class="header-searchform-box">
                        <form class="header-searchform">
                            <div class="searchform-wrap">
                                <input type="text" class="search-input" placeholder="Enter keywords to search...">
                                <input type="submit" class="submit button" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="item mobile-settings-box has-sub">
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </span>
                </a>
                <div class="block-sub">
                    <a href="#" class="close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    <div class="block-sub-item">
                        <h5 class="block-item-title">Currency</h5>
                        <form class="currency-form vereesa-language">
                            <ul class="vereesa-language-wrap">
                                <li class="active">
                                    <a href="#">
                                        <span>
                                            English (USD)
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>
                                            French (EUR)
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>
                                            Japanese (JPY)
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <div class="item menu-bar">
                <a class=" mobile-navigation  menu-toggle" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
        </div>
    </div>
    <div class="site-content">
        <main class="site-main  main-container no-sidebar">
            <div class="container">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index.php">
                                <span>
                                    Home
                                </span>
                            </a>
                        </li>
                        <li class="trail-item trail-end active">
                            <span>
                                Shopping Cart
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="main-content-cart main-content col-sm-12">
                        <h3 class="custom_blog_title">
                            Shopping Cart
                        </h3>
                        <?php
                        if (!empty($_SESSION['carts'])) { ?>
                            <div class="page-main-content">
                                <div class="shoppingcart-content">
                                    <form action="order.php" method="POST" class="cart-form">
                                        <table class="shop_table">
                                            <thead>
                                                <tr>
                                                    <th class="product-remove"></th>
                                                    <th class="product-thumbnail"></th>
                                                    <th class="product-name"></th>
                                                    <th class="product-price"></th>
                                                    <th class="product-quantity"></th>
                                                    <th class="product-subtotal"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($_SESSION['carts'] as $key => $cart) { ?>
                                                    <tr class="cart_item">
                                                        <td class="product-remove">
                                                            <a href="?product_id=<?= $cart['id'] ?>" class="remove"></a>
                                                        </td>
                                                        <td class="product-thumbnail">
                                                            <a href="#">
                                                                <img src="../admin/<?= $cart['img'] ?>" alt="img" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">
                                                            </a>
                                                        </td>
                                                        <td class="product-name" data-title="Product">
                                                            <a href="#" class="title"><?= $cart['name'] ?></a>
                                                        </td>
                                                        <td class="product-quantity" data-title="Quantity">
                                                            <div class="quantity">
                                                                <div class="control">
                                                                    <input type="hidden" name="id" value="<?= $key ?>">
                                                                    <input type="hidden" name="quant" value="<?= $cart['quantity'] ?>">
                                                                    <a class="btn-number qtyminus quantity-minus" href="?quantity=0">-</a>
                                                                    <input type="text" name="quantity" data-step="1" data-min="1" max="<?= $cart['count'] ?>" title="Qty" class="input-qty qty" readonly>
                                                                    <a href="?quantity=1" class="btn-number qtyplus quantity-plus">+</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="product-price" data-title="Price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">
                                                                    So'm
                                                                </span>
                                                                <?= $cart['price'] ?>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="control-cart">
                                            <a href="index.php" class="button btn-continue-shopping">
                                                CONTINUE SHOPPING
                                            </a>
                                            <button type="submit" name="checkout" class="button btn-cart-to-checkout">
                                                CHECK OUT
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        <?php } else{
                            echo '<div class="page-main-content">
                            <div class="shoppingcart-content">
                                <div class="alert alert-danger">
                                    <strong>Cart is empty</strong>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer class="footer style7">
        <div class="container">
            <div class="container-wapper">
                <div class="row">
                    <div class="box-footer col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="widget-box">
                            <div class="single-img">
                                <a href="index.html"><img src="assets/images/logo.png" alt="img"></a>
                            </div>
                            <div class="text-content-elememnt">
                                <p>
                                    Shop the latest products right from
                                    your home .
                                </p>
                                <p>We have furniture supplies & accessories from top brands.</p>
                            </div>
                        </div>
                        <div class="vereesa-socials">
                            <ul class="socials">
                                <li>
                                    <a href="#" class="social-item" target="_blank">
                                        <i class="icon fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="social-item" target="_blank">
                                        <i class="icon fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="social-item" target="_blank">
                                        <i class="icon fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box-footer col-xs-12 col-sm-6 col-md-6 col-lg-2">
                        <div class="vereesa-custommenu default">
                            <h2 class="widgettitle">Links</h2>
                            <ul class="menu">
                                <li class="menu-item">
                                    <a href="#">Tables</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Lighting</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Lighting</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Gift Vouchers</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Accessories</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box-footer col-xs-12 col-sm-6 col-md-6 col-lg-2">
                        <div class="vereesa-custommenu default">
                            <h2 class="widgettitle">Information</h2>
                            <ul class="menu">
                                <li class="menu-item">
                                    <a href="#">FAQs</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Track Order</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Delivery</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Contact Us</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Return</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box-footer col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="vereesa-newsletter style1">
                            <div class="newsletter-head">
                                <h3 class="title">Newsletter</h3>
                            </div>
                            <div class="newsletter-form-wrap">
                                <div class="list">
                                    Get notified of new products, limited releases, and more.
                                </div>
                                <input type="email" class="input-text email email-newsletter"
                                    placeholder="Your email letter">
                                <button class="button btn-submit submit-newsletter">SUBSCRIBE</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 border-custom">
                        <span></span>
                    </div>
                </div>
                <div class="footer-end">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="coppyright">
                                Copyright © 2019
                                <a href="#">Vereesa</a>
                                . All rights reserved
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="vereesa-payment">
                                <img src="assets/images/payments.png" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a href="#" class="backtotop">
        <i class="pe-7s-angle-up"></i>
    </a>
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/jquery.plugin-countdown.min.js"></script>
    <script src="assets/js/jquery-countdown.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/jquery.scrollbar.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/mobile-menu.js"></script>
    <script src="assets/js/chosen.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/jquery.elevateZoom.min.js"></script>
    <script src="assets/js/jquery.actual.min.js"></script>
    <script src="assets/js/fancybox/source/jquery.fancybox.js"></script>
    <script src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/owl.thumbs.min.js"></script>
    <script src="assets/js/jquery.scrollbar.min.js"></script>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM'></script>
    <script src="assets/js/frontend-plugin.js"></script>
</body>

</html>