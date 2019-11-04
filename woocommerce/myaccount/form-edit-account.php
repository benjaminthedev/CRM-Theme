<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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

if (!defined('ABSPATH')) exit;


do_action('woocommerce_before_edit_account_form'); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

    <?php do_action('woocommerce_edit_account_form_start'); ?>


    <div class="row form-group">

        <div class="col-12">

            <h3>Account Details</h3>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <input type="text" class="form-control" name="account_first_name" id="account_first_name"

                       value="<?php echo esc_attr($user->first_name); ?>"

                       placeholder="<?php _e('First name', 'woocommerce'); ?>"/>

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <input type="text" class="form-control" name="account_last_name" id="account_last_name"

                       value="<?php echo esc_attr($user->last_name); ?>"

                       placeholder="<?php _e('Last name', 'woocommerce'); ?>"/>

            </div>

        </div>

        <div class="col-12">

            <div class="form-group">

                <input type="email" class="form-control" name="account_email" id="account_email"

                       value="<?php echo esc_attr($user->user_email); ?>"

                       placeholder="<?php _e('Email address', 'woocommerce'); ?>"/>

            </div>

        </div>

    </div>

    <div class="row form-group">

        <div class="col-12">

            <h3>Password</h3>

        </div>

        <div class="col-12">

            <div class="form-group">

                <input type="password" class="form-control" name="password_current" id="password_current"

                       placeholder="<?php _e('Current password (leave blank to leave unchanged)', 'woocommerce'); ?>"/>

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <input type="password" class="form-control" name="password_1" id="password_1"

                       placeholder="<?php _e('New password', 'woocommerce'); ?>"/>

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <input type="password" class="form-control" name="password_2" id="password_2"

                       placeholder="<?php _e('Confirm new password', 'woocommerce'); ?>"/>

            </div>

        </div>

    </div>

    <?php do_action('woocommerce_edit_account_form'); ?>

    <div class="row">

        <div class="col-12">

            <div class="form-group">

                <?php wp_nonce_field('save_account_details'); ?>

                <input type="submit" class="btn btn-danger" name="save_account_details"

                       value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"/>

                <input type="hidden" name="action" value="save_account_details"/>

            </div>

        </div>

    </div>

    <?php do_action('woocommerce_edit_account_form_end'); ?>

</form>

<?php do_action('woocommerce_after_edit_account_form'); ?>


