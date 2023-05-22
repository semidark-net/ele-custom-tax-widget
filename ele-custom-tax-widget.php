<?php
/**
 * Plugin Name: Custom Taxonomy Widget
 * Description: Elementor widget for displaying custom post type taxonomies.
 * Version: 1.0.0
 * Author: Nico Thomaier
 * Author URI: https://semidark.net
 * Text Domain: ele-custom-tax-widget
 */

// Make sure this file is called by WordPress
if (!defined('ABSPATH')) {
    exit;
}

function ele_custom_tax_widget_init() {
    if (class_exists('Elementor\\Widget_Base')) {
        require_once 'ele-custom-tax-widget-class.php';
        \Elementor\Plugin::instance()->widgets_manager->register(new Ele_Custom_Tax_Widget());
    }
}

/*
function ele_custom_tax_widget_enqueue_styles() {
    wp_enqueue_style('ele-custom-tax-widget-style', plugins_url('ele-custom-tax-widget.css', __FILE__), array(), '1.0.0', 'all');

}
add_action('elementor/frontend/before_enqueue_styles', 'ele_custom_tax_widget_enqueue_styles');
*/
add_action('elementor/widgets/register', 'ele_custom_tax_widget_init');
