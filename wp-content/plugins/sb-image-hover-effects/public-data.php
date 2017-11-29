<?php

if (!defined('ABSPATH'))
    exit;

function sb_image_oxi_shortcode_function($styleid, $userdata) {
    $styleid = (int) $styleid;
    global $wpdb;
    $table_list = $wpdb->prefix . 'sb_image_hover_effects_list';
    $table_name = $wpdb->prefix . 'sb_image_hover_effects_style';
    $listdata = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_list WHERE styleid = %d ORDER by id ASC ", $styleid), ARRAY_A);
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
    $stylename = $styledata['style_name'];
    wp_enqueue_style('sb-image-style', plugins_url('public/style.css', __FILE__));
    wp_enqueue_script('sb-image-viewportchecker', plugins_url('public/viewportchecker.js', __FILE__));
    $styledata = $styledata['css'];
    $styledata = explode('|', $styledata);
    if ($stylename == 'sb-image-hover-effects-general') {
        include_once  sb_image_hover_plugin_url . 'sb-image-hover-effects-general.php';
        sb_image_oxi_shortcode_function_general($styleid, $styledata, $listdata, $userdata);
    }
    if ($stylename == 'sb-image-hover-effects-square') {
        include_once sb_image_hover_plugin_url . 'sb-image-hover-effects-square.php';
        sb_image_oxi_shortcode_function_square($styleid, $styledata, $listdata, $userdata);
    }
}
