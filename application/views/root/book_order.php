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
                                        <th>Id Booking</th>
                                        <th>Costumer Name</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Service</th>
                                        <th>File layout</th>
                                        <th>Status</th>
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
                                        <td><?=$value->id_booking?></td>
                                        <td><?=$value->customer_name?></td>
                                        <td><?=$value->costumer_address?></td>
                                        <td><?=$value->phone_num?></td>
                                        <td><?=$value->customer_email?></td>
                                        <td><?=service($value->id_service)?></td>
                                        <td><?=$value->layout_file_path?></td>
                                        <td><?=$value->status_booking?></td>

                                        <td class="action-buttons">
                                            <?php if($sesi['user_role'] == 'Admin'){ ?>
                                            Action
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