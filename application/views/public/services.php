<section class="page-section black-section innerpage-heading-2 bg-overlay-dark-alfa40 parallax-1" data-background="<?=base_url('assets-public/')?>images/paralax3.jpg">
    <div class="relative container">
        <div class="eight columns">
            <div class="page-heading">
                <h2 class="hs3 sm-bottom20 fontalt4">Services</h2>
                <!-- <h3 class="hs1 fw400 fontalt4 lp2">We are design and branding agency</h3>								 -->
            </div>
        </div>
        <div class="eight columns">
            <div class="breadcrumbs text-right sm-top20">
                <a href="#">Home</a>&nbsp;/&nbsp;<span>Services</span>
            </div>
        </div>
    </div>				
</section>	

<!-- SECTION SERVICES
================================================== -->
<section class="page-section white-section">
    
    <div class="container">
    
        <div class="split-section-content clearfix">
        
            <div class="animated-block clearfix">
            
                <!-- Service Item -->
                <?php if (!empty($service)){
                    foreach ($service as $key) {?>
                <div class="animated-item">
                    <div class="ai-cell">
                        <div class="ai-inner">
                            <div class="ai-intro">
                                <div class="ai-icon">
                                    <i class="myicon-puzzle"></i>
                                </div>
                                <h3 class="hs1 fontalt4 lp1 sm-bottom10"><?=$key->service_name?></h3>									
                            </div>
                            <div class="ai-descr">
                            
                            </div>
                        </div>
                    </div>
                </div>

                <?php }
                }?>
                <!-- End Service Item -->

                                        
                
            </div>

        </div>
        
    </div>
    
</section>

<!-- SERVICES
================================================== -->
<section class="page-section white-section sp-top-bottom100">
    <div class="container">	
        <div class="offset-by-three thirteen columns" data-sr="enter top over 0.8s and move 140px">
            <div class="section-title-6 text-center">
                <h4 class="lp10">What we do</h4>
                <h2 class="lp3 sm-bottom20">Our services</h2>								
            </div>
        </div>	
    </div>
    <div class="container sp-top80">
        <div id="owl-service-slider" class="owl-carousel service-slider">
        <?php if (!empty($service)){
            foreach ($service as $key) {?>
            <div class="item">
                <div class="col-lg-12" align="center">
                    <div class="ss-icon text-center">
                        <i class="myicon-puzzle"></i><br /><br />
                        <h5 class="lp3 sm-bottom20"><?=$key->service_name?></h5>
                    </div>
                </div>
                <div class="offset-by-three thirteen columns">
                    <div class="ss-title">									
                        <h5 class="fw300 nocase text-italic text-center"><?=$key->description?></h5>									
                    </div>
                </div>
            </div>
            <?php }
            }?>
        </div>
    
    </div>
</section>	

<hr class="nomargin nopadding"/>