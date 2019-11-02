<footer class="footer_logo">

    <div class="container">

        <?php echo get_img('logo_circle.png', 'Logo Circle'); ?>

    </div>

</footer>

<footer id="main_footer" class="primary_bg">

    <div class="container">

        <div class="row">

            <?php

            if (have_rows('footer_menus', 'options'))

                while (have_rows('footer_menus', 'options')) : the_row();

                    $menu = get_sub_field('menu');

                    if ($menu)

                        get_section('footer/menu_block', [

                            'menu' => $menu

                        ]);

                endwhile;

            $address = get_field('address', 'options');

            $company_number = get_field('company_number', 'options');

            $email = get_field('email', 'options');

            $email_attributes = get_field('email_attributes', 'options');

            $telephone_number_attributes = get_field('telephone_number_attributes', 'options');

            $telephone_number = get_field('telephone_number', 'options');

            if ($address || $company_number || $email || $telephone_number)

                get_section('footer/contact_blocks', [

                    'address' => $address,

                    'company_number' => $company_number,

                    'email' => $email,

                    'email_attributes' => $email_attributes,

                    'telephone_number' => $telephone_number,

                    'telephone_number_attributes' => $telephone_number_attributes

                ]);

            ?>

            <div class="col footer_meta">

                <h5>Sign up for updates</h5>

                <?php //echo do_shortcode('[contact-form-7 id="96" title="Mailchimp Form"]') ?>


                 <?php echo do_shortcode('[mc4wp_form id="5585"]') ?>

                <?php if (have_rows('social_links', 'options')) get_section('footer/social_links') ?>

                

            </div>

        </div>

    </div>

</footer>

</div>

<?php if(have_rows('team')) get_section('team_modals'); ?>

<?php wp_footer(); ?>

<?php echo get_field('body_scripts', 'option'); ?>

</body>

</html>