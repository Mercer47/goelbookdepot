<?php $this->view('layouts/inner_page_header') ?>

    <?php foreach ($category as $row) { ?>
        <div class="col-xs-6" style="background: white; font-family: 'Cabin Condensed', sans-serif; font-size: 30px; border: 2px solid black;padding: 0px;"
             align="center">
            <a href="<?php echo site_url('home/category/') . $row->id . '/' . $row->name; ?>">
                <img src="<?php echo base_url('assets/') . $row->image; ?>" class="img img-responsive">
            </a>
        </div>
    <?php } ?>
<?php $this->view('layouts/inner_page_footer') ?>