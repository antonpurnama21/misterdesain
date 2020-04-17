<div class="modal fade" id="usermodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                            <div class="modal-header modal-primary">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="modal-label">User Modal</h4>
							</div>
                          <div style="color:green;padding:10px;font-size:20px" class="successUpdate"> </div>  
			            <form role="form"  id="UserValueUpdate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            <div class="modal-body">
								<div class="form-group clearfix">
                                    <label for="inputMaxLength" class="col-md-3">User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" id="name" class="form-control" id="inputMaxLength" value='' placeholder="" required >
                                    </div>
                                </div>								
                                <div class="form-group clearfix">
                                    <label for="textareaMaxLength" class="col-md-3">User email</label>
                                    <div class="col-md-9">
                                        <input type="email" name="email" id="email" class="form-control" value='' placeholder="" required>
                                    </div>
                                </div> 
                                <div class="form-group clearfix">
                                    <label for="textareaMaxLength" class="col-md-3">User Contact</label>
                                    <div class="col-md-9">
                                        <input type="number" name="contact" id="contact" class="form-control" value='' placeholder="" required>
                                    </div>
                                </div>
                                <?php if($sesi['user_role'] == 'Admin'){?>									
                                <div class="form-group clearfix">
                                    <label for="textareaMaxLength" class="col-md-3">User Role</label>
    								<div class="col-md-9">
                                        <select name="role" id="role" class="form-control" required>
                                            <option value="">Select Here</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>  
                                        </select>                        
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form-group clearfix">
                                    <div class="col-md-9 col-md-offset-3">
                                        <div class="file_prev">
                                            <?php if($profile->image){ ?>
                                                <img src="<?php echo base_url($profile->image); ?>" height="250" width="167">
                                                <?php } else { ?>
                                                <img src="<?php echo base_url(); ?>assets/img/user/default.jpg" height="250" width="167">
                                            <?php } ?>
                                        </div>
                                        <label for="user_image" class="custom-file-upload">Upload image</label>
                                    </div>
                                    <div class="col-md-9 col-md-offset-3">
                                        <input type="file" class="" id="user_image" name="user_image" aria-describedby="fileHelp">
                                    </div>	
                                </div>									
                            </div>
                            <div class="modal-footer">
						        <div class="col-md-6">
                                    <input type="hidden" name="iduser" id="iduser" value=''>
                                    <?php if($sesi['user_role'] == 'User'){?>
                                    <input type="hidden" name="role" id="role" value=''>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" id="btnSubmit" name="submit" class="btn btn-custom">Ok</button>
                                    <button type="button" onclick="location.reload();" class="btn btn-custom" data-dismiss="modal">Close</button>
                                </div>
                            </div>
						</form>
                </div>
            </div>
        </div>