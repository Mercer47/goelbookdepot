<?php $this->view('header'); ?>
<div class="col-md-9">
    <form method="POST" action="<?php echo site_url('home/createnewcategory'); ?>">
        <p>Category Name</p>
        <input type="text" name="category" required >
        <p>Subcategory Name</p>
        <input type="text" name="subcategory" required>
        <p>Class Name</p>
        <input type="text" name="class" required>
        <br>
        <br>
        <button type="submit">Save</button>
    </form>
</div>
