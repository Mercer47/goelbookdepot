<?php $this->view('header'); ?>
<div class="col-md-10">
	<div class="col-md-5 admin-home-nav"  onclick="location.href='<?php echo site_url('home/orders') ?>'">
        <i class="las la-shipping-fast"></i>
        ORDERS
    </div>
    <div class="col-md-5 admin-home-nav"  onclick="location.href='<?php echo site_url('home/settings') ?>'">
        <i class="las la-cog"></i>
        SETTINGS
    </div>
    <div class="col-md-5 admin-home-nav"  onclick="location.href='<?php echo site_url('home/inventory') ?>'">
        <i class="las la-warehouse"></i>
        INVENTORY
    </div>
    <div class="col-md-5 admin-home-nav"  onclick="location.href='<?php echo site_url('home/bundles') ?>'">
        <i class="lab la-buffer"></i>
        BUNDLES
    </div>
    <div class="col-md-5 admin-home-nav"  onclick="location.href='<?php echo site_url('stats') ?>'">
        <i class="las la-chart-bar"></i>
        STATS
    </div>
    <div class="col-md-5 admin-home-nav"  onclick="location.href='<?php echo site_url('home/logout') ?>'">
        <i class="las la-sign-out-alt"></i>
        LOGOUT
    </div>
</div>
