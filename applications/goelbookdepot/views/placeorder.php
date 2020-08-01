<?php $this->view('layouts/inner_page_header') ?>

<div class="col-xs-12 form-container">
    <form action="<?php echo site_url('home/payment'); ?>" method="POST">
        <br><br>
        <input
                type="text"
                name="name"
                class="form-input"
                placeholder="Full Name"
                value="<?php echo $user->name ?>"
        />
        <?php if (form_error('name')) { ?>
            <?php echo form_error('name',
                '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                '</div>')
            ?>
        <?php } ?>

        <br><br>
        <input
                type="text"
                name="contact"
                class="form-input"
                placeholder="Contact"
                value="<?php echo $user->phone ?>"
        />
        <?php if (form_error('contact')) { ?>
            <?php echo form_error('contact',
                '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                '</div>')
            ?>
        <?php } ?>

        <br><br>
        <input
                type="text"
                name="email"
                class="form-input"
                placeholder="Email"
                value="<?php echo $user->email ?>"
        />
        <?php if (form_error('email')) { ?>
            <?php echo form_error('email',
                '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                '</div>')
            ?>
        <?php } ?>

        <br><br>
        <input
                type="text"
                name="address"
                class="form-input"
                placeholder="Address"
                value="<?php echo $user->address ?>"
        />
        <?php if (form_error('address')) { ?>
            <?php echo form_error(
                'address',
                '<div class="invalid-bar"><i class="las la-exclamation-triangle"></i> ',
                '</div>')
            ?>
        <?php } ?>

        <br>
        <div class="col-md-12 payment-details">
            <p style="color: #00CC00">
                Amount: ₹<?php echo $amount; ?>
            </p>
            <p>
                Payment Mode: Credit/Debit Card
            </p>
            By now proceeding further, you agree to our
            <a href="terms">
                Terms
            </a> and that you have read our
            <a href="privacy">
                Privacy Policy.
            </a>
        </div>
        <div class="col-xs-12" align="center" style="margin-top: 50px;">
            <button class="btn-proceed">
                Proceed to Payment
            </button>
        </div>
    </form>
</div>
<?php $this->view('layouts/inner_page_footer') ?>