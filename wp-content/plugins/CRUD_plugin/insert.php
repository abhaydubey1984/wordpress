<?php
require( dirname(__FILE__).'/wp-load.php' );
global $wpdb;
$data = json_decode(file_get_contents("php://input"));
$name=$data->name;
$address=$data->address;
$city=$data->city;
$phone=$data->phone;
$wpdb->insert('wp_contact',array("name"=>$name,"address"=>$address,"city"=>$city,"phone"=>$phone));
?>