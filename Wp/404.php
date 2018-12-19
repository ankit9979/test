<?php
/**
 * The template for displaying 404 pages (Not Found)
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
                    <div class="h3_detail">APT is providing solutions for companies using plastic materials accross the 
                        medical, composite, recycling and pharmaceutical sectors.</div>
                </div>
            </div>

        </div>
    </div>
    <div class="content-wrap">

        <div class="container inner_page">  

            <div class="row">

                <h1><?php _e('Oops! Page Not Found', 'twentyfourteen'); ?></h1>

                <div class="col-sm-7 col-md-9 ">
                    <div class="row">
                      
                        <?php _e('It looks like nothing was found at this location. ', 'twentyfourteen');
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
?>