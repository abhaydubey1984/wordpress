<?php
/*
Plugin Name: File Upload
*/
register_activation_hook( __FILE__, 'create_zip_code' );
function create_zip_code()
{
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'zip_code';
	$sql = "CREATE TABLE $table_name (
		id mediumint(9) primary key AUTO_INCREMENT ,
		zip mediumint(9) NOT NULL,
		country_code mediumint(9) NOT NULL,
		city varchar(30) NOT NULL,
		state varchar(30) NOT NULL,
		country varchar(30) NOT NULL,
		UNIQUE KEY id (zip)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	
	dbDelta( $sql );

}
register_deactivation_hook(__FILE__,'drop_zip_code');
function drop_zip_code()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'zip_code';
	$sql = "DROP TABLE IF EXISTS $table_name;";
	$wpdb->query($sql);
}
register_activation_hook( __FILE__,'locations' );
function locations()
{
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'locations';
	$sql = "CREATE TABLE $table_name (
		franchise_id mediumint(9) primary key AUTO_INCREMENT ,
		franchise_name varchar(30) NOT NULL,
		phone varchar(30) NOT NULL,
		website varchar(30) NOT NULL,
		email varchar(30) NOT NULL,
		country_codes varchar(80) NOT NULL
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	
	dbDelta( $sql );

}
register_deactivation_hook(__FILE__,'drop_locations');
function drop_locations()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'locations';
	$sql = "DROP TABLE IF EXISTS $table_name;";
	$wpdb->query($sql);
}
add_action('admin_menu','register_my_custom_menu');
function register_my_custom_menu()
{
	add_menu_page('Plugin Page','Upload Plugin','manage_options','main_menu','main_plugin_page');

}
function main_plugin_page()
{
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="#" method="post" enctype="multipart/form-data">
	<table>
		<tr>
		<td>
		<input type="file" name="zip"/></br>
		<input type="file" name="location"></br>
		<input type="submit" name="submit" value="submit">
		</td>
		</tr>
	</table>
</form>
</body>
</html>
	<?php
	if(isset($_REQUEST['submit']))
	{
		global $wpdb;
		if(is_uploaded_file($_FILES['zip']['tmp_name']))
		{
			$csvFile = fopen($_FILES['zip']['tmp_name'], 'r');
			fgetcsv($csvFile);
			while(($line = fgetcsv($csvFile)) !== FALSE){
			 	$wpdb->query("insert into wp_zip_code(zip,country_code,city,state,country) values($line[0],$line[1],'$line[2]','$line[3]','$line[4]')");
			 }
			  fclose($csvFile);
		}
		if(is_uploaded_file($_FILES['location']['tmp_name']))
		{
			
			$csvFile = fopen($_FILES['location']['tmp_name'], 'r');
			fgetcsv($csvFile);
			 while(($line = fgetcsv($csvFile)) !== FALSE){
			 	$wpdb->query("insert into wp_locations(franchise_name,phone,website,email,country_codes) values('$line[1]','$line[2]','$line[3]','$line[4]','$line[5]')");
			 }
			  fclose($csvFile);
		}
	}
}
?>