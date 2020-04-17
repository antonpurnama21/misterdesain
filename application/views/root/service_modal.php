<div class="modal fade" id="servicemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-label">Service Modal</h4>
            </div>
            <form role="form" action="do_updateService" id="serviceUpdate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group clearfix">
                        <label for="service_name" class="col-md-3">Service Name</label>
                        <div class="col-md-9">
                            <input type="text" name="service_name" id="service_name" class="form-control" value='' placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="description" class="col-md-3">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="description" name="description" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <input type="hidden" name="id_service" id="id_service" value=''>
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