<nav class="main-nav transparent hide-menu stick-fixed">
    <div class="full-wrapper relative clearfix">
    
        <!-- Logo -->
        <div class="header-logo-wrap">
            <a href="<?=base_url()?>" class="logo">
                <img src="<?=base_url('assets/img/'.$settingsvalue->sitelogo)?>" width="118" height="27" alt="" />
            </a>
        </div>
        
        <!-- Mobile nav bars -->
        <div class="mobile-nav">
            <i class="fa fa-bars"></i>
        </div>
        
        <!-- Main Menu -->
        <div class="nav-wrapper large-nav">
            <ul class="clearlist">

                <li>
                    <a href="<?=base_url()?>" class="active">Home</a>							
                </li>
                
                <li>
                    <a href="<?=base_url('copublic/about')?>" >About</a>							
                </li>

                <li>
                    <a href="<?=base_url('copublic/service')?>" >Service</a>							
                </li>

                <li>
                    <a href="#" class="menu-down">Gallery <i class="fw900 float-right">+</i></a>
                
                    <ul class="nav-sub">
                        <li>
                            <a href="<?=base_url('copublic/images')?>">Images</a>
                        </li>
                        <li>
                            <a href="<?=base_url('copublic/videos')?>">Videos</a>
                        </li>										
                    </ul>
                
                </li>

                <li>
                    <a href="<?=base_url('copublic/order')?>" >Order</a>							
                </li>
                
                <li><a>&nbsp;</a></li>
                <?php if(!empty($social)){
                foreach ($social as $key) {?>
                <li>
                    <a href="<?=$key->link?>" class="menu-down"><i class="fa <?=$key->icon?>"></i></a>
                </li>
                <?php }} ?>
                
                </ul>
        </div>
        <!-- End Main Menu -->				

    </div>
</nav>