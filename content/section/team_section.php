<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 18/07/2017
 * Time: 09:54
 */ ?>

<section class="team_section">

    <div class="container">

        <h2 class="section_title">Meet the team</h2>

        <div class="row justify-content-center">

            <?php

            while (have_rows('team')) : the_row();

                $image = get_sub_field('image');

                $name = get_sub_field('name');

                $position = get_sub_field('position');

                $i = get_row_index();

                if (!$image || !$name) continue;

                $slug = sanitize_title($name) . $i;

                ?>

                <div class="col-lg-4 col-md-6">

                    <a href="#" data-toggle="modal" data-target="#<?php echo $slug ?>" class="team_block">

                        <div class="image">

                            <?php echo get_img($image['sizes']['user_thumb'], $image['alt'], false); ?>

                        </div>

                        <?php echo "<div class='name'>$name</div>" ?>

                        <?php echo $position ? "<div class='position'>$position</div>" : '' ?>

                        <div class="btn btn-danger">Read More</div>

                    </a>

                </div>

            <?php endwhile; ?>

        </div>

    </div>

</section>