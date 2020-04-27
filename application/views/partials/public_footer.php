<!-- CLIENTS
================================================== -->
<section class="page-section grey-section sp-top-bottom100">
    <div class="container">
        <div class="offset-by-three thirteen columns" data-sr="enter top over 0.8s and move 140px">
            <div class="section-title-1 line3px text-center">
                <h2 class="sp-bottom20 sm-bottom10 fontalt5 lp2">Our Partner & Clients</h2>
            </div>
        </div>						
    </div>

    <div class="container sp-top100">
        <!-- Client -->		
        <div class="client-grid clearfix">
            <?php 
            if (!empty($partner_client)) {
                foreach ($partner_client as $key) { ?>
            <div class="grid-item client-logo col-1 half-height">
                <div class="table">
                    <div class="item-centered">
                        <img src="<?=base_url($key->image_pc)?>" alt="">
                    </div>
                    <i><?=$key->name_pc?></i>
                </div>
            </div>  
            <?php } }
            ?>	

        </div>	

            
            <!-- End Client -->
    </div>
    
</section>

<!-- VISIT US
================================================== -->
<section class="page-section black-section sp-top-bottom100" style="background-color:deepskyblue;">
    <div class="container">
        <div class="one-third column">
            <div class="about-bx4 clearfix">
                <div class="bx4-icon">
                    <i class="pe-7s-map"></i>
                </div>
                <div class="bx4-content">
                    <h3 class="hs2 fontalt4 lp5">Address</h3>
                    <p><?=$settingsvalue->address?></a></p>
                </div>	
            </div>										
        </div>						
        
        <div class="one-third column">
            <div class="about-bx4 clearfix">
                <div class="bx4-icon">
                    <i class="pe-7s-pen"></i>
                </div>
                <div class="bx4-content">
                    <h3 class="hs2 fontalt4 lp5">Email</h3>
                    <p>Email : <a href="mailto:<?=$settingsvalue->system_email?>" title=""><?=$settingsvalue->system_email?></a></p>
                </div>	
            </div>										
        </div>
        
        <div class="one-third column">
            <div class="about-bx4 clearfix">
                <div class="bx4-icon">
                    <i class="pe-7s-call"></i>
                </div>
                <div class="bx4-content">
                    <h3 class="hs2 fontalt4 lp5">Call Service</h3>
                    <p>Office <?=$settingsvalue->contact?></p>
                </div>	
            </div>										
        </div>
        
    </div>
</section>
<section class="page-section grey-section footer sp-top80 sp-bottom100" >	
    <div class="container">
        <div class="sixteen columns text-center" data-sr="enter bottom over 0.8s and move 140px">	
            
            <!-- FOOTER SOCIAL LINK FOR SMALL DEVICES
            ================================================== -->	
            <div class="footer-social-links">
                <a target="_blank" title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                <a target="_blank" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                <a target="_blank" title="Behance" href="#"><i class="fa fa-behance"></i></a>
                <a target="_blank" title="LinkedIn+" href="#"><i class="fa fa-linkedin"></i></a>
                <a target="_blank" title="Pinterest" href="#"><i class="fa fa-pinterest"></i></a>
            </div>
            
            <!-- FOOTER SOCIAL LINK FOR LARGE DEVICES
            ================================================== -->	
            <div class="share clearfix">
                <button class="share-toggle-button">
                    <i class="share-icon fa fa-share-alt"></i>
                </button>
                <ul class="share-items">
                <?php if(!empty($social)){
                foreach ($social as $key) {?>
                    <li class="share-item">
                        <a href="<?=$key->link?>" class="share-button">
                            <i class="share-icon fa <?=$key->icon?>"></i>
                        </a>
                    </li>
                <?php }} ?>
                </ul>
            </div>	
            
            <div class="footer-text sm-top60 clearfix">
                <!-- Copyright -->
                <div class="footer-cr fw900">	
                <a href="#">&copy; <?=$settingsvalue->copyright?></a>.
                </div>
                <!-- End Copyright -->
                <div class="footer-madeby">
                    Made with love by <?=$settingsvalue->copyright?>
                </div>
                
            </div>
            
        </div>
    </div>
    
    <!-- ACROLL TO TOP
    ================================================== -->			
    <div class="scroll-to-top"><i class="fa fa-angle-up"></i></div>
</section>