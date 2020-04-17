<div class="wrapper-page">

<div class="page-title">
    <h1><i class="icon-user"></i> <?=$titlePage?></h1>
</div>
<div class="page-content">
    <div class="container-fluid">                   
    <div class="row">
        <div class="col-md-8">
            <div class="content_wrapper">
                <div class="table_banner clearfix">
                    <h5 class="table_banner_title">Create Expert</h5>
                </div>
                <form role="form" action="do_addExpert" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="p2415">
                        <div class="form-group clearfix">
                            <label for="fullname" class="col-md-3">Full Name</label>
                            <div class="col-md-9">
                                <input type="text" name="fullname" id="fullname" class="form-control" value='' placeholder="" minlength="5" maxlength="25" required >
                            </div>
                        </div>
                        <div class="form-group clearfix">
                        <label for="role" class="col-md-3">Position</label>
                            <div class="col-md-9">
                                <select name="id_position" id="id_position" class="form-control" style="width: 100%" required>
                                    <option value="">Select here</option>
                                    <?php foreach ($dept as $key) {?>
                                        <option value="<?=$key->id_position?>"><?=$key->position?></option>
                                    <?php } ?>
                                </select>                        
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label for="expertise" class="col-md-3">Expertise</label>
                            <div class="col-md-9">
                                <input type="text" name="expertise" id="expertise" class="form-control" value='' placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-9 col-md-offset-3">
                                <div class="file_prev"></div>
                                <label for="img_url" class="custom-file-upload">Upload photo</label>
                            </div>
                            <div class="col-md-9 col-md-offset-3">
                                <input type="file" class="" id="img_url" name="img_url" aria-describedby="fileHelp" required>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" id="btnSubmit" name="submit" class="btn btn-custom">Submit</button>
                                <span class="flashmessage"></span>
                            </div>
                        </div>								
                    </div>
                </form>
            </div>
        </div>
    </div>          
</div>            
</div>
</div>
