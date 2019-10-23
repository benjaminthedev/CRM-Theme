<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<section class="link_blocks contact_page">

    <div class="container">

        <div class="row">

            <div class="col-lg-6">

                <div class="link_block content_block info_bg">

                    <h2><?php _e('Login', 'woocommerce'); ?></h2>

                    <form class="woocomerce-form woocommerce-form-login login" method="post">

                        <?php do_action('woocommerce_login_form_start'); ?>

                        <?php wc_print_notices(); ?>

                        <div class="form-group">

                            <input type="text" class="form-control"

                                   name="username" id="username" placeholder="Email Address"

                                   value="<?php echo (!empty($_POST['username'])) ? esc_attr($_POST['username']) : ''; ?>"/>
                        </div>

                        <div class="form-group">

                            <input type="password" class="form-control"

                                   name="password" id="password" placeholder="Password"/>

                        </div>

                        <div class="form-group">

                            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php _e('Forgotten your password?', 'woocommerce'); ?></a>

                        </div>

                        <?php do_action('woocommerce_login_form'); ?>

                        <div class="form-group">

                            <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

                            <input type="submit" class="btn btn-danger" name="login"

                                   value="<?php esc_attr_e('Login', 'woocommerce'); ?>"/>

                        </div>

                        <?php do_action('woocommerce_login_form_end'); ?>

                    </form>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="link_block content_block warning_bg">

                    <h2>Request A Trade Account</h2>

                    <div class="login">

                        <?php the_field('register_form_content'); ?>

                        <a href="<?php the_field('register_page', 'options') ?>" class="btn btn-danger">Request
                            Account</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php get_section('product_links'); ?>

<?php get_section('new_arrivals'); ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>
