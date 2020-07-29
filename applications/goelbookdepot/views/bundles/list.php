<?php $this->view('layouts/inner_page_header'); ?>
<div class="col-md-12 bundle-wrapper">
    <?php foreach ($bundles as $bundle) { ?>
        <a href="<?php echo site_url('bundle/view/').$bundle->id ?>" style="color: black;">
            <div class="col-md-12 category-container">
                <?php echo $bundle->name ?>
                <br/>
                <?php echo "Only for ₹".$bundle->effective_price." (".$bundle->discount."% off)" ?>
                <br/>
                <?php echo $bundle->gift ?>
            </div>
        </a>
    <?php } ?>
</div>

<?php $this->view('layouts/inner_page_footer') ?>
