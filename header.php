<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="loading">
        <div id="loading-animation">
            <img src="<?php echo get_template_directory_uri() ;?>/img/fv-logo-sp-white.png" alt="" class="fadeUp">
        </div>
    </div>
    <!--/splash-->
    <!-- <div class="splashbg"></div> -->

    <!---画面遷移用-->
    <div id="container">


        <!-- header -->
        <header id="header-change" class="header">
            <div class="header-container">
                <!-- ヘッダーロゴ -->
                <h1 class="header-logo">
                    <a href="<?php echo home_url(); ?>">motoki sakuma</a>
                </h1>

                <!-- sp hamburger-menu -->
                <div class="sp-nav">
                    <div class="openbtn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <nav class="sp-nav-menu">
                        <?php
                        wp_nav_menu(
                            [
                                'theme_location' => 'place_global',
                                'container' => false,
                            ]
                        );
                        ?>
                    </nav>
                </div>

                <!-- pc nav -->
                <nav class="pc-nav">
                    <?php
                    wp_nav_menu(
                        [
                            'theme_location' => 'place_global',
                            'container' => false,
                        ]
                    );
                    ?>
                </nav>
            </div>
        </header>

        <!-- <div class="fv"> -->
        <div class='fv'>
            <?php echo get_main_image(); ?>
            <h2 class="fv-title">
                <?php echo get_main_title_sp(); ?>
            </h2>
            <h2 class="fv-title-pc">
                <?php echo get_main_title_pc(); ?>
            </h2>
        </div>