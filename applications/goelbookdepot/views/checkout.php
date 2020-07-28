<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <script src="https://js.stripe.com/v3/"></script>
</head>
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
<body>

    <div class="row">
        <div class="col-md-12">
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
    </div>
<script>
    var stripe = Stripe('pk_test_51H3hLRE7tUzyZRD9XNb1pTLxWGKIfhHtXHyoYb36uBOcmx4FJ0Cpb4FSuTeLHvLAPXlS8L0qXkN64XBND4Exhzht00dzWwWx4Q');
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
        ev.preventDefault();
        stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: card,
                billing_details: {
                    name: 'Mercer'
                }
            }
        }).then(function(result) {
            if (result.error) {
                // Show error to your customer (e.g., insufficient funds)
                console.log(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    window.location.href = '<?php echo site_url('user') ?>'
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
