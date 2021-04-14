<!DOCTYPE html>
<?php
$logo = get_field('logo', 'option');
$mobile_logo = get_field('mobile_logo', 'option');
$favicon = get_field('favicon', 'option');
?>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, user-scalable=no" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <?php if ($favicon): ?>
            <link href="<?php echo $favicon['url'] ?>" rel="shortcut icon" />
        <?php endif ?>
        <?php wp_head(); ?>       
    </head>
    <body <?php body_class(); ?> data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" data-home-url="<?php echo get_home_url() ?>"> 
        <?php echo get_field('schema', 'option') ?>
        <?php echo get_field('google_analytics_code', 'option') ?>
        <div id="desktop-delimiter"></div>
        <div id="overlay">
            <?php if ($logo && is_front_page()): ?>
                <div>
                    <img src="<?php echo $logo['url'] ?>" alt="" class="img-responsive" />
                </div>
            <?php endif ?>
        </div>
        <style>

            @media all and (max-width: 1024px)
            {
                html {
                    margin-top: 0px !important;
                }

                #wpadminbar
                {
                    display:none;
                }
            }

            #overlay
            {
                position: fixed;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 100%;
                background: #380a76;
                z-index: 1000;
            }

            #overlay > div
            {
                padding: 15px;
                
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
            }
            
            #overlay img
            {
                width: 100%;
                max-width: 300px;
                height: auto;
            }

        </style>
        <div id="entire-content">
            <div id="mobile-delimeter"></div>
            <div id="mobile-header" class="mobile">
                <div id="top-mobile-row">
                    <?php if ($mobile_logo): ?>
                        <a href="<?php echo get_home_url() ?>">
                            <img  id="mobile-logo"  src="<?php echo $mobile_logo['url'] ?>" alt="" class="img-responsive" />
                        </a>
                    <?php endif ?>

                    <?php
                    $mobile_phone_in_header = get_field('mobile_phone_in_header', 'option');
                    if (trim($mobile_phone_in_header)) {
                        ?>
                        <a href="tel:<?php echo $mobile_phone_in_header ?>" id="mobile-phone"><i class="fa fa-phone" ></i></a>
                        <?php
                    }
                    ?>

                    <a class="loke-menu-icon" id="menu-toggle" href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <div id="mobile-menu-wrapper">
                    <?php wp_nav_menu(array('theme_location' => 'top-menu')) ?>
                </div>
            </div>
            <header>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-3 align-middle">
                            <div>
                                <?php if ($logo): ?>
                                    <a href="<?php echo get_home_url() ?>">
                                        <img src="<?php echo $logo['url'] ?>" id="desktop-logo" alt="" class="img-responsive" />
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-sm-9 align-middle">
                            <div>
                                <?php wp_nav_menu(array('theme_location' => 'top-menu')) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
