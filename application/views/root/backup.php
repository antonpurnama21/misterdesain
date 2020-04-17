        <div class="wrapper-page">
                
            <div class="page-title">
                <h1><i class="icon-organization"></i> Back Up</h1>
                <span style="color:green"><?php echo $this->session->flashdata('feedback'); ?></span>
            </div>
                <div class="page-content">
                <div class="container-fluid">           
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel no-border">
                                <div class="content_wrapper">

                                    <div class="table_banner clearfix">
                                        <h5>Back Up Database</h5>
                                    </div>
                                    <div class="table_body">
                                        <a href="<?php echo base_url(); ?>root/Backup_Database" class="btn btn-custom" role="button">
                                        <i class="icon-cloud-download"></i> &nbsp; Backup
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>            
        </div>
        </div>
<span class="flashmessage"><?php echo $this->session->flashdata('feedback'); ?></span>