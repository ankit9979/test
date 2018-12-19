

<!-- footer area-->
<div  class=" footer_area">
    <div class="container">
        <div class="row">

            <div class="left_footer">
                <div class="col-md-12 footer_one">

                    <?php dynamic_sidebar('about-us'); ?>
                    <?php dynamic_sidebar('apt-team'); ?>
                    <?php dynamic_sidebar('apt-collaboration'); ?>

                </div> 

                <div class="col-md-12 footer_two">
                    <?php dynamic_sidebar('media'); ?>
                    <?php dynamic_sidebar('euipemtn'); ?>
                    <?php dynamic_sidebar('mri-research'); ?>

                </div>
            </div>  

            <div class="right_footer">


                <?php dynamic_sidebar('apt-contact'); ?>

            </div>

        </div>
    </div>
</div>

<!-- sub_footer_area-->
<div  class="sub_footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <img src="<?php echo get_template_directory_uri(); ?>/images/wnterpise.jpg"/>
              <img src="<?php echo get_template_directory_uri(); ?>/images/hea.jpg"/>
              <img src="<?php echo get_template_directory_uri(); ?>/images/logo_3.jpg"/>
<!--               <img src="<?php echo get_template_directory_uri(); ?>/images/ait.jpg"/>-->
               <img src="<?php echo get_template_directory_uri(); ?>/images/technology.jpg"/>
               <img src="<?php echo get_template_directory_uri(); ?>/images/ait_in.jpg"/>
            </div> 
        </div>
    </div>
</div>

<link rel='stylesheet' id='prettyphoto-css'  href='/wp-content/plugins/js_composer/assets/lib/prettyphoto/css/prettyPhoto.css?ver=4.5.3' type='text/css' media='screen' />
<script type='text/javascript' src='/wp-content/plugins/js_composer/assets/lib/prettyphoto/js/jquery.prettyPhoto.js?ver=4.5.3'></script>


<?php wp_footer(); ?>


<script type="text/javascript">
    jQuery(function () {

        jQuery(' #da-thumbs > li ').each(function () {
            jQuery(this).hoverdir();
        });

    });
</script>
<script type="text/javascript">
    jQuery(function () {
        jQuery('nav#menu').mmenu();
    });
</script>
<!--            <script src="js/owl.carousel.js"></script>-->

<!-- Javascripts
================================================== -->

</div>
</body>
</html>

<?php //get_sidebar('footer'); ?>
