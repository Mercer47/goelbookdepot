<?php $this->view('header'); ?>
<div class="col-md-9">
    <?php echo form_open(site_url('home/createnewcategory'), array('method' => 'POST')) ?>
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
