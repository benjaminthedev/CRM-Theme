<?php
/**

 * User: benjaminthdev
 * Date: 10/07/2017
 * Time: 16:44
 */

$account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));

$account_text = is_user_logged_in() ? 'View products' : 'Create your account today';

?>
<div class="home_tag_line">

    <div class="container">

        <h3>Exclusive trade prices. <?php echo "<a href='$account_link'>$account_text</a>"; ?></h3>

    </div>

</div>
