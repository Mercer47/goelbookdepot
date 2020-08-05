<?php $this->view('layouts/user_header') ?>
    <div class="col-md-10 col-lg-4 user-box">
        <?php echo form_open(site_url('user/updatepassword'), array('method' => 'POST')) ?>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="col-md-12 error-bar">
                    <i class="las la-exclamation-triangle"></i>
                    <?php echo $this->session->flashdata('error') ?>
                </div>
            <?php } ?>
            <p class="form-heading">
                Current Password
            </p>
            <input
                type="password"
                name="current"
                class="form-input"
            />
            <?php if (form_error('current')) { ?>
                <?php echo form_error('current',
                    '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                    '</div>')
                ?>
            <?php } ?>

            <p class="form-heading">
                New Password
            </p>
            <input
                type="password"
                name="new"
                class="form-input"
            />
            <?php if (form_error('new')) { ?>
                <?php echo form_error('new',
                    '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                    '</div>')
                ?>
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
                    '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                    '</div>')
                ?>
            <?php } ?>

            <input
                    type="hidden"
                    name="id"
                    value="<?php echo $userId ?>"
            />
            <button class="btn-sign-in">
                Update
            </button>

        </form>
    </div>
<?php $this->view('layouts/user_footer') ?>
