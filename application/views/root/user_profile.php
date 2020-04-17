         <div class="wrapper-page">
            <div class="page-title">
                <h1><?=$titlePage?></h1>
            </div>
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel profile">
                                <img src="<?php echo base_url() ?>assets/img/bg_profile_img.jpg" class="profile-img-top">
                                <div class="panel-body text-center">
                                    <div class="pro-img">
                                        <?php if(!empty($profile->image)){ ?>
                                            <img src="<?php echo base_url($profile->image); ?>" height="250" width="167">
                                        <?php } else { ?>
											<img src="<?php echo base_url(); ?>assets/img/user/default.jpg" height="250" width="167">
										<?php } ?>
                                    </div>
                                    <h3><?php echo $profile->full_name; ?></h3>
                                    <button class="btn badge badge-profile mt-15">
											<?php if(!empty($profile->image)) { ?>
											<a href="<?php echo base_url()?>crud/Download_image?image=<?php echo $profile->image;?>" class="">
												Download
											</a>
											<?php } ?>
                                    </button>
                                    <div class="row">
                                        <div class="col-xs-4 text-center mt-25 profile-link">
                                            <a href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </div>
                                        <div class="col-xs-4 text-center mt-25 profile-link">
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </div>
                                        <div class="col-xs-4 text-center mt-25 profile-link">
                                            <a href="#">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel">
                                <div class="panel-body panel-heading-wrapper">
                                    <h5 class="pull-left">Basic  info</h5>
										<button type="button" data-id="<?php echo base64_encode($profile->id_user); ?>" name="submit" class="btn btn-custom pull-right userbutton"> Edit info </button>                               
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="profile-row clearfix">
                                            <div class="col-sm-3">
                                                <span class="profile-cat">Full Name</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <span class="profile-info"><?php echo $profile->full_name; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="profile-row clearfix">
                                            <div class="col-sm-3">
                                                <span class="profile-cat">Email</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <span class="profile-info"><?php echo $profile->email; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="profile-row clearfix">
                                            <div class="col-sm-3">
                                                <span class="profile-cat">Phone</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <span class="profile-info"><?php echo $profile->contact; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="flashmessage"></span>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body list-heading">
                                    <h5>User Notes</h5>
                                </div>
                                <div class="panel-body">
                                    <form method="post" id="notevalue" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <textarea name="description" cols="30" rows="6" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <label class="hidden-input-label btn btn-custom">
                                                    <input type="file" name="note_file" class="note_file" required>
                                                    <span>Upload image</span>
                                                </label>
                                                <span class="note_file_link"></span>
                                            </div>
                                            <div class="form-group pull-right media-left">
                                               <input type="hidden" name="iduser" value="<?php echo base64_encode($profile->id_user); ?>">
                                               <input type="hidden" name="commentid" value="<?php echo base64_encode($sesi['user_login_id']); ?>">
                                                <input type="submit" name="submit" id="notesubmit" class="btn btn-custom">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="panel-body"> 
                                                       
                                    <?php 
                                    if (!empty($usernote)) {
                                    foreach($usernote as $value): ?>
                                        <div class="media user-comments">
                                            <div class="media-left">
                                                <img src="<?php echo base_url($value->image); ?>" class="media-object">
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">
                                                    <?php echo $value->full_name;?>
                                                    <small><i><?php echo $value->datetime;?></i></small>
                                                </h5>
                                                <p><?php echo $value->description;?></p>
                                                
                                                <?php if($value->note_image): ?>
                                                    <div class="uploaded_image">
                                                        <a href="<?php echo base_url($value->note_image)?>">
                                                            <img src="<?php echo base_url($value->note_image)?>">
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; 
                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
<?php $this->load->view('root/user_modal')?>
   <!--user information update system using jquery /Ajax-->
<script type="text/javascript">
$(document).ready(function () {
    $('.note_file').change(function() {
        $(this).parent().next('span').text('Image selected');
    });
$("#btnSubmit").click(function (event) {

    //stop submit the form, we will post it manually.
    event.preventDefault();

    // Get form
    var formval = $('#UserValueUpdate')[0];

    // Create an FormData object
    var data = new FormData(formval);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "<?php echo base_url(); ?>root/updateValue",
        dataType: 'json',
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
    $("#notesubmit").click(function (event) {

        // stop submit the form, we will post it manually.
        event.preventDefault();

        // Get form
        var formval = $('#notevalue')[0];

        // Create an FormData object
        var data = new FormData(formval);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?php echo base_url(); ?>root/noteValidation",
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
        success: function(response) {
            if(response.status == 'error') { 
            $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(response.message);
            } else if(response.status == 'success'){
                $('#notesubmit').attr('disabled', 'disabled');
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
    $(".userbutton").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#UserValueUpdate').trigger("reset");
        $('#usermodel').modal('show');
        $.ajax({
            url: '<?php echo base_url(); ?>root/viewUserDataBYID?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).done(function (response) {
            // Populate the form fields with the data returned from server
			var theForm = $('#UserValueUpdate');

                theForm.find('[name="iduser"]').val(response.uservalue.id_user).end()
                        .find('[name="name"]').val(response.uservalue.full_name).end()
                        .find('[name="email"]').val(response.uservalue.email).end()
                        .find('[name="contact"]').val(response.uservalue.contact).end()
                        .find('[name="role"]').val(response.uservalue.role).end();

                var imgSrc = '<?php echo base_url(); ?>' + response.uservalue.image;
                theForm.find('[class="file_prev"]').html('<img src="' + imgSrc + '">').end();
		});
    });
});
</script>			