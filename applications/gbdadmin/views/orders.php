<?php $this->view('header'); ?>
    <div class="col-md-10 table-container">
        <table class="table table-responsive" id="table">
            <thead>
                <tr>
                    <th>Date /Time</th>
                    <th>Order Id</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $row) { ?>
            <tr>
                <td><?php echo $row->Timestamp; ?></td>
                <td><?php echo $row->OrderId; ?></td>
                <td><?php echo $row->Name; ?></td>
                <td><?php echo $row->Total; ?></td>
                <td><?php echo $row->Address; ?></td>
                <td><?php echo $row->Email; ?></td>
                <td><?php echo $row->Contact; ?></td>
                <td><?php echo $row->Status; ?></td>
                <td><i class="las la-eye" onclick="location.href='<?php echo site_url('home/generateinvoice/') . $row->OrderId; ?>'" style="cursor: pointer; font-size: 20px;" title="View"></i></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php $this->view('layouts/footer.php'); ?>
