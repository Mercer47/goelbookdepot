<!DOCTYPE html>
<html>
<head>
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
    <style type="text/css">

        .loader-wrapper{
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-color: #f95555;
        }
        .loader {
            display: inline-block;
            width: 30px;
            height: 30px;
            position: fixed;
            border: 4px solid #Fff;
            top: 50%;
            left: 50%;
            animation: loader 2s infinite ease;
        }

        .loader-inner {
            vertical-align: top;
            display: inline-block;
            width: 100%;
            background-color: #fff;
            animation: loader-inner 2s infinite ease-in;
        }

        @keyframes loader {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-inner {
            0% {
                height: 0%;
            }

            25% {
                height: 0%;
            }

            50% {
                height: 100%;
            }

            75% {
                height: 100%;
            }

            100% {
                height: 0%;
            }
        }
    </style>
    <style type="text/css">
        * {box-sizing:border-box}


        /* Hide the thumbnails by default */
        .mySlides {
            display: none;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 2.6s ease;
            border-radius: 0 3px 3px 0;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 10px;
            width: 10px;
            margin: 0 2px;
            background-color: #000000;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 3.5s ease;
        }

        .active, .dot:hover {
            background-color: white;
        }

        /* Fading animation */
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 3.5s;
            animation-name: fade;
            animation-duration: 3.5s;
        }

        @-webkit-keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }
    </style>
    <style type="text/css">
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #f95555;
            overflow-x: hidden;
            transition: 1.0s;
            padding-top: 60px;

        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: white;
            display: block;
            transition: 0.3s;
            font-size: 16px;
            font-family: Questrial-regular, serif;
        }

        .sidenav a:hover{
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 20px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
        input:focus{
            outline: none;
        }
        select:focus{
            outline: none;
        }
        button:focus{
            outline: none;
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