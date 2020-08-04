<?php $this->view('layouts/inner_page_header'); ?>

    <?php foreach(json_decode($bundle->books) as $item) {
        $book = $this->db->get_where('books',array('id' => $item))->first_row(); ?>
        <div class="col-xs-12 bundle-wrapper">
            <a href="<?php echo site_url('home/showbook/').$book->id ?>">
                <div class="col-xs-4">
                    <img src="<?php echo base_url('assets/thumbnails/').$book->image ?>" style="width: 100%" />
                </div>
            </a>
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

    <div class="col-xs-12 gift-box" style="padding-bottom: 30px">
        <p style="color: #F8DC02">
            MRP:
            <?php echo "₹".$bundle->price ?>
        </p>
        <p>
            Your Price:
            <?php echo "₹".$bundle->effective_price." (".$bundle->discount."% off)" ?>
        </p>
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