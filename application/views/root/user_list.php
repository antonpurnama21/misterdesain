<div class="wrapper-page">

    <div class="page-title">
        <h1><i class="icon-ghost"></i><?=$titlePage?></h1>
        <?php echo @$status;  echo @$response;  ?>
    </div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content_wrapper">
                        <div class="table_banner clearfix">
                            <h5 class="table_banner_title">Users</h5>
                        </div>
                        <div class="table_body text-left">
                            <table id="example" class="table table-condensed responsive table_custom" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>User Id</th>
                                        <th>Full name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (!empty($userlist)) {
                                    foreach($userlist as $value): ?>
                                    <tr>
                                        <td>
                                            <?php if(!empty($value->image)){ ?>
                                                <img src="<?php echo base_url($value->image); ?>" alt="Starter kit">
                                            <?php } else { ?>
                                            <img src="<?php echo base_url(); ?>assets/img/user/default.jpg" alt="Starter kit">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $value->id_user ?>
                                        </td>
                                        <td><a href="<?php echo base_url(); ?>root/View_profile?U=<?php echo base64_encode($value->id_user) ?>"><?php echo $value->full_name ?></a></td>
                                        <td>
                                            <?php echo $value->email ?>
                                        </td>
                                        <td>
                                            <?php echo $value->contact ?>
                                        </td>
                                        <td>
                                            <?php echo $value->status ?>
                                        </td>
                                        <td>
                                            <?php echo $value->role ?>
                                        </td>

                                        <td class="action-buttons">
                                            <?php if($sesi['user_role'] == 'Admin'){ ?>
                                            <a href="<?php echo base_url(); ?>root/View_profile?U=<?php echo base64_encode($value->id_user) ?>">
                                                    <i class="icon-eye"></i>
                                                </a>
                                            <button type="button" name="submit" class="userbutton" data-id="<?php echo base64_encode($value->id_user); ?>">
                                                    <i class="icon-pencil"></i>
                                                </button>
                                            <a onclick="confirms('Delete','User `<?=$value->full_name ?>`?','<?=base_url('root/delete') ?>','<?=base64_encode($value->id_user)?>')" <?php if($value->id_user == $this->session->userdata('user_login_id')){ echo 'hidden'; } ?> >
                                                    <i class="icon-close"></i>
                                            </a>
                                            <?php }else{?>
                                            Access denied!
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?PHP endforeach; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<span class="flashmessage"></span>
<?php $this->load->view('root/user_modal')?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".userbutton").click(function(e) {
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
            }).done(function(response) {

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


<script type="text/javascript">
    $(document).ready(function() {
        $("#btnSubmit").click(function(event) {

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
                data: data,
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function(response) {
                    if (response.status == 'error') {
                        $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(response.message);
                    } else if (response.status == 'success') {
                        console.log(response.status);
                        $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(response.message);
                        window.setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }
                },
                error: function(response) {
                    
                }
            });

        });

    });
</script>