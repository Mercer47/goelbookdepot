<?php $this->view('layouts/inner_page_header') ?>
    <div class="col-xs-12 col-md-12 col-lg-12">
        <?php foreach ($category as $row) { ?>
            <div class="col-xs-6 col-lg-3" style="padding: 5px; margin-top: 10px"
                 align="center">
                <a href="<?php echo site_url('home/category/') . $row->id . '/' . $row->name; ?>">
                    <img src="<?php echo base_url('assets/') . $row->image; ?>" class="img img-responsive">
                </a>
            </div>
        <?php } ?>
    </div>
<?php $this->view('layouts/inner_page_footer') ?>