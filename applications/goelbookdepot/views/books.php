<?php $this->view('layouts/inner_page_header') ?>
    <div class="col-md-12">
            <?php foreach ($books as $row) {?>
                <div class="col-xs-6 col-md-4 col-lg-3 book-container">
                    <a href="<?php echo site_url('home/showbook/') . $row->id; ?>">
                        <?php if ($row->image) { ?>
                            <img
                                    src="<?php echo base_url('assets/thumbnails/') . $row->image; ?>"
                                    class="book-image"
                                    alt=""
                            />
                        <?php } else { ?>
                            <img
                                    src="<?php echo base_url('assets/icons/no-image.png') ?>"
                                    class="book-image"
                                    alt=""
                            />
                        <?php } ?>
                        <p class="book-title"><?php echo $row->title; ?></p>
                    </a>
                    </div>
            <?php } ?>
    </div>
<?php $this->view('layouts/inner_page_footer') ?>