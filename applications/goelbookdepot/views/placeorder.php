<?php $this->view('layouts/inner_page_header') ?>

<div class="col-xs-12 form-container">
    <form action="<?php echo site_url('home/payment'); ?>" method="POST">
        <br>
        <input type="text" name="name" class="form-input" placeholder="Full Name" required>
        <br><br>
        <input type="text" name="contact" class="form-input" placeholder="Contact" required>
        <br><br>
        <input type="text" name="email" class="form-input" placeholder="Email" required>
        <br><br>
        <input type="text" name="address" class="form-input" placeholder="Address" required>
        <br>
        <div class="col-md-12 payment-details">
            <p style="color: #00CC00">Amount: ₹<?php echo $amount; ?></p>
            <p>Payment Mode: Credit/Debit Card</p>
            By now proceeding further, you agree to our <a href="terms">Terms</a> and that you have read our <a
                    href="privacy">Privacy Policy.</a>
        </div>
        <div class="col-xs-12" align="center" style="margin-top: 50px;">
            <button class="btn-proceed">Proceed to Payment</button>
        </div>
    </form>
</div>
<?php $this->view('layouts/inner_page_footer') ?>