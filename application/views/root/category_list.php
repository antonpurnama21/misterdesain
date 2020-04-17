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
                            <h5 class="table_banner_title">Category</h5>
                        </div>
                        <div class="table_body text-left">
                            <table id="example" class="table table-condensed responsive table_custom" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Category</th>
                                        <th>Category Name</th>
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
                                            <?php echo $value->id_category ?>
                                        </td>
                                        <td>
                                            <?php echo $value->category_name ?>
                                        </td>
                                        <td>
                                            <?php echo $value->created_on ?>
                                        </td>

                                        <td class="action-buttons">
                                            <?php if($sesi['user_role'] == 'Admin'){ ?>
                                            <button type="button" name="submit" class="userbutton" data-id="<?php echo $value->id_category; ?>">
                                                <i class="icon-pencil"></i>
                                            </button>
                                            <a onclick="confirms('Delete','Category `<?=$value->category_name ?>`?','<?=base_url('root/deleteCategory') ?>','<?=$value->id_category?>')" <?php if($value->id_category == $this->session->userdata('user_login_id')){ echo 'hidden'; } ?> >
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
<?php $this->load->view('root/category_modal')?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".userbutton").click(function(e) {
            e.preventDefault(e);

            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');

            $('#categoryUpdate').trigger("reset");
            $('#categorymodal').modal('show');

            $.ajax({
                url: '<?php echo base_url(); ?>root/viewCategoryDataBYID?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {

                // Populate the form fields with the data returned from server
                var theForm = $('#categoryUpdate');

                theForm.find('[name="id_category"]').val(response.dataresult.id_category).end()
                        .find('[name="category_name"]').val(response.dataresult.category_name).end()
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
            var formval = $('#categoryUpdate')[0];

            // Create an FormData object
            var data = new FormData(formval);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?php echo base_url(); ?>root/do_updateCategory",
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