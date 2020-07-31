<?php $this->view('layouts/user_header') ?>
    <?php if (!empty($orders)) { ?>
        <div class="col-xs-12">
            <p class="account-details-heading">Your Orders</p>
        </div>
        <?php foreach ($orders as $order) { ?>
            <?php foreach (json_decode($order->Items) as $id) {
                $book = $this->db->get_where('books', array('id' => $id))
                    ->first_row(); ?>
                <div class="col-xs-12 orders-item">
                    <a href="<?php echo site_url('home/showbook/').$book->id ?>">
                        <div class="col-xs-4">
                            <img src="<?php echo base_url('assets/thumbnails/').$book->image;  ?>" class="img-cart"/>
                        </div>
                    </a>
                    <div class="col-xs-8">
                        <p><?php echo $book->title ?></p>
                        <p class="success-text"><?php echo $order->shipping_status ?></p>
                        <p class="purchase-info">Purchased on: <?php echo date('d F Y', strtotime($order->Timestamp)) ?></p>
                        <p class="purchase-info">Payment Status: <?php echo $order->Status ?></p>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } else { ?>
        <div class="col-xs-12 empty">
            <p style="">Your Orders Appear here</p>
        </div>
    <?php } ?>
<?php $this->view('layouts/user_footer') ?>