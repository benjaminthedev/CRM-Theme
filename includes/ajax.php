<?php
/**

 * User: benjaminthdev
 * Date: 08/03/2017
 * Time: 09:26
 */

// Register Request

function request_register()
{

    $form_array = [];

    if (isset($_POST['form'])) {

        parse_str($_POST['form'], $form_array);

        if (email_exists($form_array['email'])) {

            wp_send_json_error('You already have an account or have already requested one.');

        } else {

            $random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);

            $user_id = wp_create_user($form_array['email'], $random_password, $form_array['email']);

            $form_array['user_id'] = $user_id;

            $updates = [

                'first_name' => trim($form_array['first_name']),

                'billing_first_name' => trim($form_array['first_name']),

                'billing_last_name' => trim($form_array['last_name']),

                'last_name' => trim($form_array['last_name']),

                'billing_company' => $form_array['company_name'],

                'billing_address_1' => $form_array['address_1'],

                'billing_address_2' => $form_array['address_2'],

                'billing_country' => $form_array['country'],

                'billing_state' => $form_array['city'],

                'billing_postcode' => $form_array['postcode'],

                'billing_phone' => $form_array['telephone'],

                'billing_email' => $form_array['email'],

                'month_established' => $form_array['month_established'],

                'year_established' => $form_array['year_established'],

                'url' => $form_array['website'],

                'how_do_you_currently_sell' => $form_array['how_sell'],

                'how_is_your_company_incorporated' => $form_array['how_incorporated'],

                'current_turnover' => $form_array['turnover'],

                'current_monthly_spend' => $form_array['month_spend_current'],

                'estimated_monthly_spend' => $form_array['month_spend_estimated'],

            ];

            foreach ($updates as $key => $update) {

                if ($update) {

                    update_user_meta($user_id, $key, $update);

                }

            }

            $mailer = WC()->mailer();

            $mails = $mailer->get_emails();

            if (!empty($mails))

                foreach ($mails as $mail) {

                    if ($mail->id == 'customer_request_account') {

                        $mail->trigger($form_array);

                        $mail->trigger($form_array, true);

                    }

                }

            wp_send_json_success(get_field('thank_you_page', 'options'));

        }

    } else {

        wp_send_json_error('There seems to be an issue. Please try again later.');

    }

}

add_action('wp_ajax_nopriv_request_register', 'request_register');

add_action('wp_ajax_request_register', 'request_register');

// Load Products

function product_load()
{

    $data = $_POST['data'];

    $args = [

        'post_type' => 'product',

        'posts_per_page' => (int)$data['per_page'],

        'paged' => (int)$data['page'],

        'meta_query' => [

            [

                'key' => '_stock_status',

                'value' => 'instock',

                'compare' => '=',

            ]

        ]

    ];

    if ($data['cat'])

        $args['tax_query'][] = [

            'relation' => 'OR',

            [
                'taxonomy' => 'product_cat',

                'field' => 'slug',

                'terms' => $data['cat']

            ]

        ];

    if($data['search']) $args['s'] = $data['search'];

    ob_start();

    $query = new WP_Query($args);


    if ($query->have_posts())

        while ($query->have_posts()) : $query->the_post();

            wc_get_template_part('content', 'product');

        endwhile;

    else

        do_action('woocommerce_no_products_found');

    $content = ob_get_contents();

    ob_clean();

    wp_reset_postdata();

    $url = '?';

    $url .= (int)$data['per_page'] !== 18 ? 'per_page=' . $data['per_page'] . '&' : '';

    $url .= (int)$data['page'] !== 1 ? 'index=' . $data['page'] . '&' : '';

    $url .=  $data['cat'] ? 'category=' . $data['cat'] . '&' : '';

    $url .=  $data['search'] ? 'search=' . $data['cat'] . '&' : '';

    wp_send_json_success([

        'content' => $content,

        'pagination' => the_product_pagination($query),

        'per_page' => per_page($query),

        'url' => $url

    ]);

}

add_action('wp_ajax_nopriv_product_load', 'product_load');

add_action('wp_ajax_product_load', 'product_load');

use Automattic\WooCommerce\Client;

function place_order_post()
{

    global $woocommerce;

    if (!$woocommerce->cart->get_cart()) return;

    $woocommerce_api = new Client(

        get_site_url(), // Your store URL

        'ck_f0ec947e9b66d076b10a61dd59a300919f599acc', // Your consumer key

        'cs_8bd0c47033f4f0592aa66c4cace7b67804a42ecc', // Your consumer secret

        [

            'wp_api' => true, // Enable the WP REST API integration

            'version' => 'wc/v2' // WooCommerce WP REST API version

        ]
    );

    $user_id = get_current_user_id();

    $address = [

        'first_name' => get_user_meta($user_id, 'billing_first_name', true),

        'last_name' => get_user_meta($user_id, 'billing_last_name', true),

        'company' => get_user_meta($user_id, 'billing_company', true),

        'address_1' => get_user_meta($user_id, 'billing_address_1', true),

        'address_2' => get_user_meta($user_id, 'billing_address_2', true),

        'city' => get_user_meta($user_id, 'billing_city', true),

        'state' => get_user_meta($user_id, 'billing_state', true),

        'postcode' => get_user_meta($user_id, 'billing_postcode', true),

        'country' => get_user_meta($user_id, 'billing_country', true),

        'email' => get_user_meta($user_id, 'billing_email', true),

        'phone' => get_user_meta($user_id, 'billing_telephone', true),

    ];

    $data = [

        'payment_method' => 'bacs',

        'payment_method_title' => 'Invoice',

        'set_paid' => false,

        'customer_id' => $user_id,

        'billing' => $address,

        'shipping' => $address

    ];

    $cart = $woocommerce->cart->get_cart();

    foreach ($cart as $cart_item_key => $cart_item) {

        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

        $product = [

            'product_id' => $product_id,

            'subtotal' => $cart_item['line_subtotal'],

            'subtotal_tax' => $cart_item['line_subtotal_tax'],

            'total' => $cart_item['line_total'],

            'tax' => $cart_item['line_tax'],

            'tax_data' => $cart_item['line_tax_data'],

            'quantity' => $cart_item['quantity']

        ];

        $data['line_items'][] = $product;


        $woocommerce->cart->remove_cart_item($cart_item_key);
    }

    $order = $woocommerce_api->post('orders', $data);

    $data = [
        'status' => 'processing'
    ];

    $woocommerce_api->put("orders/{$order['id']}", $data);


    $order = wc_get_order($order['id']);

    wp_send_json_success($order->get_view_order_url());

    exit;

}

add_action('wp_ajax_nopriv_place_order_post', 'place_order_post');

add_action('wp_ajax_place_order_post', 'place_order_post');