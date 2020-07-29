<!DOCTYPE html>
<html>
<head>
    <title>GBD Admin</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/admin.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/css/icons/comic.png') ?>">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
<div class="col-md-2 sidebar">
    <div class="site-heading"  onclick="location.href='<?php echo site_url('home') ?>'">
        <p>GBD<sub style="font-size: 12px">ADMIN</sub></p>
    </div>
    <div class="nav-links">
        <a href="<?php echo site_url('home/orders'); ?>"><i class="las la-shipping-fast"></i> Orders</a><br><br>
        <a href="<?php echo site_url('home/settings') ?>"><i class="las la-cog"></i> Settings</a><br><br>
        <a href="<?php echo site_url('home/inventory') ?>"><i class="las la-warehouse"></i> Inventory</a><br><br>
        <a href="<?php echo site_url('home/bundles') ?>"><i class="lab la-buffer"></i> Bundles</a><br><br>
        <a href="<?php echo site_url('stats') ?>"><i class="las la-chart-bar"></i> Statistics</a><br><br>
        <a href="<?php echo site_url('home/logout') ?>"><i class="las la-sign-out-alt"></i> Logout</a>
    </div>
</div>
<div class="col-md-10 top-bar">

</div>
