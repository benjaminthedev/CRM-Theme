<?php
/**

 * User: benjaminthdev
 * Date: 18/07/2017
 * Time: 13:30
 */


while (have_rows('team')) : the_row();

    $image = get_sub_field('image');

    $name = get_sub_field('name');

    $position = get_sub_field('position');

    $bio = get_sub_field('bio');

    $telephone = get_sub_field('telephone');

    $email = get_sub_field('email');

    $i = get_row_index();

    if (!$image || !$name) continue;

    $slug = sanitize_title($name) . $i;

    ?>

    <div id="<?php echo $slug; ?>" class="modal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="container">

                    <div class="team_profile">

                        <div class="image">

                            <?php echo get_img($image['sizes']['user_thumb'], $image['alt'], false); ?>

                        </div>

                        <div class="team_info warning_bg">

                            <a href="#" data-dismiss="modal" class="close">X</a>

                            <div class="titles">

                                <?php echo "<div class='name'>$name</div>" ?>

                                <?php echo $position ? "<div class='position'>$position</div>" : '' ?>

                            </div>

                            <?php echo $bio ? $bio : '' ?>

                            <?php echo $telephone ? "<a href='tel:$telephone' class='contact'><b>T.</b> $telephone</a>" : '' ?>

                            <?php echo $email ? "<a href='mailto:$email' class='contact'><b>E.</b> $email</a>" : '' ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php endwhile; ?>