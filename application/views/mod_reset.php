<div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                    <div class="modal-header modal-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-label">Reset Password Modal</h4>
                    </div>	
                    <div class="message"> </div>  
                <form role="form" action="Add_Reset_password" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="oldPassword" class="control-label">Old Password</label>
                        <input type="password" name="oldpass" class="form-control" id="oldPassword" value="" placeholder="" required >
                        </div>
                        <div class="form-group">
                        <label for="newPassword" class="control-label">New Password</label>
                        <input type="password" name="newpass" class="form-control" id="newPassword" value="" placeholder="" required >
                        </div>
                        <div class="form-group">
                        <label for="confirmNewPass" class="control-label">Confirm Password</label>
                        <input type="password" name="confirmpass" class="form-control" id="confirmNewPass" value="" placeholder="" required >
                        </div>													
                    </div>
                    <div class="modal-footer">
                        <button id="" type="submit" name="submit" class="btn btn-custom">Ok</button>
                        <button type="button" class="btn btn-custom" onclick="location.reload()" data-dismiss="modal">Close</button>
                    </div>
                </form>
        </div>
    </div>
</div>