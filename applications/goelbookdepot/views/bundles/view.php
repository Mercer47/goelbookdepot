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
    <div class="col-xs-12 add-sign">
        +
    </div>
    <?php } ?>
    <div class="col-xs-12 gift-box">
        <?= $bundle->gift ? $bundle->gift : 'Free Best Wishes'  ?>
    </div>
    <div class="col-xs-12 add-sign">
        =
    </div>
    <div class="col-xs-12 gift-box">
        <?php echo "Only for ₹".$bundle->effective_price." (".$bundle->discount."% off)" ?>
        <?php if ($bundleAsBook->availability) {?>
            <?php echo form_open(site_url('home/cart'), array('method' => 'POST')) ?>
                <input type="hidden" name="id" value="<?php echo $bundleAsBook->id; ?>">
                <button class="btn-add-cart"><i class="las la-cart-plus"></i> Add to Cart </button>
            </form>
        <?php } else { ?>
            <button class="btn-add-cart"><i class="las la-exclamation-triangle"></i> Out of Stock </button>
        <?php } ?>
    </div>

<?php $this->view('layouts/inner_page_footer') ?>