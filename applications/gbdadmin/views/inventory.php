<?php $this->view('header'); ?>
<button onclick="location.href='<?php echo site_url('home/addbook') ?>'"  class="add-book-btn"><i class="las la-plus"></i> Add Book</button>
<div class="col-md-10 table-container">
    <table class="table table-responsive" id="table">
        <thead>
        <tr>
            <th>Modified</th>
            <th>Book ID</th>
            <th>Cover</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>MRP</th>
            <th>Discount</th>
            <th>Shipping Charges</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book) { ?>
            <tr>
                <td><?php echo $book->Timestamp; ?></td>
                <td><?php echo $book->id; ?></td>
                <td><img src="<?php echo base_url('assets/thumbnails/') . $book->image; ?>" style="width: 100%;"></td>
                <td><?php echo $book->title; ?></td>
                <td><?php echo $book->Author; ?></td>
                <td><?php echo $book->Publisher; ?></td>
                <td><?php echo $book->MRP; ?></td>
                <td><?php echo $book->Discount; ?></td>
                <td><?php echo $book->charges; ?></td>
                <td><?php echo $book->availability ? "In Stock" : "Out of Stock"; ?></td>
                <td>
                    <i class="las la-eye action-icon"
                       onclick="window.open('<?php echo base_url('index.php/home/showbook/') . $book->id; ?>')"
                       title="View book">
                    </i>
                    <i class="las la-edit action-icon"
                       onclick="location.href='<?php echo site_url('home/editbook/') . $book->id; ?>'"
                       title="Edit book">
                    </i>
                    <i class="las la-trash action-icon"
                       onclick="myFunction(<?php echo $book->id; ?>)"
                       title="Delete Book">
                    </i>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
    <?php $this->view('layouts/footer.php'); ?>
