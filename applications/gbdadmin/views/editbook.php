<?php $this->view('header'); ?>
<div class="col-md-9">
    <style type="text/css">
        input, select {
            border: 1px solid;
            margin-bottom: 10px;
            width: 80%;
        }
    </style>
    <form method="POST" action="<?php echo site_url('home/updatebook'); ?>" enctype="multipart/form-data">

        <div class="col-md-12" style="padding: 30px;">
            <?php foreach ($book

            as $info) { ?>
            <input type="hidden" name="bookid" value="<?php echo $info->id; ?>">
            <input type="hidden" name="subcat" value="<?php echo $info->catno; ?>">
            <input type="hidden" name="lastcat" value="<?php echo $info->subno; ?>">
            <div class="col-md-4" align="left">
                <p class="book-form-heading">Title</p>
                <input type="text" class="book-form-input" name="title" value="<?php echo $info->title; ?>" required>
                <p class="book-form-heading">Author</p>
                <input type="text" class="book-form-input" name="author" value="<?php echo $info->Author; ?>">
                <p class="book-form-heading">Publisher</p>
                <input type="text" class="book-form-input" name="publisher" value="<?php echo $info->Publisher; ?>">
                <p class="book-form-heading">Medium</p>
                <select name="medium" class="book-form-input">
                    <option value="0">English</option>
                    <option value="1">Hindi</option>
                </select>
                <p class="book-form-heading">Shipping Charges</p>
                <input type="text" name="charges" class="book-form-input" value="<?php echo $info->charges; ?>" />

            </div>
            <div class="col-md-4" align="left">
                <p class="book-form-heading">Cover Image</p>
                <label for="cover" class="custom-file-upload"></label>
                <input type="file" class="book-form-input" name="cover" >
                <p class="book-form-heading">Backcover Image</p>
                <label for="backcover" class="custom-file-upload"></label>
                <input type="file" class="book-form-input" name="backcover" >
                <p class="book-form-heading">ISBN</p>
                <input type="number" class="book-form-input" name="isbn" value="<?php echo $info->ISBN; ?>">
                <p class="book-form-heading">Edition</p>
                <input type="number" class="book-form-input" name="edition" value="<?php echo $info->Edition; ?>">
                <p class="book-form-heading">Availability</p>
                <select name="avail" class="book-form-input">
                    <option value="1">In Stock</option>
                    <option value="0">Out of Stock</option>
                </select>

            </div>
            <div class="col-md-4">
                <p class="book-form-heading">Pages</p>
                <input type="number"  class="book-form-input"name="pages" value="<?php echo $info->Pages; ?>"><br>
                <p class="book-form-heading">Select Binding</p>
                <select name="bind" class="book-form-input">
                    <option value="Hard Cover">Hard Cover</option>
                    <option value="PaperBack">PaperBack</option>
                </select><br>
                <p class="book-form-heading">MRP</p>
                <input type="number" min="0" class="book-form-input" name="mrp" value="<?php echo $info->MRP; ?>" required>
                <p class="book-form-heading">Discount</p>
                <input type="number" class="book-form-input" name="discount" value="<?php echo $info->Discount; ?>" required>
            </div>

        </div>
        <?php } ?>


        <br>
        <div class="col-md-12" align="center" >
            <input type="submit" class="book-add-btn" name="" value="UPDATE BOOK">
        </div>


    </form>
</div>