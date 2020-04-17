        <div class="wrapper-page">

            <div class="page-title">
                <h1><i class="icon-user"></i> <?=$titlePage?></h1>
            </div>
            <div class="page-content">
                <div class="container-fluid">                   
                <div class="row">
                    <div class="col-md-12">
                        <div class="content_wrapper">
                            <div class="table_banner clearfix">
                                <h5 class="table_banner_title">Company Profile</h5>
                            </div>
                            <?php 
                            if(!empty($data_profile)){
                            foreach($data_profile as $key):?>
                            <form role="form" action="do_updateProfile" method="post" enctype="multipart/form-data" accept-charset="utf-12">
                                <div class="p2415">
                                    <div class="form-group clearfix">
                                        <label for="about" class="col-md-3">About</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="about" value="<?=$key->about?>" name="about" rows="10" required minlength="10"><?=$key->about?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="vision" class="col-md-3">Vision</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="vision" value="<?=$key->a_vision?>" name="vision" rows="10" required minlength="10"><?=$key->a_vision?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="mission" class="col-md-3">Mission</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="mission" value="<?=$key->a_mission?>" name="mission" rows="10" required minlength="10"><?=$key->a_mission?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="address" class="col-md-3">Address</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="address" value="<?=$key->address?>" name="address" rows="10" required minlength="10"><?=$key->address?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="telp_or_email" class="col-md-3">Telephone / Email</label>
                                        <div class="col-md-9">
                                            <input type="text" name="telp_or_email" id="telp_or_email" class="form-control" value="<?=$key->telp_or_email?>" placeholder="" minlength="5" maxlength="255" required >
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-md-9 col-md-offset-3">
                                            <input type="hidden" name="id" value="<?php echo base64_encode($key->id); ?>" />
                                            <button type="submit" class="btn btn-custom">Submit</button>
                                            <span class="flashmessage"></span>
                                        </div>
                                    </div>								
                                </div>
    						</form>
                            <?php endforeach;
                            }else{?>
                            <form role="form" action="do_addProfile" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                <div class="p2415">
                                    <div class="form-group clearfix">
                                        <label for="about" class="col-md-3">About</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="about" value="" name="about" rows="10" required minlength="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="vision" class="col-md-3">Vision</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="vision" value="" name="vision" rows="10" required minlength="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="mission" class="col-md-3">Mission</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="mission" value="" name="mission" rows="10" required minlength="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="address" class="col-md-3">Address</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="address" value="" name="address" rows="10" required minlength="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="telp_or_email" class="col-md-3">Telephone / Email</label>
                                        <div class="col-md-9">
                                            <input type="text" name="telp_or_email" id="telp_or_email" class="form-control" value='' placeholder="" minlength="5" maxlength="255" required >
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" class="btn btn-custom">Submit</button>
                                            <span class="flashmessage"></span>
                                        </div>
                                    </div>								
                                </div>
    						</form>
                            <?php }?>
                        </div>
                    </div>
                </div>          
            </div>            
        </div>
        </div>
