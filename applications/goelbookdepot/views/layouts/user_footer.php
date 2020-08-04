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
