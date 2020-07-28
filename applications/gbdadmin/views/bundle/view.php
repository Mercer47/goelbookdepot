<?php $this->view('header'); ?>
<button onclick="location.href='<?php echo site_url('home/deleteBundle/').$bundle->id ?>'"
        class="add-book-btn">
    <i class="las la-trash"></i> Delete</button>
<div class="col-md-10 settings-wrapper">
    <p style="padding-left: 30px"><?php echo $bundle->name ?></p>
    <div class="col-md-4">
        <p class="book-form-heading">Effective Price</p>
        <input type="text" class="book-form-input" readonly value="<?php echo $bundle->price ?>" />
    </div>
    <div class="col-md-4">
        <p class="book-form-heading">Discount</p>
        <input type="text" class="book-form-input" readonly value="<?php echo $bundle->discount."%" ?>" />
    </div>
    <div class="col-md-4">
        <p class="book-form-heading">Gift</p>
        <input type="text" class="book-form-input" readonly value="<?php echo $bundle->gift ?>" />
    </div>
    <div class="col-md-12 bundle-wrapper">
        <?php foreach (json_decode($bundle->books) as $item) {
            $book = $this->db->get_where('books',array('id' => $item))->first_row(); ?>
            <div class="col-md-3">
                <img src="<?php echo base_url('assets/thumbnails/').$book->image ?>" style="width: 100%" />
                <p class="bundle-item-title"><?php echo $book->title ?></p>
            </div>
        <?php } ?>
    </div>
</div>