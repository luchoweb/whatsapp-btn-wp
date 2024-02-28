<?php

global $wafb_db_version;
$wafb_db_version = WAFB_VERSION;

class WAFB_Migrations {
  private $wafb_db_version;

  public function __construct() {
    global $wafb_db_version;

    $this->wafb_db_version = $wafb_db_version;
  }

  public function create_tables() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
  
    $table_name = $wpdb->prefix . 'wafb_settings';
    $table_values = "(
      id int NOT NULL,
      country_code int(5),
      phone_number varchar(10),
      message varchar(100),
      icon_height int(10),
      icon_width int(10),
      class_position varchar(20),
      PRIMARY KEY (id)
    )";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta( "CREATE TABLE IF NOT EXISTS $table_name $table_values $charset_collate;" );
    add_option( 'wafb_db_version', $this->wafb_db_version );

    $this->insert_initial_data($table_name);
  }

  private function insert_initial_data($table) {
    global $wpdb;

    $data = array( 
        'country_code' => 57,
        'phone_number' => '3008291060',
        'message' => "Hola. Quiero más información sobre ",
        'icon_height' => 70,
        'icon_width' => 70,
        'class_position' => 'bottom right'
    );

    $format = array( '%s', '%s', '%s', '%d' );
    
    $stmt = $wpdb->insert( $table, $data, $format );
  }

  public function delete_tables() {
    global $wpdb;

    // Add tables here
    $tables = [
      $wpdb->prefix . 'wafb_settings',
    ];

    foreach ($tables as $table_name) {
      $wpdb->query("DROP TABLE IF EXISTS $table_name");
    }
  }
}
