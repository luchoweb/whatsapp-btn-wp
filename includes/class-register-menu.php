<?php

class WAFB_Register_Menu {
  public function register_settings_link( $links, $file ) {
    if ( $file == plugin_basename(dirname(__DIR__) . '/index.php') ) {
        $in = '<a href="/wp-admin/admin.php?page='. WAFB_TEXT_DOMAIN .'/admin/settings.php">' . __('Settings', WAFB_TEXT_DOMAIN) . '</a>';
        array_unshift($links, $in);
    }
    return $links;
  }

  public function register() {
    add_menu_page(
      __( WAFB_TITLE, WAFB_TEXT_DOMAIN ),
      __( WAFB_TITLE, WAFB_TEXT_DOMAIN ),
      'manage_options',
      WAFB_TEXT_DOMAIN.'/admin/settings.php',
      '',
      'dashicons-whatsapp'
    );
  }
}
