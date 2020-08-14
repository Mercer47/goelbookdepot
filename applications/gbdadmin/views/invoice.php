<?php

foreach($data as $row)
{
    $items = json_decode($row->Items);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Goel Book Depot</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>
<h1 align="center">
    Goel Book Depot
</h1>
<p align="center">LOWER BAZAAR, SHIMLA 1</p>
<?php foreach($data as $row) { ?>
<p>Name: <?php echo $row->Name;  ?></p>
<p>Contact: <?php echo $row->Contact;  ?></p>
<p>Address: <?php echo $row->Address;  ?></p>
<p>Email: <?php echo $row->Email;  ?></p>
<p>Date/Time: <?php echo date('d-M Y H:i A ',strtotime($row->Timestamp)); ?></p>
    <?php echo form_open(site_url('home/changeShippingStatus'), array('method' => 'POST')) ?>
        <p>Shipping Status</p>
        <input type="hidden" name="order_id" value="<?php echo $row->OrderId; ?>"  />
        <select name="shipping_status">
            <option value="<?php echo $row->shipping_status ?>" selected><?php echo $row->shipping_status ?></option>
            <option value="Shipped">Shipped</option>
            <option value="Delivered">Delivered</option>
            <option value="Canceled">Canceled</option>
            <option value="Order Received">Order Received</option>
        </select>
        <button>Update Status</button>
    </form>
<?php } ?>
<table class="table table-responsive">
    <tr>
        <th>Item No.</th>
        <th>Title</th>
        <th>MRP</th>
        <th>Discount</th>
        <th>Shipping Charges</th>
        <th>Customer Price</th>
    </tr>
    <?php foreach ($items as $key => $value) {
    $sql="SELECT * FROM books WHERE id=?";
    $query=$this->db->query($sql,$value);
    $result=$query->result();
    $count=0;
    foreach($result as $row) {
        $count=$count+1;
        $discount = $row->Discount;
        $charges = $row->charges;
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row->title; ?></td>
            <td><?php echo $row->MRP; ?></td>
            <td><?php echo $row->Discount."%"; ?></td>
            <td><?php echo $row->charges; ?></td>
            <td><?php echo $row->MRP-floor(($row->Discount/100)*$row->MRP)+($row->charges); ?></td>
        </tr>
        <?php
    }

}
?>
    <tr>
        <td></td>
        <TD><b>Total</b></TD>
        <td></td>
        <td></td>
        <td></td>
        <th><?php foreach($data as $row) {  echo $row->Total; }?></th>
    </tr>
</table>

<div>
    <button onclick="window.print()">Print</button>
    </div>
    
</body>
</html>