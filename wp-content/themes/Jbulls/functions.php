<?php

function load_css(){
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');
    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
    wp_enqueue_style('main');
    wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), false, 'all');
    wp_enqueue_style('font-awesome');
}
add_action('wp_enqueue_scripts', 'load_css');

// custom slider function and widget section
function enqueue_slick_slider() {
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-slider-js', get_template_directory_uri() . '/js/custom-slider.js', array('jquery', 'slick-js'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider');


function loop_slider_shortcode($atts) {
    $args = array(
        'post_type' => 'post', // You can change this to any post type
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) : ?>
        <div class="your-slider-class">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="slider-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="slider-image">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="slider-content">
                        <h3><?php the_title(); ?></h3>
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('loop_slider', 'loop_slider_shortcode');


class Loop_Slider_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'loop_slider_widget',
            __('Loop Slider Widget', 'text_domain'),
            array('description' => __('A Widget to display a loop slider', 'text_domain'),)
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo do_shortcode('[loop_slider]');
        echo $args['after_widget'];
    }
}

function register_loop_slider_widget() {
    register_widget('Loop_Slider_Widget');
}
add_action('widgets_init', 'register_loop_slider_widget');





// js loading function
function load_js(){
    wp_enqueue_script('jquery');

    wp_register_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', 1, true);
    wp_enqueue_script('bootstrap_js');
}
add_action('wp_enqueue_scripts', 'load_js');

//theme options
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');

// theme logo setup

function themename_custom_logo_setup() {
	$defaults = array(
        'header-text'          => array( 'site-title', 'site-description' ),
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );


// register theme menu
register_nav_menus(
    array(
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location',
        'first-footer-menu' => 'First Footer Menu Location',
        'second-footer-menu' => 'Second Footer Menu Location',
        'third-footer-menu' => 'Third Footer Menu Location',
    )
);
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

// footer logo

add_action("customize_register", "logo_customizer_register");

function logo_customizer_register($wp_customize) {
    // Add Panel
    $wp_customize->add_panel('mypanel',
        array(
            'priority' => 100,
            'title' => __('Theme Options', 'themeprefix'),
            'description' => __('Theme Modifications like color, footer, header. ', 'themeprefix'),
        )
    );
    // Add Footer section
    $wp_customize->add_section('footer-section',
        array(
            'title' => __('Footer', 'themeprefix'),
            'priority' => 1,
            'panel' => 'mypanel'
        )
    );

    // Footer Logo
    $wp_customize->add_setting("custom_footer_logo", [
        "transport" => "postMessage"
    ]);
    $wp_customize->add_control(
        new WP_Customize_Cropped_Image_Control(
            $wp_customize,
            "custom_footer_logo",
            [
                "label" => __("Footer Logo", "themeprefix"),
                "flex_width" => true,
                "flex_height" => true,
                // Define height width based on your need.
                "width" => 50,
                "height" => 50,
                "settings" => "custom_footer_logo",
                "section" => "footer-section",
                "priority" => 1,
            ]
        )
    );
}
// image size register
add_image_size('hero', 650, 700, true);


function custom_search(){
    ?>
    <form action = "./" method = "get">
    <label for="search">search</label>
    <!-- <input type="hidden" name = "cat" value = ""> -->
    <input type="text" name = "s" id= "search" value = "<?php the_search_query(); ?>" required class="search-cus">
    <input type="text" name = "s" id= "search" value = "<?php the_search_query(); ?>" required class="search-cus">
    <button type = "submit">search</button>
</form>
<?php
}
add_shortcode('custom_search', 'custom_search');


// animated counter widget

function display_animated_counter() {
    ob_start();
    ?>
    <div style="font-size: 24px; text-align: center;"><p id="animated-counter" class = "counter">1</p><br><p class ="counter-message">Happy Customer</p></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var counterElement = document.getElementById('animated-counter');
            var count = 0;
            var interval = setInterval(function() {
                count++;
                counterElement.textContent = count+'k';
                if (count === 10) {
                    clearInterval(interval);
                }
            }, 300);
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('animated_counter', 'display_animated_counter');

function display_animated_counter1() {
    ob_start();
    ?>
    <div style="font-size: 24px; text-align: center;"><p id="animated-counter1" class = "counter">1</p><br><p class ="counter-message">Monthly visitors</p></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var counterElement = document.getElementById('animated-counter1');
            var count = 0;
            var interval = setInterval(function() {
                count++;
                counterElement.textContent = count+'k';
                if (count === 150) {
                    clearInterval(interval);
                }
            }, 50);
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('animated_counter1', 'display_animated_counter1');

function display_animated_counter2() {
    ob_start();
    ?>
    <div style="font-size: 24px; text-align: center;"><p id="animated-counter2" class = "counter">1</p><br><p class ="counter-message">Indian States</p></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var counterElement = document.getElementById('animated-counter2');
            var count = 0;
            var interval = setInterval(function() {
                count++;
                counterElement.textContent = count+'+';
                if (count === 5) {
                    clearInterval(interval);
                }
            }, 500);
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('animated_counter2', 'display_animated_counter2');

function display_animated_counter3() {
    ob_start();
    ?>
    <div style="font-size: 24px; text-align: center;"><p id="animated-counter3" class = "counter">1</p><br><p class ="counter-message">Top partners</p></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var counterElement = document.getElementById('animated-counter3');
            var count = 0;
            var interval = setInterval(function() {
                count++;
                counterElement.textContent = count+'+';
                if (count === 100) {
                    clearInterval(interval);
                }
            }, 50);
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('animated_counter3', 'display_animated_counter3');


// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
  }
  add_action( 'admin_head', 'fix_svg' );


// custom post types within the website

function healthcare_post_type(){

    $args = array(

        'labels' => array(
            'name' => 'Healthcare Packages',
            'singular_name' => 'Healthcare Package',
            'add_new' => __( 'Add New Healthcare Package' ),
            'add_new_item' => __( 'Add New Healthcare Package' ),
            'edit' => __( 'Edit' ),
            'edit_item' => __( 'Edit Healthcare Package' ),
            'new_item' => __( 'New Healthcare Package' ),
            'view' => __( 'View Healthcare Package' ),
            'view_item' => __( 'View Healthcare Package' ),
            'search_items' => __( 'Search Healthcare Packages' ),
            'not_found' => __( 'No Healthcare Packages found' ),
            'not_found_in_trash' => __( 'No Healthcare Packages found in Trash' ),
            'parent' => __( 'Parent Healthcare Package' ),
            
        ),

        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite' => array('slug' => 'healthcare_packages'),
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,
        'menu_icon' => 'dashicons-plus-alt'

    );
    register_post_type('Healthcare Packages', $args);
}
add_action('init', 'healthcare_post_type');

function first_custom_taxonomy(){
    $args = array(
        'labels' => array(
            'name' => 'Location',
            'singular_name' => 'location',
            'add_new' => __( 'Add New location' ),
            'add_new_item' => __( 'Add New location' ),
            'edit' => __( 'Edit' ),
            'edit_item' => __( 'Edit location' ),
            'new_item' => __( 'New location' ),
            'view' => __( 'View location' ),
            'view_item' => __( 'View location' ),
            'search_items' => __( 'Search location' ),
            'not_found' => __( 'No location found' ),
            'not_found_in_trash' => __( 'No location found in Trash' ),
            'parent' => __( 'Parent location' ),
            
        ),
        'public' => true,
        'hierarchical' => true, 
    );

    register_taxonomy('location', array('Healthcare Packages'), $args);

}
add_action('init', 'first_custom_taxonomy');


