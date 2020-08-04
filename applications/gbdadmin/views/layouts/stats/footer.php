<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $('input[name="daterange"]').daterangepicker({
        maxDate: '<?php echo date("m/d/Y")  ?>'
    });
    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        $.ajax({
            url: '<?php echo site_url('stats/getData') ?>',
            type: 'POST',
            data: {
                'startDate': picker.startDate.format('YYYY-MM-DD'),
                'endDate': picker.endDate.format('YYYY-MM-DD'),
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function (res) {
                var data = JSON.parse(res);
                var salesData = [];
                for (const property in data.salesData) {
                    salesData.push({ year: property, value: data.salesData[property] })
                }
                $('#sales').empty();
                    new Morris.Line({
                        // ID of the element in which to draw the chart.
                        element: 'sales',
                        // Chart data records -- each entry in this array corresponds to a point on
                        // the chart.
                        data: salesData,
                        // The name of the data record attribute that contains x-values.
                        xkey: 'year',
                        // A list of names of data record attributes that contain y-values.
                        ykeys: ['value'],
                        // Labels for the ykeys -- will be displayed when you hover over the
                        // chart.
                        labels: ['INR ₹'],
                        xLabels: 'day'
                    });

                var customerData = [];
                for (const property in data.customerData) {
                    customerData.push({ year: property, value: data.customerData[property] })
                }
                $('#customers').empty();
                new Morris.Line({
                    // ID of the element in which to draw the chart.
                    element: 'customers',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: customerData,
                    // The name of the data record attribute that contains x-values.
                    xkey: 'year',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['value'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Customers Acquired'],
                    xLabels: 'day',
                });

                var orderData = [];
                for (const property in data.orderData) {
                    orderData.push({ year: property, value: data.orderData[property] })
                }
                $('#orders').empty();
                new Morris.Line({
                    // ID of the element in which to draw the chart.
                    element: 'orders',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: orderData,
                    // The name of the data record attribute that contains x-values.
                    xkey: 'year',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['value'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['No. of Orders'],
                    xLabels: "day",
                });
            }

        })
        // console.log(picker.startDate.format('YYYY-MM-DD'));
        // console.log(picker.endDate.format('YYYY-MM-DD'));
    });
</script>
<script>
    var salesData = [];

    <?php foreach($salesData as $key => $value) { ?>
    salesData.push({ year: '<?php echo $key ?>', value: <?php echo $value ?> })
    <?php } ?>

    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'sales',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: salesData,
        // The name of the data record attribute that contains x-values.
        xkey: 'year',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['INR ₹'],
        xLabels: 'day'
    });

    var orderData = [];

    <?php foreach($orderData as $key => $value) { ?>
    orderData.push({ year: '<?php echo $key ?>', value: <?php echo $value ?> })
    <?php } ?>

    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'orders',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: orderData,
        // The name of the data record attribute that contains x-values.
        xkey: 'year',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['No. of Orders'],
        xLabels: "day",
    });

    var customerData = [];

    <?php foreach($customerData as $key => $value) { ?>
    customerData.push({ year: '<?php echo $key ?>', value: <?php echo $value ?> })
    <?php } ?>
    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'customers',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: customerData,
        // The name of the data record attribute that contains x-values.
        xkey: 'year',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Customers Acquired'],
        xLabels: 'day',
    });
</script>

</body>
</html>