<?php
/*  Template Name: Contact Us  */


get_header();
?>
<style>
    .staff_data {
        width: 558px;
    }
</style>
<div id="main-content" class="main-content">

    <div class="header_img">
        <div class="overlay">
            <div class="container"><div class="apt_solution">
                    <h3>APT Solutions </h3>
                    <div class="h3_detail">APT is providing solutions for companies using plastic materials accross the 
                        medical, composite, recycling and pharmaceutical sectors.</div>
                </div>
            </div>
                    <!--        <img src="<?php echo get_template_directory_uri(); ?>/images/innerbanner.jpg">-->
        </div>
    </div>
    <div class="content-wrap">
        <div class="container inner_page">  
            <div class="row">
                <h1><?= get_the_title() ?></h1>

                <div class="col-sm-7 col-md-9 ">
                    <div class="row">
                        <?php
                        // Start the Loop.
                        while (have_posts()) : the_post();

                            // Include the page content template.
                          the_content();

                        // If comments are open or we have at least one comment, load up the comment template.
//                if (comments_open() || get_comments_number()) {
//                    comments_template();
//                }
                        endwhile;
                        ?>
                        
                        <h3>Contact Us Online</h3>
                        <div class="contact_us_t">
                            <div class="form_left">
                                <div class="form_inner">
                                    
                                     <?php echo do_shortcode('[contact-form-7 id="610" title="contact form with mailchimp"]'); ?> 
                                    
                                </div>
                            </div>
                            <div class="form_right">
                            
                            </div>
                                
                        </div>
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
