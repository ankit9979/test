<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    // Page thumbnail and title.
    //twentyfourteen_post_thumbnail();
    //the_title( '<h1 class="entry-title">', '</h1>' );
    ?>


    <?php
    the_content();
//			wp_link_pages( array(
//				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
//				'after'       => '</div>',
//				'link_before' => '<span>',
//				'link_after'  => '</span>',
//			) );
//
//			edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
    ?>
    <!-- .entry-content -->
    <?php
    $parent_id = wp_get_post_parent_id($post_ID);
    $pages = get_pages('child_of=' . $parent_id);
    if (is_page() && $post->post_parent) {
        ?>
        <div class="innerpage_menu">
            <div class="menutitle"> <?= get_the_title($parent_id) ?> </div>
            <div class="menulinks">
                <ul class="page_menu" id="menu-page_about-us">
                    <?php
                    foreach ($pages as $child) {
                        ?>
                        <li class="menu_li" ><a href="<?= get_permalink($child->ID) ?>"><?= get_the_title($child->ID) ?></a></li>  
                            <?php
                        }
                        ?> 
                </ul>



            </div>
        </div>
    <?php } ?>

</article><!-- #post-## -->
