		<!-- TOP SECTION
			================================================== -->
			
			<section class="page-section black-section innerpage-heading-1 parallax-3" data-background="<?=base_url('assets-public/')?>images/paralax2.jpg">
				<div class="container">
					<div class="sixteen columns">
						<div class="page-heading text-center">
							<h1 class="sm-bottom10 fontalt4 hs3 side-line lp10">COLLECTION GALLERY</h1>	
							<h3 class="hs1 fw400 fontalt4 lp2">By Mr. Design</h3>
						</div>						
					</div>
				</div>	
							
			</section>
			
			<!-- SECTION GALLERY
			================================================== -->	
			<section class="page-section white-section sp-top-bottom100">				
				<div class="container">
				
					<div class="relative">
						<div class="projects-wrapper eleven columns clearfix">
                            <?php if (!empty($data_image)) {
                                foreach ($data_image->result() as $key) : ?>
                            <div class="work-item">
								<div class="gallery-wrap">
									<a href="<?=base_url($key->img_url)?>" class="gallery-lightbox mfp-image">
										<img src="<?=base_url($key->img_url)?>" class="gl" title="" alt=""/>
										<!-- <div class="thumb-title"><h3 class="hs1 fontalt lp1"><span>title here</span></h3></div> -->
									</a>								
								</div>
                            </div>
                            <?php 
                            endforeach;
                            }
                            ?>

                            <!--POST NAV-->
                            <br><br><br><br>    
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
					</div>

					<!--BLOG POST SIDE BAR
					================================================== 	-->	
					<div class="five columns offset-by-one">
						<!--WIDGET CATEGORY
						================================================== 	-->	
						<div class="widget clearfix">
							<h5 class="hs1 widget-title fontalt4 lp3 sm-bottom20">Filter Gallery</h5>
							<div class="widget-body fontalt4 lp1 clearfix">
								<ul class="listmenu widget-menu">
                                    <?php if (!empty($thn_image)){
                                        foreach ($thn_image as $key):
                                    ?>
                                    <li>
										<a title="" href="<?=base_url('copublic/images_in/'.$key->tahun)?>"><?=$key->tahun?></a>
										<small>
											- <?=$key->total?>
										</small>
                                    </li>
                                    <?php
                                    endforeach;
                                    }
                                    ?>
								</ul>
							</div>                                
						</div>	
						
					</div>	
					<!--END BLOG POST SIDE BAR
					================================================== 	-->
					
				</div>
			</section>