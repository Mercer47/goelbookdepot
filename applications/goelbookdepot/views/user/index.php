<?php $this->view('layouts/user_header') ?>
    <div class="col-xs-12 col-lg-3">
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="col-md-12 error-bar">
                <i class="las la-exclamation-triangle"></i>
                <?php echo $this->session->flashdata('error') ?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="col-md-12 success-bar">
                <i class="las la-check-square"></i>
                <?php echo $this->session->flashdata('success') ?>
            </div>
        <?php } ?>
    </div>

    <?php if (!empty($orders)) { ?>
        <div class="col-xs-12 col-lg-12">
            <p class="account-details-heading hide-lg">Your Orders</p>
        </div>
        <?php foreach ($orders as $order) { ?>
            <?php foreach (json_decode($order->Items) as $id) {
                $book = $this->db->get_where('books', array('id' => $id))
                    ->first_row(); ?>
                <div class="col-xs-12 col-lg-2 orders-item cart-item">
                    <a href="<?php echo site_url('home/showbook/').$book->id ?>">
                        <div class="col-xs-4 col-lg-12">
                            <?php if ($book->image) { ?>
                                <img
                                        src="<?php echo base_url('assets/thumbnails/') . $book->image; ?>"
                                        style="width: 100%; padding-top: 10px"
                                        alt=""
                                />
                            <?php } else { ?>
                                <img
                                        src="<?php echo base_url('assets/icons/no-image.png') ?>"
                                        style="width: 100%; padding-top: 10px"
                                        alt=""
                                />
                            <?php } ?>
                        </div>
                    </a>
                    <div class="col-xs-8 col-lg-12">
                        <p class="book-title"><?php echo $book->title ?></p>
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