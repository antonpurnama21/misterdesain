<section class="index-cs-home black-section">
    <a data-scroll data-options='{ "easing": "easeInQuad" }' href="#scroll-link" class="arrow-down ad-white scroll"><i class="fa fa-long-arrow-down"></i></a>
    
    <div class="header">
        <div class="header-slider">
            <div class="cs-slider relative" data-slider="single" data-control="true" data-transition="">
                <div class="cs-slider-content">
                    <div class="cs-slider-item">
                        <div class="title-header">
                            <h1 class="home_head2 lp3 fontalt5 sm-bottom20 sp-bottom30 relative fontalt4">The pride digital design</h1>
                            <h3 class="home_head1 hs2 uppercase fw400 lp3">&mdash; Online &mdash; Architecture &mdash; Structure &mdash; Interior &mdash;</h3>
                        </div>
                        <div class="slider-item-background">
                            <img src="<?=base_url('assets-public/')?>images/paralax1.jpg" alt="background">
                            <div class="bg-overlay-dark-alfa40"></div>
                        </div>
                    </div>
                    <div class="cs-slider-item">
                        <div class="title-header white">
                            <h1 class="home_head2 lp3 fontalt5 sm-bottom20 sp-bottom30 relative fontalt4">Clean and Cool design </h1>
                            <h3 class="home_head1 hs2 uppercase fw400 lp3">&mdash; Online &mdash; Architecture &mdash; Structure &mdash; Interior &mdash;</h3>
                        </div>
                        <div class="slider-item-background">
                            <img src="<?=base_url('assets-public/')?>images/paralax2.jpg" alt="background">
                            <div class="bg-overlay-dark-alfa60"></div>
                        </div>
                    </div>
                </div>
                <div class="cs-slider-control slide-nav">
                    <span class="nav-control nav-preview"><i class="fa fa-caret-left"></i></span>
                    <span class="nav-control nav-next"><i class="fa fa-caret-right"></i></span>
                    
                </div>
            </div>
        </div>		
    </div>
</section>	


<!-- ABOUT SECTION BLOCK
================================================== -->	
<section class="page-section grey-section sp-top-bottom100" id="scroll-link">
    <div class="container">	
        <div class="offset-by-three thirteen columns">
            <div class="section-title-1 line3px text-center">
                <h2 class="sp-bottom20 sm-bottom10 fontalt5 lp2">Mr. Design</h2>
                <h3 class="hs2 fw400 text-italic nocase">Service</h3>	
                <!-- <div class="sm-top40">
                    <p class="text-italic fw400 nomargin">test</p>							
                </div> -->
            </div>
        </div>	
    </div>
    <div class="container sp-top60">
    <?php if(!empty($services)){
                foreach ($services as $key) {?>	
        <div class="one-four column">
            <div class="about-bx2 style2 text-center">
                <header>
                    <div class="icon-box sm-bottom20"><i class="myicon-puzzle"></i></div>
                    <h3 class="hs1 fontalt5 lp1 sm-bottom20"><?=strtoupper($key->service_name)?></h3>
                    <!-- <p class="nomargin"><?=$key->description?></p> -->
                </header>
                <div class="block-hover style2"></div>
            </div>
        </div>
    <?php }} ?>
    </div>
</section>

<style>
    .video-frame {
        height: 315px;
        width: 620px;
    }
</style>

<section class="page-section white-section">
    <div class="container">	
        <div class="offset-by-three thirteen columns">
            <div class="section-title-1 line3px text-center">
                <h2 class="sp-bottom20 sm-bottom10 fontalt5 lp2">Project Video</h2>
                <h3 class="hs2 fw400 text-italic nocase">Portofolio</h3>
            </div>
        </div>	
    </div>
    <div class="container sp-top60">
    <?php if(!empty($video)){
                foreach ($video as $key) {?>
        <div class="eight columns">
            <iframe class="video-frame" src="https://www.youtube.com/embed/<?=$key->link_video?>">
            </iframe>
        </div>
    <?php }} ?>
    </div>
</section>

<!-- LATEST WORK
================================================== -->	
<section class="page-section white-section sp-top100">
    <div class="container">
        <div class="offset-by-three thirteen columns" data-sr="enter top over 0.8s and move 140px">
            <div class="section-title-1 line3px text-center">
                <h2 class="sp-bottom20 sm-bottom10 fontalt5 lp2">Latest Works</h2>
                <h3 class="hs2 fw400 text-italic nocase">Projects</h3>	
                <!-- <div class="sm-top40">
                    <p class="text-italic fw400 nomargin">tess</p>
                </div> -->
            </div>
        </div>	

    </div>		
    <div class="portfolio-wrap sp-top100  project-style-2">
        <div class="container">
            <?php if(!empty($gallery)){
                foreach ($gallery as $key) {?>

            <div class="four columns col4-sm">
                <div class="latest-project-style4">
                    <div class="lp-style4-img">
                        <a  class="work-lightbox mfp-image"  href="<?=base_url($key->img_url)?>"><img alt="" src="<?=base_url($key->img_url)?>"></a>
                    </div>
                    <div class="lp-style4_info clearfix">
                        <h3 class="hs1 lp1 fontalt5 fw900"><span><?=category($key->id_gallery)?></span></h3>								
                    </div>
                </div>
            </div>

            <?php }} ?>

        </div>	
    </div>
    
</section>