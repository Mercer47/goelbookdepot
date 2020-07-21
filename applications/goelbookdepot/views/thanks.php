<?php
date_default_timezone_set("Asia/Kolkata");
if (!isset($_SESSION['cart'])) {
    redirect(site_url('home'));
}
else
{
    $sql="SELECT * FROM orders WHERE intent_id=?";
    $query=$this->db->query($sql,$_SESSION['order_id']);
    $result=$query->result();

    foreach ($result as $row){
        $name=$row->Name;
        $contact=$row->Contact;
        $email=$row->Email;
        $address=$row->Address;
    }

    $str=implode(",", $_SESSION['final_cart']);
    $total=$_SESSION['amount'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Goel Book Depot</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <style type="text/css">
        button:focus{
            outline: none;
        }
    </style>
    
</head>
<body style="background: #f2f2f2;">
    <div class="visible-xs visible-sm">
<h1 align="center">
    Goel Book Depot
</h1>
<p align="center">LOWER BAZAAR, SHIMLA 1</p>
<p>Name: <?php echo $name;  ?></p>
<p>Contact: <?php echo $contact;   ?></p>
<p>Address: <?php echo $address;  ?></p>
<p>Email: <?php echo $email;  ?></p>
<p>Date: <?php echo date("d-M-Y h:i:s"); ?></p>
<table class="table table-responsive" style="margin-top: 30px;">
    <tr>
        <th>Item No.</th>
        <th>Title</th>
        <th>MRP</th>
        <th>Discount</th>
        <th>Shipping Charges</th>
        <th>Your Price</th>
    </tr>
    <?php
    foreach ($_SESSION['cart'] as $key => $value) {
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
                <td><?php echo $row->MRP-ceil(($row->Discount/100)*$row->MRP)+($row->charges); ?></td>
            </tr>

           <?php
        }
    }
    $total=0;
    if(isset($_SESSION['cost'])) {
        foreach ($_SESSION['cost'] as $key => $value) {
            $total = $total + $value;
        }
    }
    ?>
    <tr>
        <td></td>
        <TD><b>Total</b></TD>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $total; ?></td>
    </tr>
</table>

<p align="center" style="font-size: 25px;"> Thanks!</p>
<p>To cancel order Please Leave a Message on Whatapp: 9418003053</p>
<button onclick="window.print()">Print</button>
<a href="index">Home</a>
    </div>

</body>
</html>
