<?php $this->view('layouts/header') ?>
	<div class="col-xs-12 col-lg-12 sbc-banner" style=" height: 40px; font-weight: 900; font-size: 18px; font-family: 'Ubuntu', sans-serif;   padding: 0px; background: #42dd54;" >
        <p align="center" style="padding-top: 8px; margin: 0px; color: white; font-family: Questrial-regular,sans-serif">
            SHOP BY CATEGORY
            <i class="las la-chevron-circle-right" style="font-size: 25px; position: relative; top: 2px"></i>
        </p>
	</div>

	<div class="col-xs-12 col-lg-11 category-bar">
		<div class="table-responsive">
		<table class="table">
			<tbody>
                <tr>
                    <?php foreach($category as $row) {?>
                        <th class="category-banner">
                            <a href="<?php echo site_url('home/category/').$row->id.'/'.$row->name; ?>" style="color: black;">
                                <img src="<?php echo base_url('assets/').$row->image; ?>" height="150px" width="180px" style="">

                            </a>
                        </th>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
	</div>
</div>

    <div class="col-xs-12 col-lg-8 carousel" >
		<!-- Slideshow container -->
        <div class="slideshow-container">
            <!-- Full-width thumbnails with number and caption text -->
            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="<?php echo base_url('assets/thumbnails/fbad.jpg') ?>" >
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="<?php echo base_url('assets/thumbnails/cover6.jpg') ?>" >
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="<?php echo base_url('assets/thumbnails/cover3.jpg') ?>">
            </div>
            <!-- Next and previous buttons -->
        </div>

        <!-- The dots/circles -->
        <div style="text-align:center">
          <span class="dot" onclick="currentSlide(1)"></span>
          <span class="dot" onclick="currentSlide(2)"></span>
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
	</div>

	<div class="col-xs-12 col-lg-5 main-banner" style=" padding:0px; margin-top: 15px; border-top: 1px solid; border-bottom: 1px solid; font-family: 'Ubuntu', sans-serif;" align="center">
        <a href="class?id=7&name=Competitive%20Exams"><img src="<?php echo base_url('assets/thumbnails/competetivepromo.jpg') ?>" class="img img-responsive"></a>
	</div>

  <div class="col-xs-12 col-lg-5 main-banner" style=" padding:0px; margin-top: 15px; border-top: 1px solid; border-bottom: 1px solid; font-family: 'Ubuntu', sans-serif;" align="center">
      <img src="<?php echo base_url('assets/thumbnails/YUG.jpg') ?>" class="img img-responsive">
  </div>

	<div class="col-xs-12 col-lg-5 main-banner" style="padding:0px; border-top: 1px solid; border-bottom: 1px solid; margin-top: 15px;  font-family: 'Roboto Condensed', sans-serif;" align="center">
        <img src="<?php echo base_url('assets/thumbnails/SchoolPromotion.jpg') ?>" class="img img-responsive">
	</div>

    <div class="col-xs-12 col-lg-5 main-banner" style="padding:0px; border-top: 1px solid; border-bottom: 1px solid; margin-top: 15px;  font-family: 'Roboto Condensed', sans-serif;" align="center">
        <a href="class?id=4&name=Undergraduation"><img src="<?php echo base_url('assets/thumbnails/CollegePromotion.jpg') ?>" class="img img-responsive"></a>
    </div>

    <div class="col-xs-12 col-lg-5 main-banner" style="padding:0px; border-top: 1px solid; border-bottom: 1px solid; margin-top: 15px;  font-family: 'Roboto Condensed', sans-serif;" align="center">
        <img src="<?php echo base_url('assets/thumbnails/ExamPromotion.jpg') ?>" class="img img-responsive">
    </div>

    <div class="col-xs-12 col-lg-5 main-banner">
        <img src="<?php echo base_url('assets/thumbnails/fbad.jpg') ?>" class="img img-responsive">
    </div>

	<div class="col-xs-12 col-lg-7 tag-line">
		<p align="center" style="font-size: 25px;"><b> THAT'S ALL ASPIRANTS!</b></p>
        <p align="center"><a href="http://macmer.in" target="_blank" style="color: black; cursor: pointer;">Developed By: Macmer Co.</a></p>
    </div>
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

<?php $this->view('layouts/footer') ?>