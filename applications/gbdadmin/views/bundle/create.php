<?php $this->view('header'); ?>

<div class="col-md-10">
    <div class="col-md-12 add-book-wrapper" style="padding: 30px;">
        <form method="POST" action="<?php echo site_url('home/insertBundle') ?>">
            <div class="col-md-6" align="left">
                    <p class="book-form-heading">Name</p>
                    <input type="text" name="name" class="book-form-input" required>
                <p class="book-form-heading">Price</p>
                <input type="text" class="book-form-input" id="price" readonly>
                <p class="book-form-heading">Gift</p>
                <input type="text" class="book-form-input" name="gift">
            </div>
            <div class="col-md-6">
                <p class="book-form-heading">Discount</p>
                <input type="number" min="0" name="discount" id="discount" class="book-form-input" required>
                <p class="book-form-heading">Effective Price</p>
                <input type="text" class="book-form-input" name="effective_price" id="effective_price" readonly>
            </div>
            <div class="col-md-12 bundle-wrapper">
                <table class="table table-responsive" id="table">
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>MRP</th>
                        <th>Discount</th>
                        <th>Shipping Charges</th>
                        <th>Availability</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($books as $book) { ?>
                        <tr>
                            <td><input type="checkbox" name="bundle_item[]" class="form-control" value="<?php echo $book->id ?>"></td>
                            <td><img src="<?php echo base_url('assets/thumbnails/') . $book->image; ?>" style="width: 50%;"></td>
                            <td><?php echo $book->title; ?></td>
                            <td><?php echo $book->MRP; ?></td>
                            <td><?php echo $book->Discount; ?></td>
                            <td><?php echo $book->charges; ?></td>
                            <td><?php echo $book->availability ? "In Stock" : "Out of Stock"; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <input type="submit" class="add-book-btn" name="" value="ADD BUNDLE">
        </form>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets\Datatables\DataTables-1.10.20\js\jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets\Datatables\DataTables-1.10.20\js\dataTables.bootstrap4.min.js') ?>"></script>
<script>
    $('input[type="checkbox"]').on("change",function() {
        if (this.checked) {
            var bookId = $(this).val();
            $.ajax({
                url: '<?php echo site_url('home/getBookCost') ?>',
                type: "POST",
                data: "id=" + bookId,
                success: function (res) {
                    var price = parseInt(res)+ parseInt($('#price').val() ? $('#price').val() : 0);
                    $('#price').val(price);
                }
            })
        } else {
            var bookId = $(this).val();
            $.ajax({
                url: '<?php echo site_url('home/getBookCost') ?>',
                type: "POST",
                data: "id=" + bookId,
                success: function (res) {
                    var price = parseInt($('#price').val() ? $('#price').val() : 0) - parseInt(res);
                    $('#price').val(price);
                    $('#discount').val(0);
                    $('#effective_price').val(0);
                }
            })
        }
    })

    $('#discount').on("change", function() {
        var discount =$(this).val();
        var price = $('#price').val();

        var effectivePrice = Math.ceil(price - (discount/100) * price);
        $('#effective_price').val(effectivePrice);

    })
</script>
<script>
    $(function(){
        $('#table').DataTable({
            "order": [[ 2, "desc" ]],
            responsive: true
        });
    });
</script>
<script type="text/javascript">
    function myFunction(id) {

        var r = confirm("Are you sure ?");
        if (r == true) {
            location.href='<?php echo site_url('home/deletebook/'); ?>'+id;
        } else {
            javascript:void(0);
        }
    }
</script>
</body>
</html>