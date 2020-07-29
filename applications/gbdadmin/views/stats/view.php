<?php $this->view('layouts/stats/header'); ?>

<div class="col-md-10">
    <div class="col-md-4" style="margin-top: 20px">
        <input type="text" name="daterange" class="book-form-input" id="daterange" value="<?php echo date("m/d/Y", strtotime("-7 days"))." - ".date("m/d/Y") ?>" />
    </div>
    <div class="col-md-12 graph">
        <p class="graph-heading"><i class="las la-coins"></i> Sales</p>
        <div id="sales" style="height: 250px;"></div>
    </div>
    <div class="col-md-12 graph">
        <p class="graph-heading"><i class="las la-shipping-fast"></i> Orders</p>
        <div id="orders" style="height: 250px;"></div>
    </div>
    <div class="col-md-12 graph">
        <p class="graph-heading"><i class="las la-users"></i> Customers Acquired</p>
        <div id="customers" style="height: 250px;"></div>
    </div>
</div>

<?php $this->view('layouts/stats/footer'); ?>