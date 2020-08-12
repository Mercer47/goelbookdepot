<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <style>
        @font-face{
            font-family: Nunito-regular;
            src: url(<?php echo base_url('assets/fonts/Nunito-regular.ttf'); ?>);
        }

        @font-face{
            font-family: Questrial-regular;
            src: url(<?php echo base_url('assets/fonts/Questrial-regular.ttf'); ?>);
        }
    </style>
    <?php $this->view('loader/style') ?>

</head>
<body style="background: #f2f2f2">
        <div class="col-lg-4"></div>
        <div class="col-md-12 col-lg-4 form-container user-box">
            <p class="checkout-heading">Complete Your Payment</p>
            <button id="rzp-button1" class="btn-sign-in">Pay Now</button>
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script>
                var options = {
                    "key": "<?php echo $this->config->item('RAZORPAY_API') ?>", // Enter the Key ID generated from the Dashboard
                    "amount": <?php echo $amount ?>, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": "Goel Book Depot",
                    "description": "Books Purchase",
                    "image": "<?php echo base_url('assets/icons/book.png') ?>",
                    "order_id": "<?php echo $razorpayOrderId ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (response){
                        $.ajax({
                            url: '<?php echo site_url('order/verify') ?>',
                            type: 'POST',
                            data: { response : response,
                                orderId : "<?php echo $razorpayOrderId ?>",
                                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function (res) {
                                if (res === "200") {
                                    window.location.href = '<?php echo site_url('order/status/1?message=').urlencode("Payment Successful") ?>'
                                } else {
                                    window.location.href = '<?php echo site_url('order/status/0?message=').urlencode("Payment Failed") ?>'
                                }
                            }
                        })

                    },
                    "prefill": {
                        "name": "<?php echo $details['Name'] ?>",
                        "email": "<?php echo $details['Email'] ?>",
                        "contact": "<?php echo $details['Contact'] ?>"
                    },
                    "notes": {
                        "address": "<?php echo $details['Address'] ?>"
                    },
                    "theme": {
                        "color": "#F95555"
                    }
                };
                var rzp1 = new Razorpay(options);
                $(document).ready(function(){
                    rzp1.open();
                });
                document.getElementById('rzp-button1').onclick = function(e) {
                    rzp1.open();
                    e.preventDefault();
                }
            </script>
        </div>
    <div id="loader">

    </div>
</body>
</html>
