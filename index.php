<?php

/**
* Plugin Name: WhatsApp Floating Button
* Description: A WhatsApp floating button in all pages.
* Author: Lucho Web
* Author URI: https://luchoweb.dev
* Text Domain:  whatsapp-button
* Domain Path:  /languages
*/

if ( ! defined( 'WPINC' ) ) {
  die;
}

define( 'WAFB_VERSION', '1.0.0' );
define( 'WAFB_WP_ADMIN_DIR', 'admin' );
define( 'WAFB_TEXT_DOMAIN', 'whatsapp-button' );
define( 'WAFB_TITLE', 'WAFB');

require_once plugin_dir_path(__FILE__) . 'includes/classes.php';

function active_wafb_plugin() {
  $migrations = new WAFB_Migrations();
  $migrations->create_tables();
}
register_activation_hook( __FILE__, 'active_wafb_plugin' );

function uninstall_wafb_plugin() {
  $migrations = new WAFB_Migrations();
  $migrations->delete_tables();
}
register_uninstall_hook( __FILE__, 'uninstall_wafb_plugin');

add_action( 'admin_menu', [ new WAFB_Register_Menu(), 'register' ] );
add_filter( 'plugin_action_links', [ new WAFB_Register_Menu(), 'register_settings_link' ], 10, 2 );

add_action( 'wp_body_open', [new WAFB_Render(), 'render'], 10, 2);

$assets = new WAFB_Render();
$assets->hooks();
