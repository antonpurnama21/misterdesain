<div class="wrapper-page">

    <div class="page-title">
        <h1><i class="icon-people"></i><?=$titlePage?></h1>
        <?php echo @$status;  echo @$response;  ?>
    </div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content_wrapper">
                        <div class="table_banner clearfix">
                            <h5 class="table_banner_title">Expert</h5>
                        </div>
                        <div class="table_body text-left">
                            <table id="example" class="table table-condensed responsive table_custom" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Id Expert</th>
                                        <th>Full name</th>
                                        <th>Position</th>
                                        <th>Expertise</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (!empty($data)) {
                                    foreach($data as $value): ?>
                                    <tr>
                                        <td>
                                            <?php if(!empty($value->photo)){ ?>
                                                <img src="<?php echo base_url($value->photo); ?>" alt="Starter kit">
                                            <?php } else { ?>
                                            <img src="<?php echo base_url(); ?>assets/img/user/default.jpg" alt="Starter kit">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $value->id_expert ?>
                                        </td>
                                        <td><?php echo $value->full_name ?></td>
                                        <td><?=position($value->id_position)?></td>
                                        <td>
                                            <?php echo $value->expertise ?>
                                        </td>

                                        <td class="action-buttons">
                                            <?php if($sesi['user_role'] == 'Admin'){ ?>
                                            <button type="button" name="submit" class="userbutton" data-id="<?php echo base64_encode($value->id_expert); ?>">
                                                    <i class="icon-pencil"></i>
                                            </button>
                                            <a onclick="confirms('Delete','Expert `<?=$value->full_name ?>`?','<?=base_url('root/deleteExpert') ?>','<?=base64_encode($value->id_expert)?>')" <?php if($value->id_expert == $this->session->userdata('user_login_id')){ echo 'hidden'; } ?> >
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
<?php $this->load->view('root/expert_modal')?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".userbutton").click(function(e) {
            e.preventDefault(e);

            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');

            $('#ValueUpdate').trigger("reset");
            $('#loadmodel').modal('show');

            $.ajax({
                url: '<?php echo base_url(); ?>root/viewExpertDataBYID?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {

                // Populate the form fields with the data returned from server
                var theForm = $('#ValueUpdate');

                theForm.find('[name="idexpert"]').val(response.value.id_expert).end()
                        .find('[name="fullname"]').val(response.value.full_name).end()
                        .find('[name="id_position"]').val(response.value.id_position).end()
                        .find('[name="expertise"]').val(response.value.expertise).end()

                var imgSrc = '<?php echo base_url(); ?>' + response.value.photo;
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
            var formval = $('#ValueUpdate')[0];

            // Create an FormData object
            var data = new FormData(formval);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?php echo base_url(); ?>root/do_updateExpert",
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