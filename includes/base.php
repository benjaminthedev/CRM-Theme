<?php
/* =============== Custom Login style  =============== */

function custom_login_css()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/admin/login/login-styles.css" />';
}

add_action('login_head', 'custom_login_css');

/* remove private prefix from 404 page. Allows user to customize 404 page */

function remove_private_prefix($title)
{
    if (!is_admin()) {
        global $post;

        if ($post) {


            if ($post->post_name == "404-page") {
                $title = str_replace(
                    'Private:', '', $title);
            }
        }
    }
    return $title;
}

add_filter('the_title', 'remove_private_prefix');


/* ===============  Init WP_Head cleanUp ===============  */

function pd_startup()
{
    add_action('init', 'pd_head_cleanup');
    add_action('after_setup_theme', 'pd_theme_support'); /* end pd theme support */
}

/* ===============  Clearn wp_head ===============  */

function pd_head_cleanup()
{

    /* ===============
      Remove RSS from header
      =============== */
    remove_action('wp_head', 'rsd_link'); #remove page feed
    remove_action('wp_head', 'feed_links_extra', 3); // Remove category feeds
    remove_action('wp_head', 'feed_links', 2); // Remove Post and Comment Feeds


    /* ===============
      remove windindows live writer link
      =============== */
    remove_action('wp_head', 'wlwmanifest_link');


    /* ===============
      links for adjacent posts
      =============== */
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


    /* ===============
      WP version
      =============== */
    remove_action('wp_head', 'wp_generator');


    /* ===============
      remove WP version from css
      =============== */
    add_filter('style_loader_src', 'pd_remove_wp_ver_css_js', 9999);


    /* ===============
      remove Wp version from scripts
      =============== */
    add_filter('script_loader_src', 'pd_remove_wp_ver_css_js', 9999);
}

add_action('after_setup_theme', 'pd_startup');


/* ===============  Theme support feature ===============  */

function pd_theme_support()
{

    /* =============== 	Add language supports ===============  */
    load_theme_textdomain('pd', get_template_directory() . '/lang');


    /* =============== Rss feed support ===============  */
    add_theme_support('automatic-feed-links');


    /* =============== 	 Add post formarts supports ===============  */
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
}

add_theme_support('post-thumbnails');


/* ===============  Better standard pagination ===============  */

function pd_pagination()
{

    global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    if ($total_pages > 1) {

        $current_page = max(1, get_query_var('paged'));

        echo '<div class="page_nav">';
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => 'Prev',
            'next_text' => 'Next'
        ));
        echo '</div>';
    }
}

/* =============== Add navigation ===============  */

function register_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'pd'),
        'footer' => __('Footer Navigation', 'pd'),
    ));
}

add_action('after_setup_theme', 'register_menus');


/* =============== remove WP version from scripts ===============  */

function pd_remove_wp_ver_css_js($src)
{
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}

/* =============== Wrap img in figure tags ===============  */

function pd_img_unautop($imgWrap)
{
    $imgWrap = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $imgWrap);
    return $imgWrap;
}

/* =============== topclick Credits =============== */

function my_admin_footer_text($default_text)
{
    return '<span id="footer-thankyou">Website built by <a href="http://www.topclick"><span style="color: #a3223b">topclick</span></a><span> | Powered by <a href="http://www.wordpress.org">WordPress</a>';
}

add_filter('admin_footer_text', 'my_admin_footer_text');


/* =============== Display on the admin bar what template is used  =============== */

function toolbar_link_to_mypage($wp_admin_bar)
{
    global $current_user;

    if (!is_admin() && $current_user->roles[0] == "administrator") {
        global $template;

        $url = get_template_directory();
        $template = str_replace($url . "/", "", $template);

        $args = array(
            'html' => true,
            'id' => 'my_page',
            'title' => "Template Name :   <strong>" . $template . "</strong>",
            'meta' => array('class' => 'template-name')
        );
        $wp_admin_bar->add_node($args);
    }
}

add_action('admin_bar_menu', 'toolbar_link_to_mypage', 999);

// Add Custom Post Type to WP-ADMIN Right Now Widget
function vm_right_now_content_table_end()
{
    $args = array(
        'public' => true,
        '_builtin' => false
    );
    $output = 'object';
    $operator = 'and';
    $post_types = get_post_types($args, $output, $operator);
    foreach ($post_types as $post_type) {
        $num_posts = wp_count_posts($post_type->name);
        $num = number_format_i18n($num_posts->publish);
        $text = _n($post_type->labels->name, $post_type->labels->name, intval($num_posts->publish));
        if (current_user_can('edit_posts')) {
            $cpt_name = $post_type->name;
        }
        echo '<li class="post-count"><tr><a href="edit.php?post_type=' . $cpt_name . '"><td class="first b b-' . $post_type->name . '"></td>' . $num . '&nbsp;<td class="t ' . $post_type->name . '">' . $text . '</td></a></tr></li>';
    }
}

add_action('dashboard_glance_items', 'vm_right_now_content_table_end');

// Remove WordPress logo from top-left corner of admin bar

function remove_admin_bar_links()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
}

add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');


/* =============== Get page ID by slug  =============== */

function get_ID_by_slug($page_slug)
{
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

/* =============== Thumbnail  =============== */

//add_action('after_setup_theme', 'gallery_thumb_size');
function link_block_thumb()
{
    add_image_size('link_block_thumb', 884, 540, true); // Hard crop to exact dimensions (crops sides or top and bottom)
}

add_action('after_setup_theme', 'link_block_thumb');

//add_action('after_setup_theme', 'gallery_thumb_size');
function user_thumb()
{
    add_image_size('user_thumb', 470, 470, true); // Hard crop to exact dimensions (crops sides or top and bottom)
}

add_action('after_setup_theme', 'user_thumb');


/* ======= Upload Mimes =============== */

add_filter('upload_mimes', 'my_upload_mimes');

function my_upload_mimes($existing_mimes = array())
{
    $existing_mimes['csv'] = 'text/csv';
    $existing_mimes['svg'] = 'image/svg+xml';
    return $existing_mimes;
}

/* ======= CSV to Array =============== */

function csv_to_array($csvFile = '', $delimiter = ',')
{
    $aryData = array();
    $header = NULL;
    $handle = fopen($csvFile, "r");
    if ($handle) {
        while (!feof($handle)) {
            $aryCsvData = fgetcsv($handle);
            if (!is_array($aryCsvData)) {
                continue;
            }
            if (is_null($header)) {
                $header = $aryCsvData;
            } elseif (is_array($header) && count($header) == count($aryCsvData)) {
                $aryData[] = array_combine($header, $aryCsvData);
            }
        }
        fclose($handle);
    }
    return $aryData;
}

/* ======= Limit words  =============== */

function limit_words($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}


/* =============== Pagination  =============== */

function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged))
        $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link(1) . "'>&laquo;</a>";
        if ($paged > 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages)
            echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">&rsaquo;</a>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($pages) . "'>&raquo;</a>";
    }
}

/* =============== Add Excerpt  =============== */

add_action('init', 'my_add_excerpts_to_pages');

function my_add_excerpts_to_pages()
{
    add_post_type_support('page', 'excerpt');
}


/* =============== Woocommerce Support  =============== */

add_action('after_setup_theme', 'woocommerce_support');

function woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/* =============== Woocommerce Removes links  =============== */

add_filter('woocommerce_product_is_visible', 'product_invisible');
function product_invisible()
{
    return false;
}

/* =============== Woocommerce Remove single page  =============== */

add_filter('woocommerce_register_post_type_product', 'hide_product_page', 12, 1);
function hide_product_page($args)
{
    $args["publicly_queryable"] = false;
    $args["public"] = false;
    return $args;
}


/* =============== Woocommerce Add Custom Meta =============== */

function wc_add_custom_to_product()
{
    global $post;
    woocommerce_wp_text_input(array(
        'id' => '_rrp_price',
        'data_type' => 'price',
        'value' => get_post_meta($post->ID, '_rrp_price', true),
        'label' => __('RRP Price', 'woocommerce') . ' (' . get_woocommerce_currency_symbol() . ')'
    ));
    woocommerce_wp_text_input(array(
        'id' => '_ean',
        'type' => 'text',
        'value' => get_post_meta($post->ID, '_ean', true),
        'label' => __('EAN', 'woocommerce')
    ));
}

function wc_add_custom_to_product_var()
{
    global $post;
    $product = wc_get_product($post->ID);
    if ($product->is_type('variable'))
        woocommerce_wp_text_input(array(
            'id' => '_rrp_price',
            'data_type' => 'text',
            'value' => get_post_meta($post->ID, '_rrp_price', true),
            'label' => __('RRP Price', 'woocommerce') . ' (' . get_woocommerce_currency_symbol() . ')'
        ));
}

function variation_settings_fields($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
        'id' => '_ean',
        'type' => 'text',
        'value' => get_post_meta($variation->ID, '_ean', true),
        'label' => __('EAN', 'woocommerce')
    ));
}


add_action('woocommerce_product_options_pricing', 'wc_add_custom_to_product');
add_action('woocommerce_product_options_sku', 'wc_add_custom_to_product_var');
add_action('woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3);

function wc_custom_save_product($product_id)
{
    if (isset($_POST['_inline_edit']))
        if (wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
            return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (isset($_POST['_ean'])) {
        update_post_meta($product_id, '_ean', $_POST['_ean']);
    } else delete_post_meta($product_id, '_ean');
    if (isset($_POST['_rrp_price'])) {
        if (is_numeric($_POST['_rrp_price']))
            update_post_meta($product_id, '_rrp_price', $_POST['_rrp_price']);
    } else delete_post_meta($product_id, '_rrp_price');
}

add_action('save_post', 'wc_custom_save_product');
add_action('woocommerce_save_product_variation', 'wc_custom_save_product', 10, 2);

/* =============== Google API  =============== */

function my_acf_init()
{

    acf_update_setting('google_api_key', 'AIzaSyCFggcHseEIECvNWvEOPon3_lgSft2Mh0Y');
}

add_action('acf/init', 'my_acf_init');

/* =============== Add Req Email  =============== */

add_filter('woocommerce_email_classes', 'reg_request_email_init');

function reg_request_email_init($email_classes)
{

    include_once 'classes/reg_request_email.php';

    $email_classes['TC_reg_request_email'] = new reg_request_email();

    return $email_classes;

}

/* =============== Auth User  =============== */

function wp_authenticate_user($userdata)
{
    $isActivated = get_user_meta($userdata->ID, 'is_active', true) || user_can($userdata->ID, 'manage_options');

    if (!$isActivated) {
        $userdata = new WP_Error(
            'confirmation_error',
            __('<strong>ERROR:</strong> We have not yet activated your account. If you have any questions please use the form at the bottom of the page.')
        );
    }
    return $userdata;
}

add_filter('wp_authenticate_user', 'wp_authenticate_user', 10, 2);

/* =============== Downloads in menu  =============== */

function custom_my_account_menu_items($items)
{
    unset($items['downloads']);
    return $items;
}

add_filter('woocommerce_account_menu_items', 'custom_my_account_menu_items');


function shipping_endpoint_change($url, $endpoint, $value)
{

    if ($endpoint === 'edit-address' && $value !== 'billing')

        $url = wc_get_page_permalink('myaccount');

    return $url;

}

add_filter('woocommerce_get_endpoint_url', 'shipping_endpoint_change', 10, 3);


function woocommerce_billing_fields_filter($address_fields)
{

    foreach ($address_fields as $key => $address_field) {

        $address_fields[$key]['placeholder'] = isset($address_fields[$key]['placeholder']) ? $address_fields[$key]['placeholder'] : $address_fields[$key]['label'];

        if (isset($address_fields[$key]['label']))

            unset($address_fields[$key]['label']);

    }

    return $address_fields;

}

add_filter('woocommerce_billing_fields', 'woocommerce_billing_fields_filter', 10, 3);

function per_page($query)
{
    $found_posts = (int)$query->found_posts;
    $per_page = key_exists('posts_per_page', $query->query) ? $query->query['posts_per_page'] : 18;
    $per_page = (int)$per_page;
    $return = '';
    if ($found_posts > 18) {
        $return .= 'View ';
        $return .= $per_page === 18 ? '<a href="#" class="active" data-per_page="18">18</a>' : '<a href="#" data-per_page="18">18</a>';
        if ($found_posts >= 36)
            $return .= $per_page === 36 ? '<a href="#" class="active" data-per_page="36">36</a>' : '<a href="#" data-per_page="36">36</a>';
        if ($found_posts >= 54)
            $return .= $per_page === 54 ? '<a href="#" class="active" data-per_page="54">54</a>' : '<a href="#" data-per_page="54">54</a>';
        if ($found_posts >= 72)
            $return .= $per_page === 72 ? '<a href="#" class="active" data-per_page="72">72</a>' : '<a href="#" data-per_page="72">72</a>';
        $return .= '<span>Per Page</span>';
    }
    return $return;
}

function the_product_pagination($query)
{

    $max_page = (int)$query->max_num_pages;
    $current_page = key_exists('paged', $query->query) ? (int)$query->query['paged'] : 1;
    $return = '';
    if ($max_page > 1) {
        $return .= $current_page !== 1 ?
            '<li><a href="#" data-page="' . ($current_page - 1) . '"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>' :
            '<li><span><i class="fa fa-angle-left" aria-hidden="true"></i></span></li>';

        if (!($current_page - 4 <= 1)) {
            $return .= '<li><a href="#" data-page="1">1</a></li>';
            $return .= '<li><span>...</span></li>';

            for ($x = $current_page; $x >= ($current_page - 2); $x--) {
                $return .= $current_page !== $x ?
                    '<li><a href="#" data-page="' . $x . '">' . $x . '</a></li>' :
                    '';
            }


        } elseif ($current_page - 4 <= 1) {
            for ($x = 1; $x < $current_page; $x++)
                $return .= '<li><a href="#" data-page="' . $x . '">' . $x . '</a></li>';
        }


        for ($x = $current_page; $x <= ($current_page + 4); $x++) {
            if ($x <= $max_page)
                $return .= $current_page !== $x ?
                    '<li><a href="#" data-page="' . $x . '">' . $x . '</a></li>' :
                    '<li><span class="active">' . $x . '</span></li>';
        }
        if (!($current_page + 4 >= (int)$max_page)) {
            $return .= '<li><span>...</span></li>';
            $return .= '<li><a href="#" data-page="' . $max_page . '">' . $max_page . '</a></li>';
        }
        $return .= (int)$current_page !== (int)$max_page ?
            '<li><a href="#" data-page="' . ($current_page + 1) . '"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>' :
            '<li><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></li>';


    }
    return $return;
}


function update_cart_item()
{

    if (empty($_REQUEST['update-product'])) return;

    if (!empty($_REQUEST['remove-product']))

        if ($_REQUEST['update-product'] === $_REQUEST['remove-product'])

            return;

    $quantity = empty($_REQUEST['quantity']) ? 1 : wc_stock_amount($_REQUEST['quantity']);

    print_object(WC()->cart->cart_contents, true);

    WC()->cart->set_quantity($_REQUEST['update-product'], $quantity);

}

add_action('wp_loaded', 'update_cart_item', 30);


function remove_cart_item()
{

    if (empty($_REQUEST['remove-product'])) return;

    WC()->cart->remove_cart_item($_REQUEST['remove-product']);

}

add_action('wp_loaded', 'remove_cart_item', 30);


function categories_to_tree($categories)
{

    $indexed = [];

    foreach ($categories as $category) {

        $indexed[$category->term_id] = $category;

        $indexed[$category->term_id]->children = [];

    }

    $root = 0;

    foreach ($indexed as $id => $category) {

        $indexed[$category->parent]->children[$id] =& $indexed[$id];


    }

    return $indexed[$root]->children;

}


function echo_category_option($cat, $product_cat, $sep = '')
{

    echo $cat === $product_cat->slug

        ? "<option value='{$product_cat->slug}' selected>$sep {$product_cat->name}</option>"

        : "<option value='{$product_cat->slug}'>$sep {$product_cat->name}</option>";

}


function output_category_option_tree($product_cat, $cat, $sep = '')
{

    echo_category_option($cat, $product_cat, $sep);

    if (count($product_cat->children)) {

        $sep = "$sep--";

        foreach ($product_cat->children as $child) {
            output_category_option_tree($child, $cat, $sep);

        }

    }

}

//add_action('woocommerce_email', 'unhook_emails');
//
//function unhook_emails($email_class)
//{
//
//    remove_action('woocommerce_order_status_pending_to_processing_notification', array($email_class->emails['WC_Email_New_Order'], 'trigger'));
//
//    remove_action('woocommerce_order_status_pending_to_completed_notification', array($email_class->emails['WC_Email_New_Order'], 'trigger'));
//
//    remove_action('woocommerce_order_status_pending_to_on-hold_notification', array($email_class->emails['WC_Email_New_Order'], 'trigger'));
//
//    remove_action('woocommerce_order_status_failed_to_processing_notification', array($email_class->emails['WC_Email_New_Order'], 'trigger'));
//
//    remove_action('woocommerce_order_status_failed_to_completed_notification', array($email_class->emails['WC_Email_New_Order'], 'trigger'));
//
//    remove_action('woocommerce_order_status_failed_to_on-hold_notification', array($email_class->emails['WC_Email_New_Order'], 'trigger'));
//
//}