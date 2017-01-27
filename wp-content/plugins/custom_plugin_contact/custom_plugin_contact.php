<?php
/*
Plugin Name: Contact
Description: Contact Information.
Version: 1.0
Author: Pintu Soliya
*/
?>
<?php
	add_action('widgets_init','register_contact_widget');
	function register_contact_widget(){
		register_widget('prowp_widget_contact');
	}
	class prowp_widget_contact extends WP_Widget{
		function prowp_widget_contact(){
			$option=array('classname'=>'contact_widget','description'=>"Contact Information");
			$this->WP_Widget('contact_widget_id','Contact Information',$option);
		}
		function form($instance){
			$default=array('name'=>'','address'=>'','contact'=>'');
			$instance=wp_parse_args((array)$instance,$default);
			$name=$instance['name'];
			$address=$instance['address'];
			$contact=$instance['contact'];
?>
<p>
	Name :<input type="text" name="<?php echo $this->get_field_name('name'); ?>" class="widefat" 
	value="<?php echo esc_attr($name); ?>">

</p>
<p>
	Address:
	<input type="text" name="<?php echo $this->get_field_name('address'); ?>" class="widefat" 
	value="<?php echo esc_attr($address); ?>">
</p>
<p>
	Contact Number:
	<input type="text" name="<?php echo $this->get_field_name('contact'); ?>" class="widefat" 
	value="<?php echo esc_attr($contact); ?>">
</p>
<?php
		}
		function update($new_instance,$old_instance)
		{
			$instance=$old_instance;
			$instance['name']=sanitize_text_field($new_instance['name']);
			$instance['address']=sanitize_text_field($new_instance['address']);
			$instance['contact']=sanitize_text_field($new_instance['contact']);
			return $instance;
		}
		function widget($args,$instance){
			extract($args);
			echo $before_widget;
			$name=(empty($instance['name'])) ? '&nbsp' : $instance['name'];
			$address=(empty($instance['address'])) ? '&nbsp' : $instance['address'];
			$contact=(empty($instance['contact'])) ? '&nbsp' : $instance['contact'];
			echo $before_title.esc_html("Contact Information").$after_title;
			echo '<p> Name : '.esc_html($name).'</p>';
			echo '<p> Address : '.esc_html($address).'</p>';
			echo '<p> Contact Number : '.esc_html($contact).'</p>';
			echo $after_widget;
		}
	}
?>
