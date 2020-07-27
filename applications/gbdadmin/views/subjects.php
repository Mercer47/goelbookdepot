<?php $this->view('header'); ?>
<div class="col-md-10 settings-wrapper">
    <p style="padding-left: 30px">Subjects</p>
    <?php foreach ($subjects as $subject) { ?>
        <div class="col-md-4 category-container">
            <p><?php echo $subject->name; ?>
                <i onclick="myFunction(<?php echo $subject->id; ?>)" class="las la-trash card-delete-icon" title="Delete"></i>
            </p>
        </div>
    <?php } ?>

    <div class="col-md-12 new-cat-form">
        <form method="POST" action="<?php echo site_url('home/newSubject') ?>">
            <p>Add New Subject</p>
            <input type="text" name="subject" required >
            <input type="hidden" value="<?php echo $class; ?>" name="class">
            <br><br>
            <button>Add New Subject</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    function myFunction(id) {

        var r = confirm("Are you sure ?");
        if (r == true) {
            location.href='<?php echo site_url('home/deletesubject/'); ?>'+id;
        } else {
            javascript:void(0);
        }
    }
</script>