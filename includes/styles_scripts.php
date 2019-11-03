<?php

if (!function_exists('theme_styles')) {
    function theme_styles()
    {
        $public_dir = get_public_dir_uri();
        wp_enqueue_style('main', "$public_dir/app.css", [], null, 'all');
    }
}

if (!function_exists('theme_scripts')) {
    function theme_scripts()
    {
        $public_dir = get_public_dir_uri();
        wp_enqueue_script('main', "$public_dir/app.js", [], null, true);

        wp_enqueue_script('custom', "$public_dir/custom.js", [], null, true);
    }
}

if (!function_exists('theme_scripts_localize')) {
    function theme_scripts_localize()
    {
        $ajax_url_params = array();
        // You can remove this block if you don't use WPML
        if (function_exists('wpml_object_id')) {
            /** @var $sitepress SitePress */
            global $sitepress;
            $current_lang = $sitepress->get_current_language();
            wp_localize_script('main', 'i18n', [
                'lang' => $current_lang
            ]);
            $ajax_url_params['lang'] = $current_lang;
        }
        wp_localize_script('main', 'urls', [
            'home' => home_url(),
            'theme' => get_stylesheet_directory_uri(),
            'ajax' => add_query_arg($ajax_url_params, admin_url('admin-ajax.php'))
        ]);

        wp_localize_script('main', 'contact', ['map' => get_field('contact_map')]);
    }
}


add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_enqueue_scripts', 'theme_scripts');
add_action('wp_enqueue_scripts', 'theme_scripts_localize', 20);