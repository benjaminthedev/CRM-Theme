<?php
/**

 * User: benjaminthdev
 * Date: 13/07/2017
 * Time: 09:29
 * Template Name: About
 */

get_header();

if (have_posts())

    while (have_posts()) : the_post(); ?>

        <section class="content_section info_bg">

            <div class="container">

                <div class="row text-center flex-align-lg-center ">

                    <div class="<?php echo has_post_thumbnail() ? 'col-lg-8 ' : 'col-xs-12'; ?>">

                        <h1><?php the_title(); ?></h1>

                        <?php the_content(); ?>

                    </div>

                    <?php if (has_post_thumbnail()) : ?>

                        <div class="col-lg-4 flex-lg-first text-left">

                            <?php the_post_thumbnail('full'); ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </section>
        <script>
// Adding class to table
//let newTables = document.querySelectorAll('.page-id-21 .shop_table');

//newTables.classList.remove('shop_table');
//newTables.classList.add('table', 'table-striped');
//newTables.classList.remove('woocommerce-table');

//Address

// let addressNew = document.getElementsByTagName('address');
// addressNew.innerHTML = addressNew.textContent.replace(/,/g, '<br>');


//woocommerce-table--order-details - when order had be ordered.
let newTablesOrder = document.querySelector('.woocommerce-table');

newTablesOrder.classList.remove('shop_table');
newTablesOrder.classList.add('table', 'table-striped');
newTablesOrder.classList.remove('woocommerce-table');


</script>

<style>
th.woocommerce-table__product-table.product-total,
th.woocommerce-table__product-name.product-name  {
    text-align: center;
}
section.woocommerce-customer-details {
    display: none;
}



</style>

        <?php if(have_rows('team')) get_section('team_section'); ?>

    <?php endwhile;

get_section('new_arrivals');

get_section('contact_form');

get_footer();

