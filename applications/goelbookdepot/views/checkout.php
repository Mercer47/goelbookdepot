<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <script src="https://js.stripe.com/v3/"></script>
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
    <style>
        /**
     * The CSS shown here will not be introduced in the Quickstart guide, but shows
     * how you can use CSS to style your Element's container.
     */
        .StripeElement {
            box-sizing: border-box;
            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
        #card-button {
            background: #f95555;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            width: 100%;
            line-height: 40px;
            font-family: Questrial-regular, serif;
            font-size: 18px;
        }

        .checkout-heading
        {
            font-family: Questrial-regular, serif;
            font-size: 30px;
            width: 100%;
            padding-left: 10px;
        }
    </style>
</head>
<body style="background: #f2f2f2">
        <div class="col-lg-4"></div>
        <div class="col-md-12 col-lg-4 form-container user-box">
            <p class="checkout-heading">Complete Your Payment</p>
            <form id="payment-form">
                <div id="card-element">
                    <!-- Elements will create input elements here -->
                </div>

                <!-- We'll put the error messages in this element -->
                <div id="card-errors" role="alert"></div>
                <input type="hidden" name="client" id="client" value="<?php echo $intent->client_secret; ?>">
                    <button id="card-button">Pay</button>
            </form>
        </div>
    <div id="loader">

    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script>
        var stripe = Stripe('<?php echo $this->config->item('STRIPE_PUBLISH_KEY') ?>');
        var elements = stripe.elements();
    </script>
    <script>
        // Set up Stripe.js and Elements to use in checkout form
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        var card = elements.create("card", { style: style });
        card.mount("#card-element");
    </script>
    <script>
        var form = document.getElementById('payment-form');
        var clientSecret = document.getElementById('client').value;

        form.addEventListener('submit', function(ev) {
            $('#loader').html("  <div class=\"loader-wrapper\">\n" +
                "            <span class=\"loader\"><span class=\"loader-inner\"></span></span>\n" +
                "</div>")
            ev.preventDefault();
            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: '<?php echo $customerName ?>'
                    }
                }
            }).then(function(result) {
                if (result.error) {
                    // Show error to your customer (e.g., insufficient funds)
                    window.location.href = '<?php echo site_url('order/status/0?message=') ?>' + result.error.message;
                } else {
                    // The payment has been processed!
                    if (result.paymentIntent.status === 'succeeded') {
                        window.location.href = '<?php echo site_url('order/status/1?message=') ?>' + 'Payment Successful';
                        // Show a success message to your customer
                        // There's a risk of the customer closing the window before callback
                        // execution. Set up a webhook or plugin to listen for the
                        // payment_intent.succeeded event that handles any business critical
                        // post-payment actions.
                    }
                }
            });
        });
    </script>
</body>
</html>
