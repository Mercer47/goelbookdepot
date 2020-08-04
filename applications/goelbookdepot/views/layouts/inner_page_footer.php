</div>
<div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<script>
    $(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
    });
</script>
<script>
    function myFunction(imgs) {
        var expandImg = document.getElementById("expandedImg");
        var imgText = document.getElementById("imgtext");
        expandImg.src = imgs.src;
        imgText.innerHTML = imgs.alt;
        expandImg.parentElement.style.display = "block";
    }
</script>
<script>
    $('a,button,i').on('click', function()
    {
        $(".loader-wrapper").fadeIn("slow");
    })
</script>
</body>
</html>