<?php $this->view('layouts/header'); ?>
    <div class="col-lg-4"></div>
        <div class="col-md-12 col-lg-4 form-container user-box">
            <?php echo form_open(site_url('auth/signup'), array('method' => 'POST')) ?>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="col-md-12 error-bar">
                        <i class="las la-exclamation-triangle"></i>
                        <?php echo $this->session->flashdata('error') ?>
                    </div>
                <?php } ?>
                <p class="form-heading">
                    NAME
                </p>
                <input
                        type="text"
                        name="name"
                        class="form-input"
                        value="<?php echo set_value('name') ?>"
                />
                <?php if (form_error('name')) { ?>
                    <?php echo form_error('name',
                        '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                        '</div>')
                    ?>
                <?php } ?>

                <p class="form-heading">
                    ADDRESS
                </p>
                <input
                        type="text"
                        name="address"
                        class="form-input"
                        value="<?php echo set_value('address') ?>"
                />
                <?php if (form_error('address')) { ?>
                    <?php echo form_error(
                            'address',
                            '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                            '</div>')
                    ?>
                <?php } ?>

                <p class="form-heading">
                    PHONE
                </p>
                <input
                        type="text"
                        name="phone"
                        class="form-input"
                        value="<?php echo set_value('phone') ?>"
                />
                <?php if (form_error('phone')) { ?>
                    <?php echo form_error('phone',
                        '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                        '</div>')
                    ?>
                <?php } ?>

                <p class="form-heading">
                    EMAIL
                </p>
                <input
                        type="text"
                        name="email"
                        class="form-input"
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
                        name="password"
                        class="form-input"
                />
                <?php if (form_error('password')) { ?>
                    <?php echo form_error('password',
                        '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                        '</div>')
                    ?>
                <?php } ?>

                <p class="form-heading">
                    CONFIRM PASSWORD
                </p>
                <input
                        type="password"
                        name="confirm"
                        class="form-input"
                />
                <?php if (form_error('confirm')) { ?>
                    <?php echo form_error('confirm',
                        '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                        '</div>')
                    ?>
                <?php } ?>

                <button class="btn-sign-in">
                    Register
                </button>

                <p class="form-info">
                    Already have and Account?
                    <a href="<?php echo site_url('home/signin') ?>">
                        Log In</a>
                </p>
            </form>
        </div>
    <div class="col-lg-4"></div>
<?php $this->view('layouts/footer'); ?>
