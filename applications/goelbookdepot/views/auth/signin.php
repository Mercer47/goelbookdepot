<?php $this->view('layouts/header') ?>
    <div class="col-lg-4"></div>
        <div class="col-md-12 col-lg-4 form-container user-box">
            <?php echo form_open(site_url('auth/signin'), array('method' => 'POST')) ?>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="col-md-12 col-lg-12 error-bar">
                        <i class="las la-exclamation-triangle"></i>
                        <?php echo $this->session->flashdata('error') ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="col-md-12 col-lg-12 success-bar">
                        <i class="las la-check-square"></i>
                        <?php echo $this->session->flashdata('success') ?>
                    </div>
                <?php } ?>

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
                    <?php echo form_error('email',
                        '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                        '</div>')
                    ?>
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
                    <?php echo form_error('password','<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ','</div>') ?>
                <?php } ?>

                <br>
                <button class="btn-sign-in">
                    Sign In
                </button>

                <p class="form-info">
                    Forgot Your Password?
                    <a href="<?php echo site_url('auth/reset') ?>">
                        Reset here
                    </a>
                </p>

                <p class="form-info">
                    No Account? Create account
                    <a href="<?php echo site_url('home/register') ?>">
                        here
                    </a>
                </p>

                <p class="form-info">
                    Did'nt Received Verification Email?
                    <a href="<?php echo site_url('auth/reverify') ?>">
                        Resend
                    </a>
                </p>
            </form>
        </div>
    <div class="col-lg-4"></div>
<?php $this->view('layouts/footer') ?>