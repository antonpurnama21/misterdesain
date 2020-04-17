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
			<section class="page-section white-section">
            <div class="container">					
				<div class="container sp-top60">
                <?php if (!empty($data_videos)) {
                    foreach ($data_videos->result() as $key) : ?>
                    <div class="eight columns">
                        <iframe class="video-frame" width="320" height="320" src="https://www.youtube.com/embed/<?=$key->link_video?>">
                        </iframe>
                    </div>
                    <?php 
                    endforeach;
                    }
                    ?>

                    <!--POST NAV-->
                    <br><br><br><br>    
                <?php echo $this->pagination->create_links(); ?>
				</div>
			</section>