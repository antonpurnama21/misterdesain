<div class="modal fade" id="socialmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-label">Media Social Modal</h4>
            </div>
            <form role="form" action="do_updateSocial" id="socialUpdate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group clearfix">
                        <label for="social_name" class="col-md-3">Social Media</label>
                        <div class="col-md-9">
                            <input type="text" name="social_name" id="social_name" class="form-control" value='' placeholder="" required>
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
                </div>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <input type="hidden" name="id_social" id="id_social" value=''>
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