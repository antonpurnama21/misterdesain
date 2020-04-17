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
                    <h5 class="table_banner_title">Create Video</h5>
                </div>
                <div style="margin : 20px;">
                    <img src="<?=base_url('assets/img/id_videos.png')?>" alt="">
                </div>
                <form action="<?=base_url('root/')?>do_addVideo" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="p2415">
                        <div class="form-group clearfix">
                            <label for="link_video" class="col-md-3">ID Videos</label>
                            <div class="col-md-9">
                                <input type="text" name="link_video" id="link_video" class="form-control" value='' placeholder="Insert Id Videos" minlength="5" maxlength="255" required >
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
