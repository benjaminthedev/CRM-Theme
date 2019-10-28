<?php
/**

 * User: benjaminthdev
 * Date: 23/05/2017
 * Time: 15:32
 */

if (!$brands_slider)
    return;

$x = 0;

?>

<div id="brands_slider">

    <div class="container">

        <ul class="client_logos">

            <?php foreach ($brands_slider as $brand) :

                $x++;

                ?>

                <li <?php echo "data-update='item$x'" ?>>

                    <div>

                        <?php echo $brand ? get_img($brand['url'], $brand['alt'], false) : '' ?>

                    </div>

                </li>

            <?php endforeach; ?>

        </ul>

    </div>

</div>


