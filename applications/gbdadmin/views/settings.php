<?php $this->view('header') ?>

    <div class="col-md-10 settings-wrapper">
        <p style="padding-left: 30px">Categories</p>
            <?php foreach ($category as $row) { ?>
                    <div class="col-md-3 category-container">
                        <a href="<?php echo site_url('home/loadcategory/').$row->id; ?>">
                            <?php echo $row->name; ?>
                        </a>
                        <i onclick="myFunction(<?php echo $row->id; ?>)" class="las la-trash card-delete-icon" title="Delete"></i>
                    </div>

            <?php } ?>
        <div class="col-md-12 new-cat-form">
            <form method="POST" action="<?php echo site_url('home/newcategory') ?>">
                <p>Add New Category</p>
                <input type="text" required name="category">
                <br><br>
                <button>Add New Category</button>
            </form>
        </div>
    </div>
<script type="text/javascript">
    function myFunction(id) {

        var r = confirm("Are you sure ?");
        if (r == true) {
            location.href='<?php echo site_url('home/deletecategory/'); ?>'+id;
        } else {
            javascript:void(0);
        }
    }
</script>
</body>
</html>