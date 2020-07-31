<?php $this->view('layouts/header') ?>
    <div class="col-md-12 form-container">
        <form method="POST" action="<?php echo site_url('auth/signin') ?>">
            <p class="form-heading">
                EMAIL
            </p>

            <input
                    type="text"
                    class="form-input"
                    name="email"
                    value="<?php echo set_value('email') ?>"
            />

            <?php if (form_error('email')) { ?>
                <?php echo form_error('email','<div class="error-bar"><i class="las la-exclamation-triangle"></i> ','</div>') ?>
            <?php } ?>

            <p class="form-heading">
                PASSWORD
            </p>

            <input
                    type="password"
                    class="form-input"
                    name="password"
                    value="<?php echo set_value('password') ?>"
            />

            <?php if (form_error('password')) { ?>
                <?php echo form_error('password','<div class="error-bar"><i class="las la-exclamation-triangle"></i> ','</div>') ?>
            <?php } ?>

            <br>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="col-md-12 error-bar">
                    <i class="las la-exclamation-triangle"></i>
                    <?php echo $this->session->flashdata('error') ?>
                </div>
            <?php } ?>

            <button class="btn-sign-in">
                Sign In
            </button>

            <p class="form-info">
                No Account? Create account
                <a href="<?php echo site_url('home/register') ?>">
                    here
                </a>
            </p>
        </form>
    </div>
<?php $this->view('layouts/footer') ?>