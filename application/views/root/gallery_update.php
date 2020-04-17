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
                                    <?php if(!empty($image)) {
                                    foreach($image as $value): ?>
                                    <div class="image-delete Deletimg" data-id="<?php echo $value->id ?>" id="" onclick="confirm('Are you sure want to delet this image?')">
                                        <img src="<?Php echo base_url($value->img_url) ?>" height="110px" width="110px" alt="mamacita">
                                        <div class="img-id"><i class="fa fa-trash middle"></i></div>
                                    </div>
                                    <?php endforeach; } ?>
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
                                    <option value="<?php echo $value->id_category; ?>" <?php if($gallery->id_category == $value->id_category){echo "selected";}?>><?php echo $value->category_name;?></option>
                                    <?php endforeach;} ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label for="type" class="col-md-3">Type</label>
                                <div class="col-md-9">
                                    <select name="type" id="type" class="form-control" style="width: 100%" required>
                                        <option value=""></option>
                                        <option value="interior" <?php if($gallery->type_gallery == "Interior"){echo "selected";}?>>Interior</option>
                                        <option value="exterior" <?php if($gallery->type_gallery == "Exterior"){echo "selected";}?>>Exterior</option>  
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
                                    <option value="<?php echo $value->id_service; ?>" <?php if($gallery->id_service == $value->id_service){echo "selected";}?>><?php echo $value->service_name;?></option>
                                    <?php endforeach;} ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label for="vision" class="col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="description" value="" name="description" rows="10" minlength="10"><?=$gallery->desc_gallery?></textarea>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-md-9 col-md-offset-3">
                                    <input type="hidden" name="id" value="<?php echo $gallery->id_gallery; ?>">
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
     		
<script type="text/javascript">
    $(document).ready(function () {
    $("#btnSubmit").click(function (event) {

        //stop submit the form, we will post it manually.
        event.preventDefault();

        // Get form
        var formval = $('#fileUploadForm')[0];

        // Create an FormData object
        var data = new FormData(formval);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "do_updateUpload",
            dataType:'json',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
        success: function(response) {
            if(response.status == 'error') { 
            $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(response.message);
            } else if(response.status == 'success'){
                $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(response.message);
            window.setTimeout(function() {location.reload();}, 3000);
            }              
        },
        error: function(response) {
        console.error();
        }
        });

    });

});
</script>	            
<script type="text/javascript">
$(document).ready(function () {
$(".Deletimg").click(function (event) {
event.preventDefault();
var iid = $(this).attr('data-id');
    $.ajax({
        url: "<?php echo base_url()?>root/unlink_image?UN=" +iid,
        method: 'GET',
        data:'',
        dataType:'json',
    success: function(response) {
    $(".flashmessage").fadeIn('fast').delay(30000).fadeOut('fast').html(response.message);
    window.setTimeout(function(){location.reload()},2000)
    },
    error: function(response) {
    console.log(response)
    }
    });

});
});
</script> 