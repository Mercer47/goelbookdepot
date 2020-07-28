<?php $this->view('layouts/user_header') ?>
    <div class="col-xs-12">
        <p class="account-details-heading">Personal Information</p>
        <p class="account-detail-label">Name</p>
        <p class="account-detail"><?php echo $details->name; ?></p>
        <p class="account-detail-label">Address</p>
        <p class="account-detail"><?php echo $details->address; ?></p>
        <p class="account-detail-label">Phone</p>
        <p class="account-detail"><?php echo $details->phone; ?></p>
        <p class="account-detail-label">Email</p>
        <p class="account-detail"><?php echo $details->email; ?></p>
        <p class="account-detail-label">Change Password</p>
    </div>
<?php $this->view('layouts/user_footer') ?>

