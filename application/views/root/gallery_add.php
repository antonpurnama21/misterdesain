        <div class="wrapper-page">

            <div class="page-title">
                <h1><i class="icon-handbag"></i> <?=$titlePage?></h1>
            </div>
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="content_wrapper">				        						
                                <div class="table_banner clearfix">
                                    <h5 class="table_banner_title">Upload Gallery</h5>
                                </div>
                                <div class="table_body p2415">
                                
                                    <form role="form" action="do_upload" id="fileUploadForm" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                    <div class="label-warning">Select Multiple Image "ctrl + click" one by one or block area</div>
                                    <br>
                                        <div class="form-group clearfix">
                                            <div class="col-md-9 col-md-offset-3">
                                                <div class="image-preview clearfix"></div>
                                                
                                                <label for="gallery_image" class="custom-file-upload ajaxified">Upload image</label>
                                                
                                                <input type="file" multiple class="" id="gallery_image" name="gallery_image[]" aria-describedby="fileHelp" required>
                                                <input type="file" class="" id="img_url" name="img_url" aria-describedby="fileHelp" accept="image/jpg,image/jpeg,image/png">
                                            </div>                                            
                                        </div>
                                        <div class="form-group clearfix">
                                            <label for="category" class="col-md-3">Category</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="category" name="category" required>
                                                <option value=""></option>
                                                <?php if (!empty($category)) {
                                                    foreach($category as $value): ?>
                                                <option value="<?php echo $value->id_category; ?>"><?php echo $value->category_name;?></option>
                                                <?php endforeach;} ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label for="type" class="col-md-3">Type</label>
                                            <div class="col-md-9">
                                                <select name="type" id="type" class="form-control" style="width: 100%" required>
                                                    <option value=""></option>
                                                    <option value="interior">Interior</option>
                                                    <option value="exterior">Exterior</option>  
                                                </select>                        
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label for="service" class="col-md-3">Service</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="service" name="service" required>
                                                <option value=""></option>
                                                <?php if (!empty($service)) {
                                                    foreach($service as $value): ?>
                                                <option value="<?php echo $value->id_service; ?>"><?php echo $value->service_name;?></option>
                                                <?php endforeach;} ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label for="vision" class="col-md-3">Description</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" id="description" value="" name="description" rows="10" minlength="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" name="submit" id="btnSubmit" class="btn btn-custom">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="flashmessage"></span>	