<script>
    $(function() {
        localStorage.setItem('thisLink', 'dashboard');
        thisLink = localStorage.getItem('thisLink');
        if (thisLink) {
            $('#' + thisLink).addClass('active');
        }
    });
</script>
        <div class="wrapper-page">

            <div class="page-title">
                <h1><i class="icon-grid"></i> Dashboard</h1>
            </div>
            <div class="flashmessage">Faka?</div>
            <div class="page-content">
                <div class="container-fluid">                   
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel bg-white br-1">
                                <div class="panel-body widget">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="pull-left">User</h5>
                                            <span class="pull-right"><i class="icon-user"></i></span>
                                            <div class="clearfix"></div>
                                            <h1>00<?php
                                                   $this->db->where('role','User');
        									       $this->db->from("tbl_users");
        									       echo $this->db->count_all_results();
            									?>
                                            </h1>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="progress">
                                              <div class="progress-bar red" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel bg-white br-1">
                                <div class="panel-body widget">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="pull-left">Admin</h5>
                                            <span class="pull-right"><i class="icon-people"></i></span>
                                            <div class="clearfix"></div>
                                            <h1>00<?php 
            									$this->db->where('role','Admin');
            									$this->db->from("tbl_users");
            									echo $this->db->count_all_results();
        									?>
                                            </h1>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="progress">
                                              <div class="progress-bar orange" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel bg-white br-1">
                                <div class="panel-body widget">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="pull-left">Product</h5>
                                            <span class="pull-right"><i class="icon-bag"></i></span>
                                            <div class="clearfix"></div>
                                            <h1>00<?php
                                                echo $this->db->count_all_results('tbl_services');
                                                ?>
                                            </h1>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="progress">
                                              <div class="progress-bar grey" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel bg-white br-1">
                                <div class="panel-body widget">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="pull-left">Sold</h5>
                                            <span class="pull-right"><i class="icon-check"></i></span>
                                            <div class="clearfix"></div>
                                            <h1>033</h1>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="progress">
                                              <div class="progress-bar yellow" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>            
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel no-border">
                                <div class="content_wrapper">
                                    <div class="table_banner clearfix">
                                        <h5 class="table_banner_title">Sales Progress</h5>
                                    </div>
                                    <div class="table_body text-center">
                                        <canvas id="myChart" width="50" height="25"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="panel no-border no-bgc clearfix">
                                <div class="table_banner clearfix">
                                    <h5 class="table_banner_title">Quick notes</h5>
                                </div>
                                <div class="bg-white">
                                    <div class="slimScrollNote">
                                        <div class="todo-box-wrap">
                                            <ul class="todo-list">
                                                <?php
                                                    if (!empty($todolist)) {
                                                    foreach ($todolist as $value) { ?>
                                                <li class="todo-item">
                                                   <?php if($value->value == '1'){ ?>
                                                    <div class="checkbox checkbox-default">
                                                        <input class="to-do" data-id="<?php echo $value->id?>" data-value="0" type="checkbox" id="<?php echo $value->id?>" >
                                                        <label for="<?php echo $value->id?>"><?php echo $value->to_dodata; ?></label>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div class="checkbox checkbox-default">
                                                        <input class="to-do" data-id="<?php echo $value->id?>" data-value="1" type="checkbox" id="<?php echo $value->id?>" checked>
                                                        <label for="<?php echo $value->id?>"><?php echo $value->to_dodata; ?></label>
                                                    </div> 
                                                    <?php } ?>                                                  
                                                </li>
                                                <?php }} ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="new-todo">
                                    <form method="post" enctype="multipart/form-data" id="add_todo">
                                        <div class="input-group">

                                            <input type="text" id="todo_data" name="todo_data" class="form-control" style="border: 1px solid #fff !IMPORTANT;" placeholder="Add new task">
                                            <span class="input-group-btn">

                                            <input type="hidden" name="iduser" id="iduser" value="<?php echo $sesi['user_login_id']; ?>">

                                            <button type="submit" class="btn btn-success todo-submit"><i class="fa fa-plus"></i></button>
                                            </span> 

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <!-- <div class="row">
                        <div class="col-md-8">
                            <div class="panel no-border">
                                <div class="content_wrapper">
                                    <div class="table_banner clearfix">
                                        <h5 class="table_banner_title">Our Client-base</h5>
                                    </div>
                                    <div class="table_body text-center">
                                        <div id="map" style="width: 100%; height:400px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div><!-- /.page-content  -->
        </div>




