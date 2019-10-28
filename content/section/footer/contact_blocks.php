<?php
/**

 * User: benjaminthdev
 * Date: 11/07/2017
 * Time: 15:32
 * @var $address
 * @var $company_number
 * @var $email
 * @var $email_attributes
 * @var $telephone_number
 * @var $telephone_number_attributes
 */ ?>

<div class="col contact">

    <h5>Contact</h5>

    <div class="contact_blocks">

        <?php echo $address ? "<div class='contact_block'>$address</div>" : '' ?>

        <?php if ($email || $telephone_number) : ?>

            <div class="contact_block">

                <?php echo $email ? "<a href='mailto:$email' $email_attributes><b>e.</b>$email</a>" : '' ?>

                <?php echo $telephone_number ? "<a href='tel:$telephone_number' $telephone_number_attributes><b>t.</b>$telephone_number</a>" : '' ?>

            </div>

        <?php endif; ?>

        <?php echo $company_number ? "<div class='contact_block'>$company_number</div>" : '' ?>

    </div>

</div>
