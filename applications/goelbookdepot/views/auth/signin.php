<?php $this->view('layouts/header') ?>
    <div class="col-md-12 form-container">
        <form>
            <p class="form-heading">EMAIL</p>
            <input type="text" class="form-input" name="email" />
            <p class="form-heading">PASSWORD</p>
            <input type="password" class="form-input" name="password" />
            <br>
            <button class="btn-sign-in">Sign In</button>
            <p class="form-info">No Account? Create account <a href="<?php echo site_url('home/register') ?>">here</a></p>
        </form>
    </div>
<?php $this->view('layouts/footer') ?>