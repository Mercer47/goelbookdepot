<?php $this->view('layouts/inner_page_header') ?>
    <div class="col-md-12">
            <?php foreach ($books as $row) {?>
                    <div class="col-xs-6 col-md-4 col-lg-3 book-container">
                        <a href="<?php echo site_url('home/showbook/') . $row->id; ?>">
                            <img
                                    src="<?php echo base_url('assets/thumbnails/') . $row->image; ?>"
                                    class="book-image"
                                    alt=""
                            />
                            <p class="book-title"><?php echo $row->title; ?></p>
                        </a>
                    </div>
            <?php } ?>
    </div>
<?php $this->view('layouts/inner_page_footer') ?>