<?php $this->view('layouts/header'); ?>

<div class="col-md-12 form-container">
    <form method="POST" action="<?php echo site_url('auth/signup') ?>">
        <p class="form-heading">NAME</p>
        <input type="text" name="name" class="form-input">
        <p class="form-heading">ADDRESS</p>
        <input type="text" name="address" class="form-input">
        <p class="form-heading">EMAIL</p>
        <input type="text" name="email" class="form-input" />
        <p class="form-heading">PASSWORD</p>
        <input type="password" name="password" class="form-input" />
        <p class="form-heading">CONFIRM PASSWORD</p>
        <input type="password" name="" class="form-input" />
        <button class="btn-sign-in">Register</button>
        <p class="form-info">Already have and Account? <a href="<?php echo site_url('home/signin') ?>">Log In</a></p>
    </form>
</div>

<?php $this->view('layouts/footer'); ?>
