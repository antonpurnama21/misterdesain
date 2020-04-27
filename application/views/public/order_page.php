			<!-- TOP SECTION
			================================================== -->
			
			<section class="page-section black-section innerpage-heading-2 bg-overlay-dark-alfa40 parallax-1" data-background="<?=base_url('assets-public/')?>images/paralax3.jpg">
				<div class="relative container">
					<div class="eight columns">
						<div class="page-heading ph-left">
							<h1 class="sm-bottom10 fontalt4 hs3">Order Page</h1>	
							<h3 class="hs1 fw400 fontalt4 lp2">Order and Check Your Order</h3>
						</div>						
					</div>
					<div class="eight columns">
						<div class="breadcrumbs text-right sm-top20">
							<a href="#">Home</a>&nbsp;/&nbsp;<span>Order Page</span>
                        </div>
					</div>
				</div>				
            </section>
            
			<section class="page-section white-section sp-top-bottom100">
				<div class="container sp-top60">
					<div class="offset-by-three thirteen columns" data-sr="enter top over 0.8s and move 140px">
						<form role="form" action="<?=base_url('order/do_check')?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="form">
                        
							<div class="clearfix">
								<p><?php echo $this->session->flashdata('feedcheck')?></p>
								<div class="col col2">
									<div class="form-group">
										<input type="text" required="" pattern=".{2,10}" placeholder="* Input Your Order ID" class="full_width" id="order_id" name="order_id">
									</div>
                                </div>

                                <div class="col col2">
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn-bg-black btn-size-1 fontalt4 lp2">Check Order</button>
                                    </div>
								</div>
							
						</form>
					</div>
				</div>
			</section>
			<!-- FORM
			================================================== -->
			<section class="page-section white-section sp-top-bottom100">
				<div class="container">
					<div class="offset-by-three thirteen columns" data-sr="enter top over 0.8s and move 140px">
						<div class="section-title-5 text-center">	
							<h1 class="hs3 fontalt4 lp1 sm-bottom20">Order Section</h1>
							<p class="text-italic fw400">Feel it the Form Order</p>	
							
							<?php echo $this->session->flashdata('feedback')?>
							
						</div>
					</div>	
				</div>
				<div class="container sp-top60">
					<div class="offset-by-three thirteen columns" data-sr="enter top over 0.8s and move 140px">
						<form role="form" action="<?=base_url('order/do_order')?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="form">
                        
							<div class="clearfix">
								
								<div class="col col1">
									
									<!-- Name -->
									<div class="form-group">
										<input type="text" required="" pattern=".{2,100}" placeholder="* Name" class="full_width" id="name" name="name">
									</div>
								
									<!-- Email -->
									<div class="form-group">
										<input type="email" required="" pattern=".{5,100}" placeholder="* Email" class="full_width" id="email" name="email">
									</div>

									<div class="form-group">
										<input type="number" required="" pattern=".{3,13}" placeholder="* Phone Number" class="full_width" id="phone" name="phone">
									</div>

									<div class="form-group">                                            
										<textarea required="" placeholder="* Your Address" rows="6" style="height:89px" class="full_width" id="address" name="address"></textarea>
                                    </div>
                                    <div class="form-group">                                            
										<select name="service" id="" class="full_width">
											<option value="">* Pick The Services</option>
                                            <?php foreach ($service as $key) :?>
                                            <option value="<?=$key->id_service?>"><?=$key->service_name?></option>
											<?php endforeach;?>
										</select>
									</div>

									<div class="form-group">                                            
										<textarea required="" placeholder="Add Note" rows="6" style="height:89px" class="full_width" id="note" name="note"></textarea>
                                    </div>

									<div class="form-group text-center">
										<input id="f02" name="layout_file" type="file" placeholder="Upload Your Layout" />
  										<label for="f02">* Upload Your Layout</label>
                                    </div>
								
                                    <div class="sp-top20">
                                        <button type="submit" class="btn-bg-black btn-size-1 fontalt4 lp2">Submit Your Oder</button>
                                    </div>
									
								</div>
							
						</form>
					</div>
				</div>
			</section>