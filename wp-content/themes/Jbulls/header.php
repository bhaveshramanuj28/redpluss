<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>redpluss</title>
    <?php wp_head(); ?>
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="row head">
                <div class="col-md-3">
                    <?php the_custom_logo(); ?>
                </div>
                <div class="col-md-5 menu-col">
                <?php
                    wp_nav_menu(
                        array(
                            'theme_locations' => 'top-menu',
                            'menu_class' => 'top-bar'
                            )  
                    );
                ?>
                </div>
                <div class="col-md-4 profile-main">
                    <?php 
                        $user = wp_get_current_user();
                        echo get_avatar($user);
                    ?>
                    <button class = "btn btn-lg ml-4 join">Join us <i class="fa-solid fa-arrow-right fa-2xs ml-2"  style="padding-top: 7px;"></i></button>
                </div>
            </div>
        </div>
    </header>