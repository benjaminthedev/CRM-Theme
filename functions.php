<?php

require __DIR__ . '/vendor/autoload.php';

$GLOBALS['THEME_ABS_URL'] = __DIR__;
$GLOBALS['CONTENT_ABS_URL'] = $GLOBALS['THEME_ABS_URL'] . "/content";

/* =============== Theme dependent plugins ===============  */
require_once 'includes/theme_plugins/plugins_init.php';

/* =============== Admin & header cleanup ===============  */
require_once 'includes/helper_fn.php';

/* =============== Global Classes Autoload ===============  */

__autoload(__DIR__ . "/includes/classes/global");

/* =============== Custom  post type ===============  */
require_once 'includes/post-type.php';

/* ===============  style and scripts=============== */
require_once 'includes/styles_scripts.php';

/* =============== Ajax ===============  */
require_once 'includes/ajax.php';

/* =============== Default Plugins ===============  */
require_once 'includes/default_plugins.php';

/* =============== Admin & header cleanup ===============  */
require_once 'includes/base.php';

/* =============== Hooks ===============  */
require_once 'includes/hooks.php';

/* =============== duplicate post ===============  */
require_once 'includes/duplicate_post.php';

/* =============== Add Users ===============  */
require_once 'includes/add_users.php';



/* =============== Add Users ===============  */
register_sidebar(
    array(
        'name' => 'Home Sidebar',
        'before_widget' => '<div class="sub clearfix %2$s">',  
        'after_widget' => '</div>',  
        'before_title' => '<header><h4>',  
        'after_title' => '</h4></header>',  
    ));




?>