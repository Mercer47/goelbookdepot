 <html>
<head>
<title>Login to Goel Book Depot Admin</title>
	<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/admin.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/css/icons/comic.png') ?>">
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
<body style="background: #2995bf" class="login">
	<div class="col-md-12 header" align="center">
        <p>GBD<sub style="font-size: 20px">ADMIN</sub></p>
	</div>

	<div class="col-md-12 body">
		<div class="col-md-4">

		</div>
		<div class="col-md-4">
            <?php echo form_open(site_url('login/login'), array('method' => 'POST')) ?>
			<form method="POST" action="<?php echo site_url('login/login') ?>">
				<input type="text" name="username" placeholder="Username" class="form-input" required>
				<br>
				<input type="password" name="password" placeholder="Password" class="form-input" required>
				<br>
				<div align="center">
					<button class="btn-sign-in">Login</button>
				</div>

			</form>
		</div>
		<div class="col-md-4">

		</div>
	</div>

</body>
</html>
