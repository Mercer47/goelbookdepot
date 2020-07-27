<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets\Datatables\DataTables-1.10.20\js\jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets\Datatables\DataTables-1.10.20\js\dataTables.bootstrap4.min.js') ?>"></script>
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