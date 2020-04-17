<div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-label">Category Modal</h4>
            </div>
            <form role="form" action="do_updateCategory" id="categoryUpdate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group clearfix">
                        <label for="category_name" class="col-md-3">Category Name</label>
                        <div class="col-md-9">
                            <input type="text" name="category_name" id="category_name" class="form-control" value='' placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <input type="hidden" name="id_category" id="id_category" value=''>
                        <span class="pull-left"></span>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" id="btnSubmit" name="submit" class="btn btn-default btn-custom">Ok</button>
                        <button type="button" class="btn btn-success btn-custom" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>