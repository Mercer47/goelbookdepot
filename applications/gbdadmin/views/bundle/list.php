<?php $this->view('header'); ?>
<button onclick="location.href='<?php echo site_url('home/createBundle') ?>'"
        class="add-book-btn">
    <i class="las la-plus"></i> Create</button>

<div class="col-md-10 settings-wrapper">
    <p style="padding-left: 30px">Bundles</p>
        <?php foreach($bundles as $bundle) { ?>
            <div class="col-md-3 category-container">
                <a href="<?php echo site_url('home/loadBundle/').$bundle->id; ?>">
                    <?php echo $bundle->name; ?>
                </a>
                <i onclick="myFunction(<?php echo $bundle->id; ?>)" class="las la-trash card-delete-icon" title="Delete"></i>
            </div>
        <?php } ?>
</div>

<script type="text/javascript">
    function myFunction(id)
    {
        var r = confirm("Are you sure ?");
        if (r == true) {
            location.href='<?php echo site_url('home/deleteBundle/'); ?>'+id;
        } else {
            javascript:void(0);
        }
    }
</script>
</body>
</html>