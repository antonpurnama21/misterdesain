<div class="wrapper-page">

    <div class="page-title">
        <h1><i class="icon-tag"></i><?=$titlePage?></h1>
        <?php echo @$status;  echo @$response;  ?>
    </div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content_wrapper">
                        <div class="table_banner clearfix">
                            <h5 class="table_banner_title">Social Media</h5>
                        </div>
                        <div class="table_body text-left">
                            <table id="example" class="table table-condensed responsive table_custom" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Media Social</th>
                                        <th>Link</th>
                                        <th>Icon</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (!empty($data)) {
                                        $no = 0;
                                    foreach($data as $value): 
                                        $no++;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->social_media ?>
                                        </td>
                                        <td>
                                            <?php echo $value->link ?>
                                        </td>
                                        <td>
                                            <?php echo $value->icon ?>
                                        </td>
                                        <td>
                                            <?php echo $value->created_on ?>
                                        </td>

                                        <td class="action-buttons">
                                            <?php if($sesi['user_role'] == 'Admin'){ ?>
                                            <button type="button" name="submit" class="userbutton" data-id="<?php echo $value->id; ?>">
                                                <i class="icon-pencil"></i>
                                            </button>
                                            <a onclick="confirms('Delete','Media Social `<?=$value->social_media ?>`?','<?=base_url('root/deleteSocial') ?>','<?=$value->id?>')" <?php if($value->id == $this->session->userdata('user_login_id')){ echo 'hidden'; } ?> >
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
<?php $this->load->view('root/social_modal')?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".userbutton").click(function(e) {
            e.preventDefault(e);

            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');

            $('#socialUpdate').trigger("reset");
            $('#socialmodal').modal('show');

            $.ajax({
                url: '<?php echo base_url(); ?>root/viewSocialDataBYID?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {

                // Populate the form fields with the data returned from server
                var theForm = $('#socialUpdate');

                theForm.find('[name="id_social"]').val(response.dataresult.id).end()
                        .find('[name="social_name"]').val(response.dataresult.social_media).end()
                        .find('[name="social_link"]').val(response.dataresult.link).end()
                        .find('[name="social_icon"]').val(response.dataresult.icon).end()
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
            var formval = $('#socialUpdate')[0];

            // Create an FormData object
            var data = new FormData(formval);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?php echo base_url(); ?>root/do_updateSocial",
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