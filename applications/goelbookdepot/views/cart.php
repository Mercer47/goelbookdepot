<?php $this->view('layouts/inner_page_header') ?>
    <div class="col-xs-12 cart-header">
        <div align="left" class="col-xs-2">
            BOOKS(<?php echo $count; ?>)
        </div>
        <div align="right" class="col-xs-10	" style="color: #00CC00">
            Total: ₹<?php echo $total; ?>
        </div>
    </div>

<?php if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $sql = "SELECT * FROM books WHERE id=?";
            $query = $this->db->query($sql, $value);
            $result = $query->result();
            foreach ($result as $row) { ?>
                <div class="col-xs-12 col-lg-3 cart-item">
                    <div class="col-xs-4 col-lg-12">
                        <a href="" style=" color: black;"><img
                                    src="<?php echo base_url('assets/thumbnails/') . $row->image; ?>"
                                    class="img-cart"></a>
                    </div>
                    <div class="col-xs-8 col-lg-8 cart-item-detail">
                        <p><?php echo $row->title; ?></p>
                        <p>MRP: ₹<?php echo $row->MRP; ?></p>
                        <?php $price = 0;
                        if ($row->Discount != 0) {
                            $price = $row->MRP - $row->Discount / 100 * $row->MRP;
                            ?>
                            <p style="color: #00CC00">Your Price:
                                ₹<?php echo ceil($price) . "(" . $row->Discount . "% off" . ")"; ?></p>
                            <p style="color: #00CC00">You Save: ₹<?php echo ceil($row->MRP - $price); ?></p>
                            <?php
                        } ?>
                        <p style="color:#fbc02d;">+ Shipping charges: ₹<?php echo $row->charges; ?></p>
                            <?php if (!$row->availability) { ?>
                                <p style="color: #f95555; font-size: 20px"><i class="las la-exclamation-triangle"></i> Out of Stock</p>
                            <?php } ?>
                    </div>
                    <div class="col-xs-12 col-lg-12">
                            <form action="<?php echo site_url('home/cart') ?>" method="POST">
                                <input type="hidden" name="delid" value="<?php echo $row->id; ?>">
                                <button class="btn-remove-item"> REMOVE THIS BOOK</button>
                            </form>
                    </div>
                </div>

                <?php }
        }
    } $_SESSION['amount'] = $total;
?>

<div class="col-xs-12 col-lg-4">
    <div class="col-xs-12 cart-cost">
        <div class="col-xs-6" align="left">
            <p>Bag Total</p>
            <p><b>Total Payable</b></p>
        </div>
        <div class="col-xs-6" align="right">
            <p>₹<?php echo $total; ?></p>
            <p><b>₹<?php echo $total; ?></b></p>
        </div>
    </div>
    <?php if (!empty($_SESSION['cart']) && $total > 0 ) { ?>
        <a href="<?php echo site_url('home/placeorder'); ?>">
            <button class="btn-proceed">
                Proceed
            </button>
        </a>
    <?php } ?>
</div>

<div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
<script>
    $(window).on("load", function () {
        $(".loader-wrapper").fadeOut("slow");
    });
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>