<!-- TOP SECTION
================================================== -->

<section class="page-section black-section innerpage-heading-2 parallax-1" data-background="<?=base_url('assets-public/')?>images/paralax2.jpg">
    <div class="relative container">
        <div class="eight columns">
            <div class="page-heading">
                <h2 class="hs3 sm-bottom20 lp1 fontalt4">About us</h2>
                <h4 class="hs1 fw400 fontalt4 lp3">We are design and branding agency</h4>								
            </div>
        </div>
        <div class="eight columns">
            <div class="breadcrumbs text-right sm-top20">
                <a href="#">Home</a>&nbsp;/&nbsp;<span>About</span>
            </div>
        </div>
    </div>				
</section>	

<!-- ABOUT US
================================================== -->
<section class="page-section white-section sp-top-bottom100" id="scroll-link">
    <div class="container">
        <div class="columns">
            <div class="section-title-3" data-sr="enter bottom over 0.8s and move 140px">
                <h1 class="fw400 lp5 fontalt4 sm-bottom20"><small>What is ?</small> Mr. Design</h1>
                <h3 class="hs2 fw300 lowercase" style="text-align: justify;"><?=nl2br($company_profile->about)?></h3>	
                <div class="sm-top40">
                    
                </div>
            </div>
        </div>
        
        <div class="columns">
            <div class="section-title-3" data-sr="enter bottom over 0.8s and move 140px">
                <h1 class="fw400 lp5 fontalt4 sm-bottom20">Visi</h1>
                <h3 class="hs2 fw300 lowercase" style="text-align: justify;"><?=nl2br($company_profile->a_vision)?></h3>	
                <div class="sm-top40">
                    
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="section-title-3" data-sr="enter bottom over 0.8s and move 140px">
                <h1 class="fw400 lp5 fontalt4 sm-bottom20">Misi</h1>
                <h3 class="hs2 fw300 lowercase" style="text-align: justify;"><?=nl2br($company_profile->a_mission)?></h3>	
                <div class="sm-top40">
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!--TEAM
================================================== 	-->	
<section class="page-section white-section sp-top-bottom100">
    <div class="container">
        <div class="columns">
            <div class="section-title-3" data-sr="enter bottom over 0.8s and move 140px">
                <h1 class="fw400 lp5 fontalt4 sm-bottom20"><small>Our Experts</small> People</h1>	
                                                                    
            </div>
        </div>				
    </div>		
        
    <div class="container sp-top80">
        <div class="ourteam clearfix">
            <div id="owl-team-slider" class="owl-carousel text-center"> 
            <?php if(!empty($experts)){
                foreach ($experts as $key) {?>	
                <div class="item">							
                    <div class="team-style3 clearfix">
                        <img alt="" src="<?=base_url($key->photo)?>" width="390" height="390"/>
                        <div class="person-info text-center">
                            <div class="valign">
                                <h3 class="hs1 person-info-name fontalt lp1"><?=$key->full_name?></h3>
                                <span class="person-info-title"><?=position($key->id_position)?></span>                                
                            </div>
                        </div>
                    </div>									
                </div>
            <?php }} ?>
            </div>
        </div>
    </div>				

</section>