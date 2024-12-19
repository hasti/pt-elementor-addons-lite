<?php
/**
 * Plugin Name:      PT Elementor Addons Lite
 * Description:      Design stunning websites effortlessly with PT Addons for Elementor, featuring a versatile collection of widgets and limitless customization possibilities..
 * Plugin URI:       https://hastishah.com
 * Version:          2.4.0
 * Requires at least: 5.2
 * Requires PHP:     8.0
 * Tags:             elementor, elementor addons, elementor widgets, elementor extension, elementor page builder, elementor elements
 * Elementor tested up to: 3.26.0
 * Elementor Pro tested up to: 3.26.1
 * Category:         Plugin
 * Documentation:    https://hastishah.com/docs/pt-elementor-addons/
 * Support:          https://hastishah.com/support/
 * Author:           Hastimal Shah
 * Author URI:       https://hastishah.com/
 * Text Domain:      pt-elementor-addons
 * Requires Plugins: elementor
 * License:          GPL v2 or later
 * License URI:      https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:       https://hastishah.com
 * Update URL:       https://hastishah.com
 
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


function pt_elementor_addons_lite() {

	// Load plugin file
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin.php';

	// Ensure the namespace is correct
	return PT_Elementor_Addons_Lite\Plugin::instance();

}
add_action( 'plugins_loaded', 'pt_elementor_addons_lite' );


