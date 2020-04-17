<aside class="left-sidebar">
    <div class="slimscroll-left-sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li data-id="dashboard" id="dashboard" class="main">
                    <a class="" href="<?php echo base_url('dashboard'); ?>" aria-expanded="false">
                        <i class="icon-grid"></i>
                        <span class="">
                            Dashboard
                        </span>
                    </a>
                </li>
                <?php if($sesi['user_role'] == 'Admin'){ ?>
                <li data-id="users" id="users" class="main">
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-user"></i>
                        <span class="">
                            Users
                        </span>
                    </a>
                    <ul aria-expanded="true" class="">
                        <li><a href="<?php echo base_url(); ?>root/list_user">List User</a></li>
                        <li><a href="<?php echo base_url(); ?>root/Add_User">Add User</a></li>
                    </ul>
                </li>
                <li data-id="user-role" id="user-role" class="main">
                    <a class="" href="<?php echo base_url(); ?>root/ListGroup" aria-expanded="false">
                        <i class="icon-shuffle"></i>
                        <span class="">
                            Users Role
                        </span>
                    </a>
                </li>
                <li data-id="services" id="services" class="main">
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-briefcase"></i>
                        <span class="">
                            Services
                        </span>
                    </a>
                    <ul aria-expanded="true" class="">
                        <li><a href="<?php echo base_url(); ?>root/list_service">List Services</a></li>
                        <li><a href="<?php echo base_url(); ?>root/add_service">Add Services</a></li>
                    </ul>
                </li>
                <li data-id="category" id="category" class="main">
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-tag"></i>
                        <span class="">
                            Category
                        </span>
                    </a>
                    <ul aria-expanded="true" class="">
                        <li><a href="<?php echo base_url(); ?>root/list_category">List Category</a></li>
                        <li><a href="<?php echo base_url(); ?>root/add_category">Add Category</a></li>
                    </ul>
                </li>
                <li data-id="position" id="position" class="main">
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-tag"></i>
                        <span class="">
                        Position
                        </span>
                    </a>
                    <ul aria-expanded="true" class="">
                        <li><a href="<?php echo base_url(); ?>root/list_position">List Position</a></li>
                        <li><a href="<?php echo base_url(); ?>root/add_position">Add Position</a></li>
                    </ul>
                </li>
                <li data-id="cprofile" id="cprofile" class="main">
                    <a class="" href="<?php echo base_url(); ?>root/profile_company" aria-expanded="false">
                        <i class="icon-home" aria-hidden="true"></i>
                        <span class="">
                            Company Profile
                        </span>
                    </a>
                </li>
                <li data-id="expert" id="expert" class="main">
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-people"></i>
                        <span class="">
                            Experts
                        </span>
                    </a>
                    <ul aria-expanded="true" class="">
                        <li><a href="<?php echo base_url(); ?>root/list_expert">List Expert</a></li>
                        <li><a href="<?php echo base_url(); ?>root/add_expert">Add Expert</a></li>
                    </ul>
                </li>

                <li data-id="social" id="social" class="main">
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-globe"></i>
                        <span class="">
                            Media Social
                        </span>
                    </a>
                    <ul aria-expanded="true" class="">
                        <li><a href="<?php echo base_url(); ?>root/list_social">List Media Social</a></li>
                        <li><a href="<?php echo base_url(); ?>root/add_social">Add Media Social</a></li>
                    </ul>
                </li>

                <?php } ?>
                <li data-id="product" id="product" class="main">
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-picture"></i>
                        <span class="">
                            Gallery
                        </span>
                    </a>
                    <ul aria-expanded="true" class="">
                        <li><a href="<?php echo base_url(); ?>root/list_gallery">List Gallery</a></li>
                        <li><a href="<?php echo base_url(); ?>root/add_gallery">Add Gallery</a></li>
                    </ul>
                </li>
                <li data-id="video" id="video" class="main">
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-camera"></i>
                        <span class="">
                            Video
                        </span>
                    </a>
                    <ul aria-expanded="true" class="">
                        <li><a href="<?php echo base_url(); ?>root/list_video">List Video</a></li>
                        <li><a href="<?php echo base_url(); ?>root/add_video">Add Video</a></li>
                    </ul>
                </li>
                <li data-id="order" id="order" class="main">
                    <a class="" href="<?php echo base_url(); ?>root/book_order" aria-expanded="false">
                        <i class="icon-basket" aria-hidden="true"></i>
                        <span class="">
                            Order Book
                        </span>
                    </a>
                </li>
                <li data-id="web" id="web" class="main">
                    <a class="" href="<?php echo base_url(); ?>" target="_blank" aria-expanded="false">
                        <i class="icon-rocket" aria-hidden="true"></i>
                        <span class="">
                            Website
                        </span>
                    </a>
                </li>
                <?php if($sesi['user_role'] == 'Admin'){ ?>
                <li data-id="configuration" id="configuration" class="main">
                    <a class="" href="<?php echo base_url(); ?>root/Site_Settings" aria-expanded="false">
                        <i class="icon-settings" aria-hidden="true"></i>
                        <span class="">
                            Configuration
                        </span>
                    </a>
                </li>
                <li data-id="backup" id="backup" class="main">
                    <a class="" href="#" aria-expanded="false">
                        <i class="icon-arrow-down-circle" aria-hidden="true"></i>
                        <span class="">
                            Backup
                        </span>
                    </a>
                </li>
                <?php } ?>
            </ul>                      
        </nav>
    </div>
</aside>