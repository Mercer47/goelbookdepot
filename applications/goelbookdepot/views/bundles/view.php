<?php $this->view('layouts/inner_page_header'); ?>
    <div class="col-lg-12">
        <?php foreach(json_decode($bundle->books) as $item) {
            $book = $this->db->get_where('books',array('id' => $item))->first_row(); ?>
            <div class="col-xs-12 col-lg-2 bundle-wrapper cart-item">
                <a href="<?php echo site_url('home/showbook/').$book->id ?>">
                    <div class="col-xs-4 col-lg-12">
                        <img src="<?php echo base_url('assets/thumbnails/').$book->image ?>" style="width: 100%" />
                    </div>
                </a>
                <div class="col-xs-8 col-lg-12">
                    <p><?php echo $book->title ?></p>
                </div>
            </div>
            <div class="col-xs-12 col-lg-1 add-sign">
                +
            </div>
        <?php } ?>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-4"></div>
        <div class="col-xs-12 col-lg-4 gift-box">
            <?= $bundle->gift ? $bundle->gift : 'Free Best Wishes'  ?>
        </div>
        <div class="col-lg-4"></div>
    </div>

    <div class="col-xs-12 col-lg-1 add-sign hide-lg">
        =
    </div>

    <div class="col-lg-12">
        <div class="col-lg-4"></div>
        <div class="col-xs-12 col-lg-4 user-box" style="padding-bottom: 30px; font-family: Questrial-regular,serif">
            <p style="color: #f95555">
                MRP:
                <?php echo "₹".$bundle->price ?>
            </p>
            <p style="color: #00CC00">
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
        <div class="col-lg-4"></div>
    </div>

<?php $this->view('layouts/inner_page_footer') ?>