<?php $this->view('layouts/header') ?>
    <div class="col-md-10">
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

        <?php echo form_open(site_url('auth/sendresetlink'), array('method' => 'POST')) ?>
            <p class="form-heading">
                EMAIL
            </p>
            <input
                type="email"
                name="email"
                class="form-input"
                value="<?php echo set_value('email') ?>"
            />
            <button class="btn-sign-in">
                Send Reset Link
            </button>
        </form>
    </div>
<?php $this->view('layouts/footer') ?>
