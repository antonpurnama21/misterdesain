<div class="wrapper-page">

    <div class="page-title">
        <h1><i class="icon-picture"></i><?=$titlePage?></h1>
        <?php echo @$status;  echo @$response;  ?>
    </div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content_wrapper">
                        <div class="table_banner clearfix">
                            <h5 class="table_banner_title">Gallery</h5>
                        </div>
                        <div class="table_body text-left">
                            <table id="example" class="table table-condensed responsive table_custom" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Service</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (!empty($data)) {
                                        $no = 0;
                                    foreach($data as $value): 
                                        $no++; ?>
                                    <tr>
                                        <td><?= $no;?></td>
                                        <td>
                                            <div class="uploaded_image">
                                                <a href="<?php echo base_url($value->img_url)?>">
                                                    <img src="<?php echo base_url($value->img_url)?>">
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo category($value->id_category); ?>
                                        </td>
                                        <td>
                                            <?php echo service($value->id_service); ?>
                                        </td>
                                        <td>
                                            <?php echo $value->type_gallery ?>
                                        </td>

                                        <td class="action-buttons">
                                                <a href="<?php echo base_url();?>root/update_gallery?id=<?php echo base64_encode($value->id_gallery) ?>">
                                                        <i class="icon-pencil"></i>
                                                </button>
                                            <a onclick="confirms('Delete','Gallery `?','<?=base_url('root/deleteGallery') ?>','<?=base64_encode($value->id)?>')" <?php if($value->id == $this->session->userdata('user_login_id')){ echo 'hidden'; } ?> >
                                                    <i class="icon-close"></i>
                                            </a>
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