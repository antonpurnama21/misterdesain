			<!-- TOP SECTION
			================================================== -->
			
			<section class="page-section black-section innerpage-heading-2 bg-overlay-dark-alfa40 parallax-1" data-background="<?=base_url('assets-public/')?>images/paralax3.jpg">
				<div class="relative container">
					<div class="eight columns">
						<div class="page-heading ph-left">
							<h1 class="sm-bottom10 fontalt4 hs3">Detail Order Page</h1>
						</div>						
					</div>
					<div class="eight columns">
						<div class="breadcrumbs text-right sm-top20">
							<a href="#">Home</a>&nbsp;/&nbsp;<a href="<?=base_url('copublic/order')?>">Order Page</a>&nbsp;/&nbsp;<span>Detail Order Page</span>
                        </div>
					</div>
				</div>				
            </section>
			<!-- FORM
			================================================== -->
			<section class="page-section white-section sp-top-bottom100">
				<div class="container">
					<div class="offset-by-three thirteen columns" data-sr="enter top over 0.8s and move 140px">
						<div class="section-title-5 text-center">	
							<h1 class="hs3 fontalt4 lp1 sm-bottom20">Detail Order Section</h1>
							
						</div>
					</div>	
				</div>
				<div class="container sp-top60">
					<div class="eleven columns">
						<div class="clearfix">
							<div class="col col1">
								<table>
									<tr>
										<th width="500"><h6>ID Transaksi</h6></th>
										<td width="50">:</td>
										<td width="800"><p><h6><?=$data->id_booking?></h6> Silahkan Note id booking, sebagai tanda bukti Order !</p></td>
									</tr>
									<tr>
										<th><h6>Fullname</h6></th>
										<td>:</td>
										<td><p><?=ucwords($data->customer_name)?></p></td>
									</tr>
									<tr>
										<th><h6>Email</h6></th>
										<td>:</td>
										<td><p><?=$data->customer_email?></p></td>
									</tr>
									<tr>
										<th><h6>Phone Number</h6></th>
										<td>:</td>
										<td><p><?= ucwords($data->phone_num)?></p></td>
									</tr>
									<tr>
										<th><h6>Address</h6></th>
										<td>:</td>
										<td><p><?=nl2br(ucwords($data->customer_address))?></p></td>
									</tr>
									<tr>
										<th><h6>Service Order</h6></th>
										<td>:</td>
										<td><p><?=ucwords(service($data->id_service))?></p></td>
									</tr>
									<tr>
										<th><h6>Note</h6></th>
										<td>:</td>
										<td><p><?=nl2br(ucwords($data->note))?></p></td>
									</tr>
									<tr>
										<th><h6>File Layout</h6></th>
										<td>:</td>
										<td><p><?=($data->layout_file_path != '') ? '<a class="btn-bg-black btn-size-0" target="_blank" href="'.base_url('order/download/'.$data->id_booking).'">Download</a>' : 'Tak ada File'?></p></td>
									</tr>
									<tr>
										<th><h6>Status Order</h6></th>
										<td>:</td>
										<td><p><h6><?=$data->status_booking?></h6> <?=($data->status_booking == 'UPROVED') ? 'Kami akan menghubungimu segara, untuk mengkonfirmasi pesanan anda !' : ''?></p></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>