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
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name Partner & Client</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (!empty($userlist)) {
                                        $no = 0;
                                    foreach($userlist as $value): $no++;?>
                                    <tr>
                                        <td><?=$no?></td>
                                        <td>
                                            <?php if(!empty($value->image_pc)){ ?>
                                                <img src="<?php echo base_url($value->image_pc); ?>" alt="Starter kit">
                                            <?php } else { ?>
                                            <img src="<?php echo base_url(); ?>assets/img/user/default.jpg" alt="Starter kit">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo ucwords($value->name_pc) ?>
                                        </td>

                                        <td class="action-buttons">
                                            <?php if($sesi['user_role'] == 'Admin'){ ?>
                                            <button type="button" name="submit" class="userbutton" data-id="<?php echo base64_encode($value->id_pc); ?>">
                                                    <i class="icon-pencil"></i>
                                                </button>
                                            <a onclick="confirms('Delete','Partner & Client `<?=$value->name_pc ?>`?','<?=base_url('root/delete_pc') ?>','<?=base64_encode($value->id_pc)?>')" <?php if($value->id_pc == $this->session->userdata('user_login_id')){ echo 'hidden'; } ?> >
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
<?php $this->load->view('root/partner_client_modal')?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".userbutton").click(function(e) {
            e.preventDefault(e);

            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');

            $('#UserValueUpdate').trigger("reset");
            $('#usermodel').modal('show');

            $.ajax({
                url: '<?php echo base_url(); ?>root/viewPcDataBYID?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {

                // Populate the form fields with the data returned from server
                var theForm = $('#UserValueUpdate');

                theForm.find('[name="idpc"]').val(response.uservalue.id_pc).end()
                        .find('[name="name"]').val(response.uservalue.name_pc).end()

                var imgSrc = '<?php echo base_url(); ?>' + response.uservalue.image_pc;
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
                url: "<?php echo base_url(); ?>root/update_pc",
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