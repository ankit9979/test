<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="<?php bloginfo('charset'); ?>">
        <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">

        <!-- Favicons
        ================================================== -->
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon">
<!--        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">-->

        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400' rel='stylesheet' type='text/css'>


        <?php wp_head(); ?>
        <script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
        <style>
            #myMap .MicrosoftMap .Infobox .infobox-stalk {
                top: 88px !important;
            }
            .infobox-body {
                cursor: default !important;
            }
        </style>
        <script type="text/javascript">
            function GetMap()
            {
                map = new Microsoft.Maps.Map(document.getElementById("myMap"), {
                    credentials: "Aidfjuv8YGsBKXeXLp8CEYx8L_r39p0RAdDlUjQSzEEBxGaVpQL2jeIBgGpmDYWG",
                    zoom: 16, center: new Microsoft.Maps.Location(53.418796, -7.907528), showScalebar: false, disableZooming: true,
                    mapTypeId: Microsoft.Maps.MapTypeId.birdseye, showDashboard: false, enableSearchLogo: false, showCopyright: false, enableClickableLogo: false
                });
                var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(53.418939, -7.905093), {
                    // text: "My Name",
                    width: 128,
                    //  textOffset: new Microsoft.Maps.Point(-12, 10),
                    //   typeName: 'blackText',
                    icon: "<?php echo get_template_directory_uri(); ?>/images/mapi.png",
                    height: 128
                });
                map.entities.push(pin);
                var pin2 = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(53.416327, -7.899224), {
                    // text: "My Name",
                    width: 128,
                    //    textOffset: new Microsoft.Maps.Point(-12, 10),
                    //    typeName: 'blackText',
                    icon: "<?php echo get_template_directory_uri(); ?>/images/mapi.png",
                    height: 128
                });
                map.entities.push(pin2);


                //---pop up----
                pinInfobox = new Microsoft.Maps.Infobox(pin.getLocation(),
                        {
                            title: 'APT',
                            description: 'Athlone Institute of Technology, Dublin Rd, Athlone, Co. Westmeath',
                            visible: false,
                            height: 90, showPointer: true,
                            offset: new Microsoft.Maps.Point(-25, -20)});

                // Add handler for the pushpin click event.
                Microsoft.Maps.Events.addHandler(pin, 'click', displayInfobox);

                // Hide the infobox when the map is moved.
                Microsoft.Maps.Events.addHandler(map, 'viewchange', hideInfobox);


                pinInfobox2 = new Microsoft.Maps.Infobox(pin2.getLocation(),
                        {
                            title: 'APT',
                            description: 'Athlone Institute of Technology, Dublin Rd, Athlone, Co. Westmeath',
                            visible: false,
                            height: 90, showPointer: true,
                            offset: new Microsoft.Maps.Point(-25, -20)});

                // Add handler for the pushpin click event.
                Microsoft.Maps.Events.addHandler(pin2, 'click', displayInfobox2);

                // Hide the infobox when the map is moved.
                Microsoft.Maps.Events.addHandler(map, 'viewchange', hideInfobox2);

                // Add the pushpin and infobox to the map

                map.entities.push(pinInfobox);
                map.entities.push(pinInfobox2);

            }
            function displayInfobox(e)
            {
                pinInfobox.setOptions({visible: true});
                pinInfobox2.setOptions({visible: false});

            }

            function hideInfobox(e)
            {
                pinInfobox.setOptions({visible: false});
            }
            function displayInfobox2(e)
            {
                pinInfobox.setOptions({visible: false});
                pinInfobox2.setOptions({visible: true});
            }

            function hideInfobox2(e)
            {
                pinInfobox2.setOptions({visible: false});
            }
        </script>
    </head>
    <body <?php body_class(); ?>  onload="GetMap();" >


        <div id="page" class="mm-page mm-slideout">

            <nav id="menu"  style="display: none">
                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav navbar-right', 'menu_id' => 'primary-menu')); ?>
            </nav>
            <header>
                <div class="header_inner">
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/images/apt.png"/></a>
                    </div>
                    <div class="logo_right">
                        <a target="_blank" href="http://www.enterprise-ireland.com/en/Research-Innovation/Companies/Collaborate-with-companies-research-institutes/Technology-Gateway-Programme.html">  <img src="<?php echo get_template_directory_uri(); ?>/images/header_logo.png"/></a>
                    </div>
                    <div class="toggel_area">
                        <a href="#menu" class="toogle visible-xs visible-sm"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </header>
            <div class="clear"></div>

            <nav id="tf-menu" class="navbar navigation navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav navbar-right', 'menu_id' => 'primary-menu')); ?>

                    </div>
                </div>
            </nav>  



            <!-- slider
           ==========================================-->  

            <div class="nav_bottom_greed">
                <div class="container">
                </div>
            </div>
            <?php dynamic_sidebar('apt-social'); ?>
            <?php if (is_front_page()) { ?>
                <div class="slider_area">

                    <div class="overlay">
                        <div class="container_in">
                            <div class="social_icons">
                                <div class="social_icons_in">


                                    <div class="slider_textsss">
                                        <div data-ride="carousel" class="carousel slide carousel-fade" id="testimonial-slider">
                                            <!-- Wrapper for slides -->

                                            <div role="listbox" class="carousel-inner">


                                                <?php
                                                $args = array(
                                                    'numberposts' => 3,
                                                    'orderby' => 'post_date',
                                                    'order' => 'DESC',
                                                    'post_type' => 'post',
                                                    'post_status' => 'draft, publish, future, pending, private',
                                                    'suppress_filters' => true);

                                                $recent_posts = wp_get_recent_posts($args);

                                                $i = 1;
                                                foreach ($recent_posts as $post) {
                                                    if ($i == 1) {
                                                        $active = "active";
                                                    } else {
                                                        $active = "";
                                                    }
                                                    ?>
                                                    <div class="item <?= $active ?> num-<?= $i ?>">
                                                        <h1><?php echo substr($post['post_title'], 0, 67); ?></h1>
                                                        <div class="read_more_button"><a href=" <?php echo get_permalink($post['ID']); ?>">Read More</a></div>
                                                        <div class="clear"></div>
                                                    </div> 
                                                    <?php
                                                    $i++;
                                                }
                                                ?>


                                            </div>
                                            <ul class="carousel-indicators">
                                                <li class="" data-slide-to="0" data-target="#testimonial-slider"></li>
                                                <li data-slide-to="1" data-target="#testimonial-slider" class=""></li>
                                                <li data-slide-to="2" data-target="#testimonial-slider" class="active"></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
        








