<?php $this->view('layouts/header'); ?>

<div class="col-lg-4"></div>
<div class="col-md-10 col-lg-4 form-container user-box">
    <?php echo form_open(site_url('auth/updatepassword'), array('method' => 'POST')) ?>
        <p class="form-heading">
            New Password
        </p>
        <input
            type="password"
            name="password"
            class="form-input"
        />
        <?php if (form_error('password')) { ?>
            <?php echo form_error('password','<div class="error-bar"><i class="las la-exclamation-triangle"></i> ','</div>') ?>
        <?php } ?>

        <p class="form-heading">
            Confirm New Password
        </p>
        <input
            type="password"
            name="confirm"
            class="form-input"
        />
        <?php if (form_error('confirm')) { ?>
            <?php echo form_error('confirm',
                '<div class="error-bar"><i class="las la-exclamation-triangle"></i> ',
                '</div>')
            ?>
        <?php } ?>

        <input
                type="hidden"
                name="email"
                value="<?php echo urldecode($email) ?>"
        />
        <button class="btn-sign-in">
            Update
        </button>
    </form>
</div>
<div class="col-lg-4"></div>

<?php $this->view('layouts/footer'); ?>
