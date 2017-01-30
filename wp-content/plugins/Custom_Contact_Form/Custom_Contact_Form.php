<?php
/*
Plugin Name: Contact Table
Description: Contact Information.
Version: 1.0
Author: Pintu Soliya
*/

register_activation_hook( __FILE__, 'create_contact' );
function create_contact()
{
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'contact';
	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name varchar(30) NOT NULL,
		address varchar(30) NOT NULL,
		city varchar(30) NOT NULL,
		phone varchar(20),
		UNIQUE KEY id (id)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	
	dbDelta( $sql );

}

?>