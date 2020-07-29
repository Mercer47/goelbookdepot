<!DOCTYPE html>
<html>
<head>
    <meta name="theme-color" content="#f95555">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Goel Book Depot</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css') ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/css/icons/comic.png') ?>">
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
        button:focus {
            outline: none;
        }
    </style>
    <style type="text/css">
        .loader-wrapper {
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
            position: relative;
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

</head>
<body>
    <div class="col-xs-12 nav-page">
        <div class="col-xs-2 col-lg-1">
            <i class="las la-arrow-circle-left" onclick="window.goBack()"></i>
        </div>
        <div class="col-xs-8 col-lg-10">
            <p class="page-title"><?php echo urldecode($title); ?></p>
        </div>
        <div class="col-xs-2 col-lg-1 side-icon" align="right">
            <i class="las la-home" onclick="location.href='<?php echo site_url('home') ?>'"></i>
        </div>
    </div>
<div class="col-md-12 body-content">