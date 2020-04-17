<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=$titleWeb?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="<?php echo base_url() ?>icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo base_url() ?>icon.png">
    <!-- css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap3.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/sweetalert2.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/fullcalendar.css">
    <link href="<?php echo base_url() ?>assets/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css">
    <?php if(isset($_CSS) and !empty($_CSS)) echo $_CSS; ?>
    <!-- / css -->

    <!-- min js -->
    <script src="<?php echo base_url() ?>assets/js/vendor/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/vendor/jquery.validate.min.js"></script>
    <!-- / min js -->
    <style type="text/css">
        nav .navbar-nav li > a {
            color: #fff;
        }
        nav.navbar {
            background-color: #194775;
        }
        .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
            background-color: #003366;
            border-color: #003366
            border-color: #0288d0;
            color: #fff;
        }
        .navbar-nav>.open>a, .nav>li>a:focus, .nav>li>a:hover {
            background-color: transparent;
            color: #fff;
        }
        
        .left-sidebar {
            background-color: #3e5371;
        }
        .sidebar-nav ul > li a {
            color: #fff;
        }
        .sidebar-nav ul > li.menu-header {
            color: #fff;
        }
        .sidebar-nav>ul>li.active>a {
            background-color: rgba(255, 255, 255, 0.09);
        }
        .sidebar-nav ul li.active a i, .sidebar-nav ul li a:hover i {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="wrapper-main">
        <header class="topbar clearfix">
            <nav class="navbar navbar-fixed-top bg-white">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-options-vertical"></span>
                        </button>
                        <button id="sidebar-toggle" type="button" class="navbar-toggle toggle-sidebar-bars" data-target="#sidebar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-menu"></span>
                        </button>
                        <a class="navbar-brand text-center" href="<?php echo base_url('dashboard'); ?>">
                            <img src="<?php echo base_url(); ?>assets/img/<?php echo $settingsvalue->sitelogo; ?>" alt="C">
                            </a>
                    </div>
                    <?php /*echo $this->session->flashdata('feedback');*/ ?>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class="hidden-xs">
                                <a href="#" class="sidebar-toggle">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown notification-parent">
                                <style>
                                    .note-count i:after {
                                        content: attr(data-badge);
                                        position: absolute;
                                        top: -8px;
                                        right: -8px;
                                        font-size: 8px;
                                        background: #F44336;
                                        color: white;
                                        width: 15px;
                                        height: 15px;
                                        text-align: center;
                                        line-height: 14px;
                                        border-radius: 50%;
                                    }
                                    .note-count-changed i:after {
                                        content: '0' !IMPORTANT;
                                    }
                                </style>
                                <a href="" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle note-count">
                                    <i class="icon-bubbles notification-icon" data-badge="<?php echo count($query_user); ?>" style="position: relative;"></i> <span class="hidden-sm hidden-md hidden-lg notification-text">Comments</span>
                                </a>
                                <ul class="dropdown-menu dropdown-box">
                                    <li class="dropdown-head">
                                        Recent Comments
                                    </li>
                                    <?php if(count($query_user)) { ?>
                                    <li class="box-list">
                                    <?php foreach ($query_user as $value): ?>
                                        <a href="<?php echo base_url(); ?>root/View_profile?U=<?php echo base64_encode($value->id_user) ?>">
                                            <div class="media">
                                                <div class="media-left box-img">
                                                    <img src="<?php echo base_url($value->image); ?>">
                                                </div>
                                                <div class="media-body box-text">
                                                    <h6><?php echo $value->full_name; ?></h6>
                                                    <p><?php echo mb_strimwidth($value->description, 0, 35, '...'); ?></p>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                    </li>
                                    <?php } else { ?>
                                    <li class="box-list" style="padding: 15px 0 15px 25px;">All caught up!</li>
                                    <?php } ?>
                                    <li class="dropdown-foot">
                                        View all
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown notification-parent">
                                <a href="" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                                    <i class="icon-bell notification-icon"></i> <span class="hidden-sm hidden-md hidden-lg notification-text">Notification</span>
                                </a>
                                <ul class="dropdown-menu dropdown-box">
                                    <li class="dropdown-head">
                                        Notifications
                                    </li>
                                    <li class="box-list">
                                        <a href="">
                                            <div class="media">
                                                <div class="media-left box-img">
                                                    <img src="<?php echo base_url(); ?>assets/img/clients-thumb/six.png">
                                                </div>
                                                <div class="media-body box-text">
                                                    <h6>Tom Baier</h6>
                                                    <p>Lorem ipsum dolor sit amet amra</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-foot">
                                        View all
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="user-img pull-left">
                                        <img alt="Dotdev" src="<?php echo base_url($profilevalue->image); ?>">
                                    </span><?php echo $profilevalue->full_name; ?> <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu topbar-dropdown-wrapper" role="menu">
                                    <ul class="dropdown-user-inner">
                                        <li>
                                            <div class="dd-userbox">
                                                <div class="dd-img">
                                                    <img alt="product management" src="<?php echo base_url($profilevalue->image); ?>">
                                                </div>
                                                <div class="dd-info">
                                                    <h4>
                                                        <?php echo $profilevalue->full_name; ?>
                                                    </h4>
                                                    <p>
                                                        <?php echo $profilevalue->email; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="divider"></li> 
                                        <li data-id="users" class="main"><a href="<?php echo base_url();?>root/View_profile?U=<?php echo base64_encode($sesi['user_login_id']); ?>"><i class="icon-user mr10"></i> Profile</a></li>
                                        <li><a id="resetmodal" href=""><i class="icon-key mr10"></i> Change Password</a></li>
                                        <li class="divider"></li>
                       
                                        <?php if($sesi['user_role'] == 'Admin'){ ?>
                                            <li data-id="configuration" class="main"><a href="#"><i class="icon-settings mr10"></i> Configuration</a></li>
                                        <?php } ?>
                                        <li data-id="dashboard" class="main"><a href="<?php echo base_url();?>auth/logout"><i class="icon-logout mr10"></i> Sign Out</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
      
        </header>

        <!-- Main navigation -->
        <?php $this->load->view('partials/sidebar'); ?>
        <!-- /main navigation -->

        <!-- Dashboard content -->
                            
        <?= $body ?>

        <!-- /dashboard content -->

        <!--Reset password validation modal-->
        <?php $this->load->view('mod_reset'); ?>

        <script type="text/javascript">
        $(document).ready(function () {
            $("#resetmodal").click(function (e) {
                e.preventDefault(e);
                $('#reset').modal('show');
            });
        });
        
        </script>          
        <div class="footer">
        	© 2020 Administrator Panel By Anton Purnama
        </div>

    </div>
    <!-- min js -->
    <script src="<?php echo base_url() ?>assets/js/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery-jvectormap-world-mill.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/bootstrap.min.js"></script>    
    <script src="<?php echo base_url(); ?>assets/js/vendor/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/sweetalert2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/jquery.magnific-popup.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/js/vendor/jquery.elevatezoom.min.js" ></script> 
    <script src="<?php echo base_url(); ?>assets/js/vendor/Chart.min.js" integrity="sha256-UGwvyUFH6Qqn0PSyQVw4q3vIX0wV1miKTracNJzAWPc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/fullcalendar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/dropzone.js"></script>
    <!-- / min js -->

    <!-- js -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/notif.js"></script>
    <?php if(isset($_JS) and !empty($_JS)) echo $_JS; ?>
    <!-- js -->

<script type="text/javascript">
    //initiate the plugin and pass the id of the div containing gallery images
    $("#zoom_03").elevateZoom({
        zoomType: 'lens',
        lensShape: 'square',
        lensSize: '250',
        easing: true,
        cursor: 'pointer',
        galleryActiveClass: 'active',
        zoomWindowPosition: 11,
        gallery: 'gallery_01',
        borderSize: 0,
        containLensZoom: true,
        responsive: true,
        lensShape: 'round'
    });

    //pass the images to Fancybox
    $("#zoom_03").bind("click", function(e) {
        $('#zoom_03').data('elevateZoom');
        return false;
    });

    // updating the view with notifications using ajax
    function load_unseen_note(id = '') {
        $.ajax({
            url: "<?php echo base_url(); ?>root/set_note",
            method: "POST",
            data: { id: id }
        });
    }

    $(document).on('click', '.note-count', function() {
        <?php if(!empty($sesi['user_login_id'])){
            $userid = $sesi['user_login_id'];   
        } ?>
        load_unseen_note('<?php echo $userid; ?>');
        $(this).addClass('note-count-changed');
    });
</script>
		
</body>

</html>    	