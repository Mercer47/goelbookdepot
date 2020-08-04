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
    <a href="<?php echo site_url('home/cart'); ?>">  Hello, <?php echo $userName->name ?></a>
    <a href="<?php echo site_url('home/cart'); ?>"><i class="las la-shopping-cart"></i>  Your Cart</a>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="las la-times"></i></a>
    <a href="<?php echo site_url('user/index') ?>"><i class="las la-shipping-fast"></i>  Your Orders</a>
    <a href="<?php echo site_url('user/account') ?>"><i class="las la-user-tie"></i>  Your Account</a>
    <a href="<?php echo site_url('user/logout') ?>"><i class="las la-sign-out-alt"></i>  Log Out</a>
</div>
<nav style="height: 125px; color: black; background: #f95555; margin-bottom: 0px;" class="navbar header" >
    <div class="col-xs-2 side-icon">
        <i class="las la-bars nav-icon" onclick="openNav()"></i>
    </div>
    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
        <p class="site-heading" onclick="location.href='<?php echo site_url('home') ?>'">GOEL BOOK DEPOT</p>
    </div>
    <div class="col-xs-2 col-lg-1 side-icon" align="right">
        <i class="las la-shopping-cart nav-icon" onclick="location.href='<?php echo site_url('home/cart') ?>'"></i>
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