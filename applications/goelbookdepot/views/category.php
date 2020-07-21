<?php $this->view('layouts/inner_page_header') ?>
<div class="col-md-12">
    <?php foreach ($subcategory as $row) { ?>
        <a href="<?php echo site_url('home/subcategory/') . $row->id . '/' . $row->name; ?>" style="color: black;">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 category-container">
                <p> <?php echo $row->name; ?></p>
            </div>
        </a>
        <?php } ?>
</div>
<?php $this->view('layouts/inner_page_footer'); ?>

