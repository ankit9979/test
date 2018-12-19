<?php
/*  Template Name: HomePage */


get_header();
?>
<div class="clear"></div>
<div class="welcome_ttext">
    <div class="container">
        <h1>Welcome to APT Ireland</h1>
    </div>
</div>

<!-- About Us Page
==========================================-->
<div id="tf-about" class=" welcome_text one_welcome_text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>APT Ireland is providing world class solutions for SME's and Multinational companies using polymer materials across the medical, composite, recycling and 
                    pharmaceutical sectors.</p>
            </div> 
        </div>
    </div>
</div>




<!-- Team Page
==========================================-->
<div id="tf-team" class="text-center welcome_bottom_section">
    <div class="overlay">
        <div class="container">            
            <h2>Find out how APT can work with you</h2>

            <div class="service_one_area">
                <ul id="da-thumbs" class="da-thumbs">
                    <li>
                        <a href="<?php echo get_permalink(639); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/img_one.png"/> 
                            <div><span>Industrial Collaboration</span></div>
                        </a>
                    </li>   
                    <li>
                        <a href="<?php echo get_permalink(41); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/img_two.png" />
                            <div><span>APT Team</span></div>
                        </a>
                    </li>   
                    <li>
                        <a href="<?php echo get_permalink(52); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/img_three.png" />
                            <div><span>Case Studies</span></div>
                        </a>
                    </li>   
                    <li>
                        <a href="<?php echo get_permalink(65); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/img_four.png" />
                            <div><span>Equipment & facilities</span></div>
                        </a>
                    </li>   
                </ul>

            </div>

        </div>
    </div>
</div>

<div id="tf-works" class="green_section">
    <div class="container"> <!-- Container -->
        <div class="green_left_area">

            <?php
            $page_id = 127; // 123 should be replaced with a specific Page's id from your site, which you can find by mousing over the link to edit that Page on the Manage Pages admin page. The id will be embedded in the query string of the URL, e.g. page.php?action=edit&post=123.

            $page_data = get_page($page_id); // You must pass in a variable to the get_page function. If you pass in a value (e.g. get_page ( 123 ); ), WordPress will generate an error. By default, this will return an object.
            // echo the content and retain WordPress filters such as paragraph tags.
            ?>
            <h3><?php echo $page_data->post_title ?></h3>
            <p><?php echo substr(apply_filters('the_content', $page_data->post_content), 0, 1000); ?></p>
            <div class="read_more_button"><a href="<?php echo get_permalink($page_data->ID) ?>">Read More</a></div> 

        </div>
        <div class="green_right_area">
            <?php $rr = get_post_custom_values("video", $page_id);
            ?>

            <iframe src="<?= $rr[0] ?>" frameborder="0" allowfullscreen></iframe>


        </div>

    </div>
</div>


<div  class="text-center welcome_bottom_section service_two">
    <div class="overlay">
        <div class="container"> 
            <img src="<?php echo get_template_directory_uri(); ?>/images/center_logo.png"/>
            <h2>APT Ireland the Gateway to AIT’s Materials Research Institute </h2>

            <div class="service_one_area">
                <ul id="da-thumbs" class="da-thumbs">
                    <li>
                        <a href="<?php echo get_permalink(650); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/service_one.png" />
                            <div><span>Biomedical</span></div>
                        </a>
                    </li>   
                    <li>
                        <a href="<?php echo get_permalink(661); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/service_two.png" />
                            <div><span>Controlled release</span></div>
                        </a>
                    </li>   
                    <li>
                        <a href="<?php echo get_permalink(665); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/service_three.png" />
                            <div><span>Polymer processing and additive manufacturing</span></div>
                        </a>
                    </li>   
                    <li>
                        <a href="<?php echo get_permalink(669); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/service_four.png" />
                            <div><span>Thermoplastic Composites and upscaling of recyclate</span></div>
                        </a>
                    </li>   
                </ul>

            </div>

        </div>
    </div>
</div>


<!-- welcome section two-->
<div id="tf-about" class=" welcome_text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>The APT Gateway is based on the Athlone IT campus and is part of the Technology Gateway Network, a nationwide resource for industry based in the IoTs delivering 
                    solutions on near to market problems for industrial partners.</p>
            </div> 
        </div>
    </div>
</div>


<!-- map section-->
<div  style="height: 514px">
    <div id='myMap' style="position:relative;  height:514px;"></div>   
    <!--    <div>
            <iframe width="1900" height="800" frameborder="0" src="http://www.bing.com/maps/embed/viewer.aspx?v=3&amp;cp=53.417748~-7.898609&amp;lvl=15&amp;w=1900&amp;h=800&amp;sty=h&amp;typ=d&amp;pp=Athlone%20Institute%20of%20Technology%2C%20Dublin%20Rd%2C%20Athlone%2C%20Co.%20Westmeath~~53.416840~-7.901420&amp;ps=&amp;dir=0&amp;mkt=en-in&amp;src=O365&amp;form=BMEMJS"></iframe>
        </div-->
    <div class="container">

    </div>
</div>


<!-- facebook twitter area-->
<div  class="facebbok_area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 facebook_in">
                <?php //dynamic_sidebar('apt-facebook-feed');  ?>
<!--              <img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png"/>-->
                <div class="fb_frme">
                    <?php echo do_shortcode('[custom-facebook-feed]'); ?> </div>
                <div class="news_latter">
                    <div class="news_in">
                        <h4>Newsletter Sign-up...</h4>
                        <div class="news_input">
                            <?php echo do_shortcode('[contact-form-7 id="126" title="Newsletter"]'); ?>  </div>
                        <!--                        <div class="news_input">
                                                    <input class="input_news" type="text" name="Enter Your Email Address" value="Enter Your Email Address">
                                                    <input class="submit_button" type="submit" value="Submit">
                        -->
                    </div>
                </div>
            </div> 
            <div class="col-md-6 twitter_in">
                <?php dynamic_sidebar('apt-twiiter-feed'); ?>


            </div> 
        </div>
    </div>
</div>  

<?php
get_footer();
?>