<?php
/*
Plugin Name: CRUD opration
Description: CRUD with custom table
Author: Pintu Soliya
*/
?>
<!--  Insert Data Using Shortcode -->
<?php
add_action( 'init', 'my_script_enqueuer' );
function my_script_enqueuer() {
  wp_register_script( "crud_script", WP_PLUGIN_URL.'/CRUD_plugin/js/myscript.js', array('jquery') );
  wp_localize_script( 'crud_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'crud_script' );
}
add_shortcode('insert_data','insert_data_function');
function insert_data_function() {
?>
<div>
<div>
	<h1> ::&nbsp;&nbsp;&nbsp;Insert&nbsp;&nbsp;&nbsp;:: </h1>
	<form method="post" action="">
	<table>
		<tr>
		<td>
		Name
		</td>
		<td>
		<input type="text" name="name" id="name">
		</td>
		</tr>
		<tr>
		<td>
		Address
		</td>
		<td>
		<input type="text" name="address" id="address">
		</td>
		</tr>
		<tr>
		<td>
		City
		</td>
		<td>
		<input type="text" name="city" id="city">
		</td>
		</tr>
		<tr>
		<td>
		Phone Number
		</td>
		<td>
		<input type="text" name="phone" id="phone">
		</td>
		</tr>
		<tr>
		<td>
		<input type="submit" name="submit" value="Submit" id="submit">
		</td>
		</tr>
	</table>
</form>	<?php	
}
?>
</div>
<?php
add_shortcode("get_data","get_data_contact");
function get_data_contact()
{
	?>
	<div>
	<table>
	<th>Name</th>
	<th>Address</th>
	<th>City</th>
	<th>Phone Number</th>
	<?php
	global $wpdb;
	$sql=$wpdb->get_results("select * from wp_contact");
	foreach($sql as $data)
	{
		?>
		<tr>
			<td><?php echo $data->name; ?></td>
			<td><?php echo $data->address; ?></td>
			<td><?php echo $data->city; ?></td>
			<td><?php echo $data->phone; ?></td>	
		</tr>
		<?php
	}
	?>
	</table>
	</div>
	</div>
	<?php
}
?>


<?php
add_action( 'wp_ajax_nopriv_insert_data', 'insert_data' );
add_action( 'wp_ajax_insert_data','insert_data' );
function insert_data() {
	global $wpdb;
	$data = json_decode(file_get_contents("php://input"));
	$name=$data->name;
	$address=$data->address;
	$city=$data->city;
	$phone=$data->phone;
	$wpdb->insert('wp_contact',array("name"=>$name,"address"=>$address,"city"=>$city,"phone"=>$phone)
);
}
?>
