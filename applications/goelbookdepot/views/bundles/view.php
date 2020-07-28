<?php $this->view('layouts/inner_page_header'); ?>

    <?php foreach(json_decode($bundle->books) as $item) {
        $book = $this->db->get_where('books',array('id' => $item))->first_row(); ?>
        <div class="col-xs-12">
            <div class="col-xs-4">
                <img src="<?php echo base_url('assets/thumbnails/').$book->image ?>" style="width: 100%" />
            </div>
            <div class="col-xs-8">
                <p><?php echo $book->title ?></p>
            </div>
        </div>
    <?php } ?>


<?php $this->view('layouts/inner_page_footer') ?>