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
                    <h5 class="table_banner_title">Create Partner & Client</h5>
                </div>
                <form role="form" action="do_add_pc"  id="UserValueUpdate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="p2415">
                        <div class="form-group clearfix">
                            <label for="inputMaxLength" class="col-md-3">Name Partner & Client</label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control" id="inputMaxLength" value='' placeholder="" minlength="5" maxlength="25" required >
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-9 col-md-offset-3">
                                <div class="file_prev"></div>
                                <label for="user_image" class="custom-file-upload">Upload image</label>
                            </div>
                            <div class="col-md-9 col-md-offset-3">
                                <input type="file" class="" id="user_image" name="user_image" aria-describedby="fileHelp" required>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-9 col-md-offset-3">
                                <input type="hidden" name="idpc" id="idpc" value=''>
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
