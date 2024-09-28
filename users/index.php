<?php
session_start();
$con = new PDO('mysql:host=localhost;dbname=onlinedukon', 'root', 'root');

if(!$_SESSION['cart']){
    $_SESSION['cart'] = [];
}
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $con->query($sql);
$products = $result->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['product_id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id='{$id}'";
    $sttm = $con->query($sql);
    $product = $sttm->fetch(PDO::FETCH_ASSOC);
    if(isset($product)){
        if(in_array($product,$_SESSION['cart'])){
            $_SESSION['cart'][] = $product;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vereesa - Home</title>
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

<body class="home">
    <header class="header style2">
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
                    <div class="col-lg-4 col-sm-6 col-md-4 col-xs-7 col-ts-12 header-element">
                        <div class="block-search-block">
                            <form class="form-search">
                                <div class="form-content">
                                    <div class="inner">
                                        <input type="text" class="input" name="s" value="" placeholder="Search here">
                                        <button class="btn-search" type="submit">
                                            <span class="icon-search"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-md-4 col-xs-5 col-ts-12">
                        <div class="logo">
                            <a href="index.html">
                                <img src="assets/images/logo.png" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 col-ts-12">
                        <div class="header-control">
                            <div class="block-minicart vereesa-mini-cart block-header vereesa-dropdown">
                                <a href="cart.php" class="shopcart-icon">
                                    Cart
                                    <span class="count">
                                        0
                                    </span>
                                </a>
                                <div class="no-product vereesa-submenu">
                                    <p class="text">
                                        You have
                                        <span>
                                            0 item(s)
                                        </span>
                                        in your bag
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <div class="">
        <div class="fullwidth-template">
            <div class="vereesa-product produc-featured rows-space-40">
                <div class="container">
                    <h3 class="custommenu-title-blog">
                        New Arrivals
                    </h3>
                    <ul class="row list-products auto-clear equal-container product-grid">
                        <?php
                        foreach ($products as $product) { ?>
                            <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                <div class="product-inner equal-element">
                                    <div class="product-top">
                                        <div class="flash">
                                            <span class="onnew">
                                                <span class="text">
                                                    new
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <a href="#">
                                                <img src="../admin/<?=$product['img']?>" alt="img">
                                            </a>
                                        </div>
                                        <a href="#" class="button quick-wiew-button">Quick View</a>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="#"><?=$product['name']?></a>
                                        </h5>
                                        <div class="group-info">
                                            <div class="stars-rating">
                                                <div class="count-star">
                                                    Qolgan: <?=$product['count']?> ta
                                                </div>
                                            </div>
                                            <div class="price">
                                                <ins>
                                                    <?=$product['price']?> So'm
                                                </ins>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loop-form-add-to-cart">
                                        <form class="cart">
                                            <div class="single_variation_wrap">
                                                <div class="quantity">
                                                    <div class="control">
                                                        <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                                        <input type="text" data-step="1" data-min="0" value="1"
                                                            title="Qty" class="input-qty qty" size="4">
                                                        <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                                                    </div>
                                                </div>
                                                <a href="?product_id=<?=$product['id']?>" class="single_add_to_cart_button button">Add to cart
                                                </a>
                                            </div>
                                            <div class="variations">
                                                <div class="variation">
                                                    <label class="variation-label">
                                                        Capacity:
                                                    </label>
                                                    <div class="variation-value">
                                                        <a href="#" class="change-value text over">
                                                            <span>10ml</span>
                                                        </a>
                                                        <a href="#" class="change-value text active">
                                                            <span>20ml</span>
                                                        </a>
                                                        <a href="#" class="change-value text">
                                                            <span>50ml</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>

                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
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