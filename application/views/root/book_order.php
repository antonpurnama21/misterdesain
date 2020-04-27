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
                            <h5 class="table_banner_title">Book Order</h5>
                        </div>
                        <div class="table_body text-left">
                            <table id="example" class="table table-condensed responsive table_custom" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Booking</th>
                                        <th>Costumer Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Service</th>
                                        <th>Status</th>
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
                                        <td><?=$value->phone_num?></td>
                                        <td><?=$value->customer_email?></td>
                                        <td><?=service($value->id_service)?></td>
                                        <td><?=$value->status_booking?></td>

                                        <td class="action-buttons">
                                            <?php if($sesi['user_role'] == 'Admin'){ ?>
                                            <?=($value->status_booking == 'PENDING') ? '<a class="btn btn-success" href="'.base_url('root/uprove/'.$value->id_booking).'">Uprove</a>' : 'Uproved' ?> <br><br> <a class="btn btn-primary" href="<?=base_url('root/detail_order/'.$value->id_booking)?>">Detail</a>
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