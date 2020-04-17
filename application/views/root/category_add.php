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
                    <h5 class="table_banner_title">Create Category</h5>
                </div>
                <form action="<?=base_url('root/')?>do_addCategory" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="p2415">
                        <div class="form-group clearfix">
                            <label for="category_name" class="col-md-3">Category Name</label>
                            <div class="col-md-9">
                                <input type="text" name="category_name" id="category_name" class="form-control" value='' placeholder="" minlength="5" maxlength="255" required >
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
