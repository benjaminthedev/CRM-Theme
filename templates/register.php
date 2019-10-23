<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 12/07/2017
 * Time: 10:33
 * Template Name: Register
 */

if (is_user_logged_in())
    wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')), 301);


get_header();

if (have_posts())

    while (have_posts()) : the_post(); ?>

        <div class="form_response_output"></div>

        <section class="register_section warning_bg">

            <div class="container">

                <div class="inner">

                    <h1><?php the_title(); ?></h1>

                    <?php the_content(); ?>

                    <form class="register_form woocommerce-cart-form" id="register_form">

                        <div class="form_block">

                            <h3>About you</h3>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="first_name" data-validation="required"
                                               class="form-control"

                                               placeholder="First Name">

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="last_name" data-validation="required"
                                               class="form-control"

                                               placeholder="Last Name">

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="tel" name="telephone" data-validation="required"
                                               class="form-control"

                                               placeholder="Phone Number">

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="email" name="email" data-validation="email" class="form-control"

                                               placeholder="Email">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="form_block">

                            <h3>Address</h3>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="company_name" data-validation="required"

                                               class="form-control" placeholder="Company Name">

                                    </div>

                                </div>

                                <div class="col-lg-6">


                                    <div class="form-group">

                                        <?php

                                        $countries = WC()->countries->get_allowed_countries();


                                        $field = '<select data-validation="required" name="country"  class="select2"><option value="">Country</option>';

                                        foreach ($countries as $ckey => $cvalue) {
                                            $field .= '<option value="' . esc_attr($ckey) . '">' . $cvalue . '</option>';
                                        }

                                        $field .= '</select>';


                                        echo $field;

                                        ?>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="address_1" data-validation="required"
                                               class="form-control"

                                               placeholder="House number and street name">

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="address_2" class="form-control"

                                               placeholder="Apartment, suite, unit, etc. (optional)">

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="city" class="form-control" data-validation="required"

                                               placeholder="State / County">

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="postcode" class="form-control"
                                               data-validation="required"

                                               placeholder="Postcode">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="form_block">

                            <h3>About Your Company</h3>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <select data-validation="required" name="month_established"

                                                title="month_established" class="select2">

                                            <option value="">Month Established</option>

                                            <?php
                                            for ($m = 1; $m <= 12; $m++) {

                                                $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));

                                                echo "<option value='$month'>$month</option>";

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <select data-validation="required" name="year_established"
                                                title="year_established"

                                                class="select2">

                                            <option value="">Year Established</option>

                                            <?php for ($y = 1900; $y <= (int)date('Y'); $y++) echo "<option value='$y'>$y</option>" ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="website" placeholder="Website (optional)"

                                               class="form-control">

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <select data-validation="required" name="how_sell" title="how_sell"
                                                class="select2">

                                            <option value="">How do you currently sell</option>

                                            <optgroup label="Retail">

                                                <option value="Retail Shops">Shops</option>

                                                <option value="Retail Website">Website</option>

                                                <option value="Retail Ebay">Ebay</option>

                                                <option value="Retail Amazon">Amazon</option>

                                                <option value="Retail Other">Other</option>

                                            </optgroup>

                                            <optgroup label="Wholesale">

                                                <option value="Retail Trade Shows">Trade Shows</option>

                                                <option value="Retail Website">Website</option>

                                                <option value="Retail Ebay">Ebay</option>

                                                <option value="Retail Amazon">Amazon</option>

                                                <option value="Retail Other">Other</option>

                                            </optgroup>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <select data-validation="required" name="how_incorporated"
                                                title="how_incorporated"

                                                class="select2">

                                            <option value="">How is your company incorporated</option>

                                            <option value="Sole Trader">Sole Trader</option>

                                            <option value="Partnership">Partnership</option>

                                            <option value="Private Limited Company">Private Limited Company</option>

                                            <option value="Public Limited Company">Public Limited Company</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="turnover" data-validation="required"
                                               class="form-control"

                                               placeholder="Current Turnover">

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="month_spend_current" data-validation="required"

                                               class="form-control"

                                               placeholder="Current Monthly Spend">

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <input type="text" name="month_spend_estimated" data-validation="required"

                                               class="form-control"

                                               placeholder="Estimated Monthly Spend">

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="form-group">

                                    <textarea name="additional_info"

                                              placeholder="Additional information to assist us to help your business"

                                              class="form-control"></textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group text-center">

                                        <div class="g-recaptcha"

                                             data-sitekey="6LcEoD0UAAAAAEeU9pZxe1RUT4CyOYfYJFYDsSjK"></div>

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group text-right">

                                        <input type="submit" value="Request" class="btn btn-danger">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </section>

    <?php endwhile;

get_section('new_arrivals');

get_section('contact_form');

get_footer();