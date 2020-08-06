<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/css/icons/comic.png') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
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
    <?php $this->view('loader/style') ?>
</head>

<body style="background: #f95555">
<div class="col-lg-4"></div>
    <div class="col-xs-12 col-lg-4" style="position: relative; top: 30%; text-align: center;">
        <?php if ($status) { ?>
        <i class="las la-check-circle" style="color: #ffffff; font-size: 100px; margin-bottom: 20px;"></i>
        <p style="font-family: Questrial-regular,serif; font-size: 30px; color: #ffffff;"><?php echo urldecode($message) ?></p>
        <?php } else { ?>
        <i class="las la-times-circle" style="color: #ffffff; font-size: 100px; margin-bottom: 20px;"></i>
        <p style="font-family: Questrial-regular,serif; font-size: 30px; color: #ffffff;"><?php echo urldecode($message) ?></p>
        <?php } ?>
        <button style="background: transparent;
        border: 2px solid #ffffff;
        color: #ffffff;
        line-height: 30px;
        width: 50%;
        margin-top: 20px;
        font-size: 20px;
        font-family: Questrial-regular,serif;"
                onclick="location.href='<?php echo site_url('user') ?>'">
            <i class="las la-arrow-left"></i> Your Orders</button>
    </div>
</body>
</html>
