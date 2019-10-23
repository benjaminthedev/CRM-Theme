<?php
/**
 * Customer new account email
 * @var $form_data
 * @var $is_admin
 * @var $email_heading
 * @var $email
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


$updates = [

    'First Name' => $form_data['first_name'],

    'Last Name' => $form_data['last_name'],

    'Company' => $form_data['company_name'],

    'Address Line 1' => $form_data['address_1'],

    'Address Line 2' => $form_data['address_2'],

    'Country' => $form_data['country'],

    'State / County' => $form_data['city'],

    'Postcode' => $form_data['postcode'],

    'Phone' => $form_data['telephone'],

    'Email' => $form_data['email'],

    'Website' => $form_data['website'],

    'Month Established' => $form_data['month_established'],

    'Year Established' => $form_data['year_established'],

    'How Do You Currently Sell' => $form_data['how_sell'],

    'How Is Your Company Incorporated' => $form_data['how_incorporated'],

    'Current Turnover' => $form_data['turnover'],

    'Current Monthly Spend' => $form_data['month_spend_current'],

    'Estimated Monthly Spend' => $form_data['month_spend_estimated'],

];

$get_edit_user_link = get_edit_user_link($form_data['user_id']);

do_action('woocommerce_email_header', $email_heading, $email);

echo $is_admin ? '<p>Below are the customers details</p>'

    : '<p>Below are the details you requested your account with. If there are any problems please contact us using the form on our website</p>';

foreach ($updates as $title => $update)
    if ($update)
        echo "<p><b>$title:</b> $update</p>";

echo $is_admin ? "<p>You can verify the users account <a href='$get_edit_user_link'>here</a></p>" : '';

do_action('woocommerce_email_footer', $email);
