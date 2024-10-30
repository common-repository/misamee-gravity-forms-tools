<?php
if (!class_exists('grand_total_helper')) {
    require_once 'grand_total_helper.php';
}

if (!class_exists('mgft_editor_ajax')) {
    require_once 'mgft_editor_ajax.php';
}

class mgft_editor
{
    static function setup_editor()
    {
        add_action('media_buttons_context', array(__CLASS__, 'misamee_gf_shortcode_button'), 1000);

        add_action('wp_ajax_get_sample', array('mgft_editor_ajax', 'process_ajax_sample'));
        add_action('wp_ajax_get_fields', array('mgft_editor_ajax', 'process_ajax_fields'));
    }

    static function misamee_gf_shortcode_button($context)
    {
        $is_post_edit_page = in_array(RG_CURRENT_PAGE, array('post.php', 'page.php', 'page-new.php', 'post-new.php'));
        if (!$is_post_edit_page)
            return $context;

        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_style('wp-jquery-ui-dialog');

        wp_enqueue_style('colorpicker', misamee_gf_tools::getPluginUrl() . 'css/jquery.miniColors.css');
        wp_enqueue_script('jquery-colorpicker', misamee_gf_tools::getPluginUrl() . 'js/jquery.miniColors.min.js', array('jquery'));

        $image_btn = misamee_gf_tools::getPluginUrl() . "images/06_calculator_48.png";
        $out = '<a href="#" id="add_mgftshortcode" title="' . __("Add Gravity Form Tool Shortcode", misamee_gf_tools::$localizationDomain) . '"><image src="' . $image_btn . '" alt="' . __("Add Gravity Form", misamee_gf_tools::$localizationDomain) . '" style="width:18px" /></a>';
        return $context . $out;
    }

    //Action target that displays the popup to insert a form to a post/page
    public static function add_mce_popup()
    {
        include 'mgft_editor_js.php';
		include 'mgft_editor_css.php';
        include 'mgft_editor_html.php';
    }
}
