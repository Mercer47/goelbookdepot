<?php $this->view('header'); ?>
<div class="col-md-10">
    <style type="text/css">
        input, select {
            border: 1px solid;
            margin-bottom: 10px;
            width: 80%;
        }
    </style>
    <?php echo form_open_multipart(site_url('home/insertbook'), array('method' => 'POST')) ?>
        <div class="col-md-12 add-book-wrapper" style="padding: 30px;">
            <div class="col-md-4" align="left">
                <p class="book-form-heading">Category</p>
                <select name="main" id="main" class="book-form-input">
                    <option>Select a Category</option>
                    <?php foreach ($category as $row) { ?>
                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                    <?php } ?>
                </select>
                <p class="book-form-heading">Title</p>
                <input type="text" name="title" class="book-form-input" required>
                <p class="book-form-heading">Author</p>
                <input type="text" name="author" class="book-form-input">
                <p class="book-form-heading">Publisher</p>
                <input type="text" name="publisher" class="book-form-input">
                <p class="book-form-heading">Medium</p>
                <select name="medium" class="book-form-input">
                    <option value="0">English</option>
                    <option value="1">Hindi</option>
                </select>
                <p class="book-form-heading">Shipping Charges</p>
                <input type="text" name="charges" class="book-form-input"/>

            </div>
            <div class="col-md-4" align="left">
                <p class="book-form-heading">Subcategory</p>
                <select name="subcat" id="subcat" class="book-form-input">
                    <option>Select a Category first</option>
                </select>
                <p class="book-form-heading">Cover Image</p>
                <input type="file" id="cover" name="cover" class="custom-file-upload">
                <p class="book-form-heading">Backcover Image</p>
                <input type="file" id="backcover" name="backcover" class="custom-file-upload">
                <p class="book-form-heading">ISBN</p>
                <input type="number" name="isbn" class="book-form-input">
                <p class="book-form-heading">Edition</p>
                <input type="number" name="edition" class="book-form-input">
            </div>
            <div class="col-md-4">
                <p class="book-form-heading">Class</p>
                <select name="lastcat" id="lastcat" class="book-form-input">
                    <option>Select a Subcategory first</option>
                </select>
                <p class="book-form-heading">Pages</p>
                <input type="number" name="pages" class="book-form-input"><br>
                <p class="book-form-heading">Select Binding</p>
                <select name="bind" class="book-form-input">
                    <option value="Hard Cover">Hard Cover</option>
                    <option value="PaperBack">PaperBack</option>
                </select><br>
                <p class="book-form-heading">MRP</p>
                <input type="number" name="mrp" class="book-form-input" required>
                <p class="book-form-heading">Discount</p>
                <input type="number" name="discount" class="book-form-input">
            </div>
        </div>

        <div class="col-md-12" align="center">
            <input type="submit" class="book-add-btn" name="" value="ADD BOOK">
        </div>


    </form>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#main").on("change", function () {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "<?php echo site_url('home/selection') ?>",
                        type: "POST",
                        data: {
                            id : id,
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        success: function (html) {
                            $("#subcat").html(html);
                            $("#lastcat").html("<option>Select sub category first</option>");
                        }
                    });
                } else {
                    $("#subcat").html("<option>Select category first</option>");
                    $("#lastcat").html("<option>Select sub category first</option>");
                }
            });

            $("#subcat").on("change", function () {
                var subID = $(this).val();
                if (subID) {
                    $.ajax({
                        url: "<?php echo site_url('home/selection') ?>",
                        method: "POST",
                        data: {
                            subid : subID,
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        success: function (html) {
                            $("#lastcat").html(html);
                        }
                    });
                } else {
                    $("#lastcat").html("<option>Select sub category first</option>");
                }
            });

        });
    </script>
</div>