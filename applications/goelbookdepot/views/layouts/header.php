<!DOCTYPE html>
<html>
<head>
    <meta name="theme-color" content="#f95555">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Goel Book Depot | Get all college, school books at Discounted price | All competetion books available.</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/css/icons/comic.png') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        @font-face{
            font-family: Nunito-regular;
            src: url(<?php echo base_url('assets/fonts/Nunito-regular.ttf'); ?>);
        }

        @font-face{
            font-family: Questrial-regular;
            src: url(<?php echo base_url('assets/fonts/Questrial-regular.ttf'); ?>);
        }
    </style>
</head>
<body>
    <div id="mySidenav" class="sidenav" style="font-family: 'Roboto Condensed', sans-serif; text-align: left; ">
        <a href="<?php echo site_url('home/cart'); ?>"><i class="las la-shopping-cart"></i>  Your Cart</a>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="las la-times"></i></a>
        <a href="<?php echo site_url('home/signin') ?>"><i class="las la-sign-in-alt"></i>  Sign In</a>
        <a href="<?php echo site_url('home/listcategories') ?>"><i class="las la-tags"></i>  Shop by Category</a>
        <a href="<?php echo site_url('home/examcentral') ?>"><i class="las la-crosshairs"></i>  Exam Central</a>
        <a href=""<?php echo site_url('home/comingsoon') ?>""><i class="las la-retweet"></i>  Used books at 50%</a>
        <a href="<?php echo site_url('bundle') ?>"><i class="las la-book"></i>  Bundle Store</a>
        <a href="<?php echo site_url('home/privacy') ?>"><i class="las la-user-secret"></i>  Privacy Policy</a>
        <a href="<?php echo site_url('home/terms') ?>"><i class="las la-list-alt"></i>  Terms & Conditions</a>
        <a href="<?php echo site_url('home/contact') ?>"><i class="las la-tty"></i>  Contact Us</a>
    </div>
    <nav style="height: 125px; color: black; background: #f95555; margin-bottom: 0px;" class="navbar header" >
        <div class="col-xs-2 side-icon">
                <i class="las la-bars nav-icon" onclick="openNav()"></i>
        </div>
        <div class="col-xs-8 col-sm-6 col-md-6 col-lg-4">
            <p class="site-heading" onclick="location.href='<?php echo site_url('home') ?>'">GOEL BOOK DEPOT</p>
        </div>
        <div class="col-xs-2 col-md-1 col-lg-3 side-icon" align="right">
            <i class="las la-shopping-cart nav-icon" title="Cart" onclick="location.href='<?php echo site_url('home/cart') ?>'"></i>
            <span class="hide-sm" style="cursor: pointer">
                <span onclick="location.href='<?php echo site_url('home/cart') ?>'">
                    Cart
                    <?= isset($_SESSION['cart']) ? "(".count($_SESSION['cart']).")" : "(".intval(0).")" ?>
                </span>

                <i class="las la-book nav-icon hide-sm"
                        title="Bundle Store"
                        onclick="location.href='<?php echo site_url('bundle') ?>'">
                </i>

                <span onclick="location.href='<?php echo site_url('bundle') ?>'">Bundles</span>

                <i class="las la-sign-in-alt nav-icon hide-sm"
                   title="Log In"
                   onclick="location.href='<?php echo site_url('home/signin') ?>'">
                </i>

                <span onclick="location.href='<?php echo site_url('home/signin') ?>'">Sign In</span>
            </span>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-5" style=" margin-top: 5px;" align="center">
            <input type="text" id="search_text" name="" placeholder="Search Over 1000+ books">
        </div>
    </nav>
    <div class="body-content">
        <div class="col-xs-12">
            <div id="result">

            </div>
        </div>