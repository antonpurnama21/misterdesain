<div class="wrapper-page">

<div class="page-title">
    <h1><i class="icon-tag"></i> <?=$titlePage?></h1>
</div>
<div class="page-content">
    <div class="container-fluid">                   
    <div class="row">
        <div class="col-md-8">
            <div class="content_wrapper">
                <div class="table_banner clearfix">
                    <h5 class="table_banner_title">Add Media Social</h5>
                </div>
                <form action="<?=base_url('root/')?>do_addSocial" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="p2415">
                        <div class="form-group clearfix">
                            <label for="social_name" class="col-md-3">social Name</label>
                            <div class="col-md-9">
                                <input type="text" name="social_name" id="social_name" class="form-control" value='' placeholder="" minlength="5" maxlength="255" required >
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label for="social_link" class="col-md-3">Link</label>
                            <div class="col-md-9">
                                <input type="text" name="social_link" id="social_link" class="form-control" value='' placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label for="social_icon" class="col-md-3">Icon</label>
                            <div class="col-md-9">
                                <select name="social_icon" id="social_icon" class="form-control" style="width: 100%" required>               
                                    <option value="">Select Here</option>
                                    <option value="fa-facebook">Facebook</option>
                                    <option value="fa-instagram">Instagram</option>
                                    <option value="fa-twitter">Twitter</option>
                                    <option value="fa-linkedln">Linkedln</option>
                                    <option value="fa-pinterest">Pinterest</option>
                                    <option value="fa-tumblr">Tumblr</option>  
                                </select>
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
