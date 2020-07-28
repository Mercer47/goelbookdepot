<?php $this->view('layouts/user_header') ?>
    <?php if (!empty($orders)) {?>
        <div class="col-xs-12">
            <p class="account-details-heading">Your Orders</p>
        </div>
        <?php foreach ($orders as $order) { ?>
            <div class="col-xs-12 orders-item">
                <a href="<?php echo site_url('home/showbook/').$order->id ?>">
                    <div class="col-xs-4">
                        <img src="<?php echo base_url('assets/thumbnails/').$order->image;  ?>" class="img-cart"/>
                    </div>
                </a>
                <div class="col-xs-8">
                    <p><?php echo $order->title ?></p>
                    <p class="success-text"><?php echo $order->shipping_status ?></p>
                    <p class="purchase-info">Purchased on: <?php echo date('d F Y', strtotime($order->date)) ?></p>
                    <p class="purchase-info">Payment Status: <?php echo $order->status ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="col-xs-12 empty">
            Your Orders Appear here
        </div>
    <?php } ?>
<?php $this->view('layouts/user_footer') ?>