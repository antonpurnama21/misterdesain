<div class="modal fade" id="loadmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-label">Expert Modal</h4>
            </div>
            <form role="form" action="do_updateExpert" id="ValueUpdate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <input type="hidden" name="idexpert" id="idexpert" value=''>
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