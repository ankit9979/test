

<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
?>

<div id="main-content" class="main-content">
<div class="header_img">
        <div class="overlay">
            <div class="container"><div class="apt_solution">
                <h3>APT Solutions </h3>
                <div class="h3_detail">APT is providing solutions for companies using plastic materials across the 
                    medical, composite, recycling and pharmaceutical sectors.</div>
                        </div>
            </div>
                    <!--        <img src="<?php echo get_template_directory_uri(); ?>/images/innerbanner.jpg">-->
        </div>
    </div>


    <div class="content-wrap">

        <div class="container inner_page">  

            <div class="row">

               

                <h1 style="clear: both"><?= get_the_title() ?></h1>
                <div class="col-sm-7 col-md-9 ">
                    <div class="row">
                        <?php
                        // Start the Loop.
                        while (have_posts()) : the_post();

                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            ?><div class="col-sm-6 col-md-8 "><?php
                            the_content();
                            ?> </div>
                        <div class="fet_img">
                                <?php
                                the_post_thumbnail(array(600, 300));
                                ?> </div>
                          <?php
                        //	get_template_part( 'content', get_post_format() );
                        // Previous/next post navigation.
                        //twentyfourteen_post_nav();
                        // If comments are open or we have at least one comment, load up the comment template.
                        //if ( comments_open() || get_comments_number() ) {
                        //	comments_template();
                        //}
                        endwhile;
                        ?>
                    </div>
                </div><!-- #content -->

                <div class="col-sm-5 col-md-3">

                    <?php get_sidebar(); ?>
                </div>
                <!-- #primary -->
            </div>
        </div> 
    </div>
</div><!-- #main-content -->

<?php
get_footer();

