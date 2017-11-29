<?php
/*
  Plugin Name: SB Image Hover Effects
  Plugin URI: https://www.oxilab.org/downloads/sb-image-hover-pro/
  Description: SB Image Hover Effects is Simple and Flexible Image hover effects.Its impressive, lightweight, responsive and fully CSS3. Apply SB Image hover effects on your website without any CSS coding knowledge.
  Author: Biplob Adhikari
  Author URI: https://www.oxilab.org/downloads/sb-image-hover-pro/
  Version: 6.5
 */
if (!defined('ABSPATH'))
    exit;

$sb_image_hover_version = '6.4';
define('sb_image_hover_plugin_url', plugin_dir_path(__FILE__));

add_shortcode('sb_image_oxi', 'sb_image_oxi_shortcode');
include sb_image_hover_plugin_url . 'public-data.php';

function sb_image_oxi_shortcode($atts) {
    extract(shortcode_atts(array('id' => ' ',), $atts));
    $styleid = $atts['id'];
    ob_start();
    sb_image_oxi_shortcode_function($styleid, 'user');
    return ob_get_clean();
}
add_filter('widget_text', 'do_shortcode');
include sb_image_hover_plugin_url . 'widget.php';
add_action('admin_menu', 'sb_image_hover_menu');

function sb_image_hover_menu() {
    add_menu_page('Image Hover', 'Image Hover', 'manage_options', 'sb-image-hover-effects', 'sb_image_hover_effects_home');
    add_submenu_page('sb-image-hover-effects', 'SB Image Hover', 'Image Hover', 'manage_options', 'sb-image-hover-effects', 'sb_image_hover_effects_home');
    add_submenu_page('sb-image-hover-effects', 'General Effects', 'General Effects', 'manage_options', 'sb-image-hover-effects-general', 'sb_image_hover_effects_general');
    add_submenu_page('sb-image-hover-effects', 'Square Effects', 'Square Effects', 'manage_options', 'sb-image-hover-effects-square', 'sb_image_hover_effects_square');
  ///  add_submenu_page('sb-image-hover-effects', 'Caption Effects', 'Caption Effects', 'manage_options', 'sb-image-hover-effects-caption', 'sb_image_hover_effects_caption');
    add_submenu_page('sb-image-hover-effects', 'Other Plugins', 'Other Plugins', 'manage_options', 'sb-image-hover-effects-other-plugins', 'sb_image_hover_effects_others_plugins');
}

function sb_image_hover_effects_home() {
    if (!current_user_can('edit_others_pages')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include sb_image_hover_plugin_url . 'home.php';
}

function sb_image_hover_effects_general() {
    if (!current_user_can('edit_others_pages')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    wp_enqueue_style('sb-image-style', plugins_url('public/style.css', __FILE__));
    wp_enqueue_script('sb-image-viewportchecker', plugins_url('public/viewportchecker.js', __FILE__));
    wp_enqueue_script('jQuery');
    if (empty($_GET['styleid'])) {
        include sb_image_hover_plugin_url . 'public/general-new.php';
        wp_enqueue_style('sb-image-bootstrap-style', plugins_url('css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('sb-image-font-awesome-style', plugins_url('css/font-awesome.min.css', __FILE__));
        wp_enqueue_style('sb-image-vendor-style', plugins_url('css/style.css', __FILE__));
        wp_enqueue_script('sb-image-bootstrap-js', plugins_url('js/bootstrap.min.js', __FILE__));
    }
    if (!empty($_GET['styleid'])) {
        sb_image_media_scripts();
        include sb_image_hover_plugin_url . 'public/general-settings.php';
        wp_enqueue_style('sb-image-bootstrap-style', plugins_url('css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('sb-image-font-awesome-style', plugins_url('css/font-awesome.min.css', __FILE__));
        wp_enqueue_style('sb-image-vendor-style', plugins_url('css/style.css', __FILE__));
        wp_enqueue_style('sb-image-minicolors-style', plugins_url('css/jquery.minicolors.css', __FILE__));
        wp_enqueue_script('jQuery');
        wp_enqueue_script('sb-image-bootstrap-js', plugins_url('js/bootstrap.min.js', __FILE__));
        wp_enqueue_script('sb-image-font-select-js', plugins_url('js/font-select.js', __FILE__));
        wp_enqueue_script('sb-image-minicolors-js', plugins_url('js/jquery.minicolors.min.js', __FILE__));
        wp_enqueue_script('sb-image-vendor-js', plugins_url('js/vendor.js', __FILE__));
    }
}

function sb_image_hover_effects_square() {
     if (!current_user_can('edit_others_pages')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    wp_enqueue_script('jQuery');
    wp_enqueue_style('sb-image-style', plugins_url('public/style.css', __FILE__));
    wp_enqueue_script('sb-image-viewportchecker', plugins_url('public/viewportchecker.js', __FILE__));
    if (empty($_GET['styleid'])) {
        include sb_image_hover_plugin_url . 'public/square-new.php';
        wp_enqueue_style('sb-image-bootstrap-style', plugins_url('css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('sb-image-font-awesome-style', plugins_url('css/font-awesome.min.css', __FILE__));
        wp_enqueue_style('sb-image-vendor-style', plugins_url('css/style.css', __FILE__));
        wp_enqueue_script('sb-image-bootstrap-js', plugins_url('js/bootstrap.min.js', __FILE__));
    }
    if (!empty($_GET['styleid'])) {
        sb_image_media_scripts();
        include sb_image_hover_plugin_url . 'public/square-settings.php';
        wp_enqueue_style('sb-image-bootstrap-style', plugins_url('css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('sb-image-font-awesome-style', plugins_url('css/font-awesome.min.css', __FILE__));
        wp_enqueue_style('sb-image-vendor-style', plugins_url('css/style.css', __FILE__));
        wp_enqueue_style('sb-image-minicolors-style', plugins_url('css/jquery.minicolors.css', __FILE__));
        wp_enqueue_script('jQuery');
        wp_enqueue_script('sb-image-bootstrap-js', plugins_url('js/bootstrap.min.js', __FILE__));
        wp_enqueue_script('sb-image-font-select-js', plugins_url('js/font-select.js', __FILE__));
        wp_enqueue_script('sb-image-minicolors-js', plugins_url('js/jquery.minicolors.min.js', __FILE__));
        wp_enqueue_script('sb-image-vendor-js', plugins_url('js/vendor.js', __FILE__));
    }
}

function sb_image_hover_effects_caption() {
    if (!current_user_can('edit_others_pages')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include sb_image_hover_plugin_url . 'home.php';
}

function sb_image_hover_effects_others_plugins() {
    if (!current_user_can('edit_others_pages')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include sb_image_hover_plugin_url . 'other-plugins/other-plugins.php';
}

function sb_image_media_scripts() {
    wp_enqueue_media();
    wp_register_script('sb_image_media_scripts', plugins_url('js/media-uploader.js', __FILE__));
    wp_enqueue_script('sb_image_media_scripts');
}

add_action('admin_head', 'add_sb_image_hover_icons_styles');

function add_sb_image_hover_icons_styles() {
    ?>
    <style>
        #adminmenu #toplevel_page_sb-image-hover-effects div.wp-menu-image:before {
            content: "\f115";
        }
    </style>

    <?php
}

register_activation_hook(__FILE__, 'sb_image_hover_effects_install');

function sb_image_hover_effects_install() {
    global $wpdb;
    global $sb_image_hover_version;

    $table_name = $wpdb->prefix . 'sb_image_hover_effects_style';
    $table_list = $wpdb->prefix . 'sb_image_hover_effects_list';

    $charset_collate = $wpdb->get_charset_collate();

    $sql1 = "CREATE TABLE $table_name (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                name varchar(100) NOT NULL,
		style_name varchar(100) NOT NULL,
                css text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    $sql2 = "CREATE TABLE $table_list (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                styleid mediumint(6) NOT NULL,
                stylename varchar(100),
		title varchar(100),
                files varchar(800),
                buttom_text varchar(100),
                link varchar(800),
                image varchar(800),
                hoverimage varchar(800),
                css text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql1);
    dbDelta($sql2);

    add_option('sb_image_hover_version', $sb_image_hover_version);

    set_transient('_sb_image_hover_welcome_activation_redirect', true, 30);
}

add_action('admin_init', 'sb_image_hover_welcome_do_activation_redirect');

function sb_image_hover_welcome_do_activation_redirect() {
    if (!get_transient('_sb_image_hover_welcome_activation_redirect')) {
        return;
    }
    delete_transient('_sb_image_hover_welcome_activation_redirect');
    if (is_network_admin() || isset($_GET['activate-multi'])) {
        return;
    }
    wp_safe_redirect(add_query_arg(array('page' => 'sb-image-hover-effects-welcome'), admin_url('index.php')));
}

add_action('admin_menu', 'sb_image_hover_welcome_pages');

function sb_image_hover_welcome_pages() {
    add_dashboard_page(
            'Welcome To SB Image Hover Effects', 'Welcome To SB Image Hover Effects', 'read', 'sb-image-hover-effects-welcome', 'sb_image_hover_effects_welcome'
    );
}

function sb_image_hover_effects_welcome() {
    wp_enqueue_style('sb-image-welcome-style', plugins_url('css/admin-welcome.css', __FILE__));
    ?>
    <div class="wrap about-wrap">

        <h1>Welcome to SB Image Hover Effects</h1>
        <div class="about-text">
            Thank you for choosing SB image Hover Effects - the most beginner friendly WordPress Image Hover plugin. Here's how to get started.
        </div>
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active">
                Getting Started		
            </a>
        </h2>
        <p class="about-description">
            Use the tips below to get started using SB Image Hover Effects. You will be up and running in no time.	
        </p>
        <div class="feature-section">
            <h3>Creating Your First Hover Effects</h3>
            <p>SB Image Hover Effects makes it easy to create Hover Effects in WordPress. You can follow the video tutorial on the right or read our how to 
                <a href="https://www.oxilab.org/docs/sb-image-hover-effects/getting-started/installing-for-the-first-time/" target="_blank" rel="noopener">create your first Hover effects guide</a>.					</p>
            <p>But in reality, the process is so intuitive that you can just start by going to <a href="<?php echo admin_url();?>admin.php?page=sb-image-hover-effects-general">Image Hover - &gt; General Effects</a>.				</p>
            </br>
            </br>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/8LTmvNrcxYg" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="feature-section">
            <h3>See all SB Image Hover Effects Features</h3>
            <p>SB Image Hover Effects is both easy to use and extremely powerful. We have tons of helpful features that allows us to give you everything you need on Image Hover Effects.</p>
            <p>1. Awesome Live Preview Panel</p>
            <p>1. Can Customize with Our Settings</p>
            <p>1. Easy to USE & Builtin Integration for popular Page Builder</p>
            <p><a href="https://www.oxilab.org/downloads/sb-image-hover-pro/" target="_blank" rel="noopener" class="sb-image-features-button button button-primary">See all Features</a></p>

        </div>
        <div class="feature-section">
            <h3>Have any Bugs or Suggestion</h3>
            <p>Your suggestions will make this plugin even better, Even if you get any bugs on SB Image Hover Effects so let us to know, We will try to solved within few hours</p>
            <p><a href="https://www.oxilab.org/contact-us" target="_blank" rel="noopener" class="sb-image-features-button button button-primary">Contact Us</a>
                <a href="https://wordpress.org/support/plugin/sb-image-hover-effects" target="_blank" rel="noopener" class="sb-image-features-button button button-primary">Support Forum</a></p>

        </div>

    </div>
    <?php
}

add_action('admin_head', 'sb_image_hover_welcome_screen_remove_menus');

function sb_image_hover_welcome_screen_remove_menus() {
    remove_submenu_page('index.php', 'sb-image-hover-effects-welcome');
}

function sb_image_html_special_charecter($data) {
    $data = str_replace("\'", "'", $data);
    $data = str_replace('\"', '"', $data);
    return $data;
}

function sb_image_font_familly_special_charecter($data) {
    $data = str_replace('+', ' ', $data);
    $data = explode(':', $data);
    $data = $data[0];
    $data = '"' . $data . '"';
    return $data;
}


if (!function_exists('is_plugin_active')) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
}
if (is_plugin_active('js_composer/js_composer.php')) {
        add_action('vc_before_init', 'SB_oxi_VC_extension');
        add_shortcode('sb_oxi_VC', 'SB_oxi_VC_shortcode');

        function SB_oxi_VC_shortcode($atts) {
            extract(shortcode_atts(array(
                'id' => ''
                            ), $atts));
            $styleid = $atts['id'];
            ob_start();
           sb_image_oxi_shortcode_function($styleid, 'user');
            return ob_get_clean();
        }

        function SB_oxi_VC_extension() {
            global $wpdb;
            $data = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'sb_image_hover_effects_style ORDER BY id DESC', ARRAY_A);
            $vcdata = array();
            foreach ($data as $value) {
                $vcdata[] = $value['id'];
            }
            vc_map(array(
                "name" => __("SB Image Hover Effects"),
                "base" => "sb_oxi_VC",
                "category" => __("Content"),
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Image Hover Select",
                        "param_name" => "id",
                        "value" => $vcdata,
                        'save_always' => true,
                        "description" => "Select your Image Hover ID",
                        "group" => 'Settings',
                    ),
                )
            ));
        }

    }
    
    
    
    
    ### Old Data of SB image Hover Effects
    
    if (!class_exists('VP_siheAutoLoader')) {
    defined('VP_SIHE_VERSION') or define('VP_SIHE_VERSION', '2.0');
    defined('VP_SIHE_URL') or define('VP_SIHE_URL', plugin_dir_url(__FILE__));
    defined('VP_SIHE_DIR') or define('VP_SIHE_DIR', plugin_dir_path(__FILE__));
    defined('VP_SIHE_FILE') or define('VP_SIHE_FILE', __FILE__);

// Looding Bootstrap framework
    require 'built_in_data/bootstrap.php';
}
function sihe_custom_post_calling() {
    register_post_type('sihe-hov', array(
        'labels' => array(
            'name' => __('SB Hov Effects'),
            'singular_name' => __('Hover Effect'),
            'add_new_item' => __('Add New Item')
        ),
        'public' => true,
        'supports' => array('title'),
        'show_ui' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'hover-effects'),
        'show_in_menu' => false,
    ));
}

add_action('init', 'sihe_custom_post_calling');

new VP_Metabox(array
    (
    'id' => 'sihe_meta',
    'types' => array('sihe-hov'),
    'title' => __('SB Hover Effects ', 'vp_textdomain'),
    'priority' => 'high',
    'template' => VP_SIHE_DIR . '/admin/metabox.php'
        ));
// calling shortcode
require ('admin/shortcode.php');
require ('admin/code-gen.php');


function sb_image_promote_free() {
    ?>

    <div class="sb-image-admin-wrapper-promote">
        <div class="col-lg-5 col-md-5 hidden-sm hidden-xs">
            <div class="sb-image-h1">SB Image  <span>Hover Effects</span></div>
            <p>If you have any difficulties in using the options, please follow the link to <a href="https://www.oxilab.org/docs/sb-image-hover-effects/getting-started/installing-for-the-first-time/">Documentation</a> </p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xm-12">
            <p><a target="_blank" href="https://www.oxilab.org/downloads/sb-image-hover-pro/" class="sb-image-admin-wrapper-promote-botton"><i class="fa fa-cart-plus" aria-hidden="true"></i> Upgrade NOW </a> <br> Just click on "Upgrade NOW" to get Pro Version only $13.99.</p>
        </div>
        <div class="col-lg-3 col-md-3  hidden-sm hidden-xs sb-image-admin-wrapper-promote-rate">
            <p> <i class="fa fa-heart" aria-hidden="true"></i>  <a target="_blank" href="https://wordpress.org/support/plugin/sb-image-hover-effects/reviews/">Rate Us</a></p>
            <p> <i class="fa fa-life-ring" aria-hidden="true"></i>  <a target="_blank" href="https://wordpress.org/support/plugin/sb-image-hover-effects/">Support Ticket</a></p>
            <p> <i class="fa fa-envelope" aria-hidden="true"></i>  <a target="_blank" href="https://www.oxilab.org/contact-us/">Contact Oxilab</a></p>
            <p> <i class="fa fa-youtube" aria-hidden="true"></i> <a target="_blank" href="https://youtu.be/8LTmvNrcxYg">Video Tutorials</a></p>
        </div>
    </div>
    <?php
}