<?php
/*  Template Name: News */

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
                <div class="container-fluid">
                    <div class="col-sm-7 col-md-9 ">

                        <div class="row">
                            <?php query_posts(array('category_name' => 'news', 'posts_per_page' => -1, 'order' => 'ASC'));
                            ?>

                            <?php
// The Loop
                            while (have_posts()) : the_post();
                                ?>
                                <div class="row new_left_content">
                                    <h3 class="post_head news_title_a"><?= the_title() ?></h3>
                                    <div class="col-md-3 col-xs-6 thumn_news">
                                        <?php
                                        if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                                            the_post_thumbnail();
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-8 col-xs-6 news_contes"> 
                                  <?php the_excerpt(); ?> 


                                    </div>
                                    <hr class="hr_line_news">
                                </div>
                                <?php
                            endwhile;
                            ?>

                            <?php
                            // Reset Query
                            wp_reset_query();
                            ?>
                            <?php
                            $parent_id = 8;
                            $pages = get_pages('child_of=8');
                            if ($parent_id) {
                                ?>
                                <div class="innerpage_menu" style="margin-top: 10px;">
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
                        </div>

                    </div><!-- #content -->

                    <div class="col-sm-5 col-md-3">

                        <?php get_sidebar(); ?>
                    </div>
                    <!-- #primary -->
                </div>
            </div>
        </div> 
    </div>
</div><!-- #main-content -->

<?php
get_footer();
