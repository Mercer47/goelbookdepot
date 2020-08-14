<div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
</div>
<div class="col-lg-12 hide-sm bottom-bar">
    <div class="col-lg-12 bottom-bar-heading">
        <p>Quick Links</p>
    </div>
    <div class="col-lg-4">
        <a href="<?php echo site_url('home/terms') ?>">
            <i class="las la-list-alt"></i>
            Terms & Conditions
        </a>
        <a href="<?php echo site_url('home/privacy') ?>">
            <i class="las la-user-secret"></i>
            Privacy Policy
        </a>
        <a href="<?php echo site_url('home/contact') ?>">
            <i class="las la-tty"></i>
            Contact Us
        </a>
    </div>
    <div class="col-lg-4">
        <a href="<?php echo site_url('home/upcoming') ?>">
            <i class="las la-retweet"></i>
            Old editions at 50%
        </a>
        <a href="<?php echo site_url('home/upcoming') ?>">
            <i class="las la-crosshairs"></i>
            Exam Central
        </a>
        <a href="<?php echo site_url('home/contact') ?>">
            <i class="las la-tty"></i>
            Contact Us
        </a>
    </div>
    <div class="col-lg-4">
        <a href="<?php echo site_url('home/signin') ?>">
            <i class="las la-sign-in-alt"></i>
            Sign In
        </a>
        <a href="<?php echo site_url('bundle') ?>">
            <i class="las la-book"></i>
            Bundle <Store></Store>
        </a>
        <a href="<?php echo site_url('home/listcategories') ?>">
            <i class="las la-tags"></i>
            Shop By Category
        </a>
    </div>
</div>
<script type="text/javascript">
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex-1].style.display = "block";
        setTimeout(showSlides, 3500); // Change image every 2 seconds
    }
</script>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "70%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
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
    $('a:not(.closebtn),button,i:not(.la-bars,.la-times)').on('click', function()
    {
        $(".loader-wrapper").fadeIn("slow");
    })
</script>

</body>
</html>