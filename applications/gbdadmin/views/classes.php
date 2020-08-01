<?php $this->view('header'); ?>
<div class="col-md-10 settings-wrapper">
    <p style="padding-left: 30px">Sub Categories</p>
    <?php foreach ($classes as $class) { ?>
        <div class="col-md-3 category-container">
            <a href="<?php echo site_url('home/loadClass/').$class->id; ?>">
                <?php echo $class->name; ?>
            </a>
            <i onclick="myFunction(<?php echo $class->id; ?>)" class="las la-trash card-delete-icon" title="Delete"></i>
        </div>
    <?php } ?>
    <div class="col-md-12 new-cat-form">
        <?php echo form_open(site_url('home/newclass'), array('method' => 'POST')) ?>
            <p>Add New Class</p>
            <input type="text" name="class" required >
            <input type="hidden" value="<?php echo $category; ?>" name="category">
            <br><br>
            <button>Add New Class</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    function myFunction(id) {

        var r = confirm("Are you sure ?");
        if (r == true) {
            location.href='<?php echo site_url('home/deleteclass/'); ?>'+id;
        } else {
            javascript:void(0);
        }
    }
</script>
</body>
</html>