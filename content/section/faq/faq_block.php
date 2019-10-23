<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 11/07/2017
 * Time: 16:32
 * @var $title ;
 */
?>

<div class="faq_blocks">

    <?php echo $title ? "<h3>$title</h3>" : ''; ?>

    <?php

    while (have_rows('faqs_block')) : the_row();

        $question = get_sub_field('question');

        $answer = get_sub_field('answer');

        if (!$question || !$answer)

            continue;

        ?>

        <div class="faq_block">

            <?php echo "<div class='question'>$question</div>" ?>

            <?php echo "<div class='answer'>$answer</div>" ?>

        </div>

    <?php endwhile ?>

</div>
