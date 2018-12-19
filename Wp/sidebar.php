<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<ul class="sidebar">



    <map name="Map" id="Map">
        <area alt="" title="" href="<?= get_permalink(45) ?>" shape="poly" coords="14,6,19,9,11,81,68,130,181,61,150,12" />
        <area alt="" title="" href="<?= get_permalink(549) ?>" shape="poly" coords="16,178,217,58,241,100,86,204,22,207" />
        <area alt="" title="" href="<?= get_permalink(12) ?>" shape="poly" coords="115,212,255,116,266,145,271,195,270,214" />

    </map>
    <li>
        <div class="board_box">

            <img title="APT" alt="APT"  usemap="#map"  src="<?php echo get_template_directory_uri(); ?>/images/right_bar_img1.jpg">
        </div>
    </li>

    <li>
        <div class="board_box">
            <a style="border:0px;" href="<?= get_permalink(30) ?>">
                <img title="How to find us" alt="How to find us" src="<?php echo get_template_directory_uri(); ?>/images/right_bar_img2.jpg">
            </a>        </div>
    </li>

    <li>
        <div class="board_box">
            <a style="border:0px;" href="<?= get_permalink(10) ?>">
                <img title="News and Media" alt="News and Media" src="<?php echo get_template_directory_uri(); ?>/images/right_bar_img3.png">
            </a>        </div>
    </li>
</ul>
