</div>
</div>
<div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script>
    $(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
    });
</script>
<script>
    function load_data(query)
    {
        $.ajax({
            url:"<?php echo site_url('home/search') ?>",
            method:"POST",
            data:{query:query, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
            success:function(data)
            {
                $('#result').html(data);
            }
        });
    }
    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_data(search);
        }
        else
        {
            $('#result').html(null);
        }
    });
</script>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "70%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
<script>
    $('a:not(.closebtn),button,i:not(.la-bars,.la-times)').on('click', function()
    {
        $(".loader-wrapper").fadeIn("slow");
    })
</script>
    </body>
</html>
