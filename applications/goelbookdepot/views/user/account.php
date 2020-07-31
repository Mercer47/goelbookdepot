<?php $this->view('layouts/user_header') ?>
    <div class="col-xs-12">
        <form method="POST" action="<?php echo site_url('user/update') ?>">
            <p class="account-details-heading">
                Personal Information
            </p>

            <?php if ($this->session->flashdata('error')) { ?>
                <div class="col-md-12 error-bar">
                    <i class="las la-exclamation-triangle"></i>
                    <?php echo $this->session->flashdata('error') ?>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="col-md-12 success-bar">
                    <i class="las la-check-square"></i>
                    <?php echo $this->session->flashdata('success') ?>
                </div>
            <?php } ?>

            <p class="form-heading">
                NAME
            </p>
            <input
                    type="text"
                    name="name"
                    class="form-input"
                    value="<?php echo $details->name; ?>"
            />
            <?php if (form_error('name')) { ?>
                <?php echo form_error('name',
                    '<div class="error-bar"><i class="las la-exclamation-triangle"></i> ',
                    '</div>')
                ?>
            <?php } ?>

            <p class="form-heading">
                ADDRESS
            </p>
            <input
                    type="text"
                    class="form-input"
                    name="address"
                    value="<?php echo $details->address; ?>"
            />
            <?php if (form_error('address')) { ?>
                <?php echo form_error(
                    'address',
                    '<div class="error-bar"><i class="las la-exclamation-triangle"></i> ',
                    '</div>')
                ?>
            <?php } ?>

            <p class="form-heading">
                PHONE
            </p>
            <input
                    type="number"
                    class="form-input"
                    name="phone"
                    value="<?php echo $details->phone; ?>"
            />
            <?php if (form_error('phone')) { ?>
                <?php echo form_error('phone',
                    '<div class="error-bar"><i class="las la-exclamation-triangle"></i> ',
                    '</div>')
                ?>
            <?php } ?>

            <p class="form-heading">
                EMAIL
            </p>
            <input
                    type="email"
                    class="form-input"
                    name="email"
                    value="<?php echo $details->email; ?>"
                    readonly
            />

            <input type="hidden" name="id" value="<?php echo $details->id ?>">
            <button class="btn-sign-in">
                Update
            </button>
        </form>
        <p class="form-info">
            <a href="<?php echo site_url('user/changepassword')?>">Change Password</a>
        </p>
    </div>
<?php $this->view('layouts/user_footer') ?>

