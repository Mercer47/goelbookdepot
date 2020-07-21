<?php $this->view('layouts/inner_page_header'); ?>
    <div class="col-lg-12">
        <?php foreach ($book as $row) { ?>
            <div class="col-xs-12 col-lg-6">
                    <div class="col-xs-2 col-lg-2 book-preview-side" align="left">
                        <img src="<?php echo base_url('assets/thumbnails/') . $row->image; ?>"
                             style="width:100%; " onclick="myFunction(this);">
                    </div>

                    <div class="col-xs-8 col-lg-7 book-preview-main">
                        <img id="expandedImg" style="width:100%"
                             src="<?php echo base_url('assets/thumbnails/') . $row->image; ?>">

                        <div id="imgtext"></div>
                    </div>

                    <div class="col-xs-2 col-lg-2 book-preview-side" align="right">
                        <img src="<?php echo base_url('assets/thumbnails/') . $row->backimg; ?>"
                             style="width:100%;" onclick="myFunction(this);">
                    </div>
            </div>
            <div class="col-xs-12 col-lg-6 book-detail">
                <p><?php echo $row->title; ?></p>
                <p>MRP: ₹<?php echo $row->MRP; ?></p><?php $price = 0;
                $price = $row->MRP - $row->Discount / 100 * $row->MRP;
                ?>
                <p style="color: #00CC00">Your Price:
                    ₹<?php echo intval($price) . " (" . $row->Discount . "% off" . ")"; ?></p>
                <p style="color:#fbc02d;">+ Shipping Charges: ₹<?php echo $row->charges ? $row->charges : 0; ?></p>
                <p style="color: #00CC00">You Save: ₹<?php echo intval($row->MRP - $price); ?></p>
                <div class="col-xs-12 col-lg-6 ">
                    <?php if ($row->availability) {  ?>
                        <form action="<?php echo site_url('home/cart'); ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                            <input type="hidden" name="price" value="<?php echo intval($price + $row->charges); ?>">
                            <button class="btn-add-cart"><i class="las la-cart-plus"></i> Add to Cart </button>
                        </form>
                <?php } else { ?>
                    <button class="btn-add-cart"><i class="las la-exclamation-triangle"></i> Out of Stock </button>
                <?php } ?>
                </div>
            </div>
            <div class="col-xs-12 col-lg-6 book-detail">
                <p style="">Product Details:</p>
                <ul>
                    <li>Language: <?php if ($row->Medium == 0) {
                            echo "English";
                        } else {
                            echo "Hindi";
                        } ?></li>
                    <li>Binding: <?php echo $row->Binding; ?></li>
                    <li>Publisher: <?php echo $row->Publisher; ?></li>
                    <li>ISBN: <?php echo $row->ISBN; ?></li>
                    <li>Edition: <?php echo $row->Edition; ?></li>
                    <li>Pages: <?php echo $row->Pages; ?></li>
                </ul>
            </div>
            <div class="col-xs-12 book-detail">
                <p>Similar Products</p>
            </div>
        <?php } ?>
    </div>
<?php $this->view('layouts/inner_page_footer') ?>