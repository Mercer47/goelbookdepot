<?php $this->view('layouts/user_header') ?>
    <div class="col-xs-12">
        <p class="account-details-heading">
            Personal Information
        </p>

        <p class="form-heading">
            NAME
        </p>

        <input
                type="text"
                name="name"
                class="form-input"
                value="<?php echo $details->name; ?>"
        />

        <p class="form-heading">
            ADDRESS
        </p>

        <input
                type="text"
                class="form-input"
                name="address"
                value="<?php echo $details->address; ?>"
        />

        <p class="form-heading">
            PHONE
        </p>

        <input
                type="number"
                class="form-input"
                name="phone"
                value="<?php echo $details->phone; ?>"
        />

        <p class="form-heading">
            EMAIL
        </p>

        <input
                type="email"
                class="form-input"
                name="email"
                value="<?php echo $details->email; ?>"
        />

        <p class="account-detail-label">
            Change Password
        </p>
    </div>
<?php $this->view('layouts/user_footer') ?>

