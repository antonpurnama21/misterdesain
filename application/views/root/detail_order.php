<div class="wrapper-page">

<div class="page-title">
    <h1><i class="icon-tag"></i> <?=$titlePage?></h1>
</div>
<div class="page-content">
    <div class="container-fluid">                   
    <div class="row">
        <div class="col-md-8">
            <div class="content_wrapper">
                <div class="table_banner clearfix">
                    <h5 class="table_banner_title">Detail Order</h5>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="profile-row clearfix">
                            <div class="col-sm-3">
                                <span class="profile-cat">ID Booking</span>
                            </div>
                            <div class="col-sm-9">
                                <span class="profile-info"><?php echo $data->id_booking; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile-row clearfix">
                            <div class="col-sm-3">
                                <span class="profile-cat">Customer Name</span>
                            </div>
                            <div class="col-sm-9">
                                <span class="profile-info"><?php echo $data->customer_name; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile-row clearfix">
                            <div class="col-sm-3">
                                <span class="profile-cat">Phone Number</span>
                            </div>
                            <div class="col-sm-9">
                                <span class="profile-info"><?php echo $data->phone_num; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile-row clearfix">
                            <div class="col-sm-3">
                                <span class="profile-cat">Customer Email</span>
                            </div>
                            <div class="col-sm-9">
                                <span class="profile-info"><?php echo $data->customer_email; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile-row clearfix">
                            <div class="col-sm-3">
                                <span class="profile-cat">Address</span>
                            </div>
                            <div class="col-sm-9">
                                <span class="profile-info"><?php echo nl2br($data->customer_address); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile-row clearfix">
                            <div class="col-sm-3">
                                <span class="profile-cat">Service Order</span>
                            </div>
                            <div class="col-sm-9">
                                <span class="profile-info"><?php echo service($data->id_service); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile-row clearfix">
                            <div class="col-sm-3">
                                <span class="profile-cat">Layout File</span>
                            </div>
                            <div class="col-sm-9">
                                <span class="profile-info"><?=($data->layout_file_path != '') ? '<a class="btn btn-sm btn-primary" href="'.base_url('root/download/'.$data->id_booking).'">Download</a>' : 'Tak ada File'?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile-row clearfix">
                            <div class="col-sm-3">
                                <span class="profile-cat">Note</span>
                            </div>
                            <div class="col-sm-9">
                                <span class="profile-info"><?php echo nl2br($data->note); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile-row clearfix">
                            <div class="col-sm-3">
                                <span class="profile-cat">Status</span>
                            </div>
                            <div class="col-sm-9">
                                <span class="profile-info"><?php echo $data->status_booking; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>            
</div>
</div>