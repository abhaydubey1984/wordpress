<?php
/*
Template Name:custom
*/

?>

<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<?php

if(isset($_REQUEST['submit']))
{
	
	  global $name,$address,$city,$phone;
	  $name = $_REQUEST['name'];
	  $address = $_REQUEST['address'];
	  $city = $_REQUEST['city'];
	  $phone = $_REQUEST['phone'];
	  global $wpdb;
	  $table_name = $wpdb->prefix."contact";
	  $wpdb->insert($table_name, array('name' => $name, 'address' => $address,'city'=>$city,'phone'=>$phone)); 
	//header('location:localhost/wordpress');
}
?>
<form method="post">
	<table>
		<tr>
		<td>
		Name
		</td>
		<td>
		<input type="text" name="name">
		</td>
		</tr>
		<tr>
		<td>
		Address
		</td>
		<td>
		<input type="text" name="address">
		</td>
		</tr>
		<tr>
		<td>
		City
		</td>
		<td>
		<input type="text" name="city">
		</td>
		</tr>
		<tr>
		<td>
		Phone Number
		</td>
		<td>
		<input type="text" name="phone">
		</td>
		</tr>
		<tr>
		<td>
		<input type="submit" name="submit" value="Submit">
		</td>
		</tr>

	</table>
</form>
</body>
</html>