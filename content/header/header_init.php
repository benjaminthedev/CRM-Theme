<header id="main_header">
    <div class="container-fluid clearfix">
        <a href="<?php echo get_site_url(); ?>" class="float-left logo">
            <?php echo get_img('logo.png', 'logo') ?>
        </a>
        <nav id="main_nav" class="float-right">
            <?php wp_nav_menu(['theme_location' => 'primary','menu_class' => 'menu clearfix']); ?>
        </nav>
        <a href="#" class="menu_btn hidden-xxl-up">
            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
    </div>
</header>

