<?php $this->view('layouts/inner_page_header') ?>
    <div class="col-md-12" style="padding: 0px">
        <?php foreach ($topic as $row) { ?>
            <a href="<?php echo site_url('home/loadbooks/') . $row->id . '/' . $row->subno . '/' . $row->name; ?>">
                <div class="col-xs-5 col-sm-6 col-md-3 col-lg-2 subcategory-container">
                    <p class="subcategory-title"> <?php echo $row->name; ?></p>
                </div>
            </a>
        <?php } ?>
    </div>
<?php $this->view('layouts/inner_page_footer') ?>