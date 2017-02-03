jQuery(document).ready(function(){
		jQuery("#submit").on('click',function(){
			var name=jQuery("#name").val();
			var address=jQuery("#address").val();
			var city=jQuery("#city").val();
			var phone=jQuery("#phone").val();
			var arr={"name":name,"address":address,"city":city,"phone":phone};
			var data=JSON.stringify(arr);
			jQuery.ajax({
				url: "<?php echo admin_url('admin-ajax.php')?>",
				type:"POST",
				data:{'action':'insert_data','name':name},	
				success:function(){
				  	jQuery("#name").val("");
				  	jQuery("#address").val("");
				  	jQuery("#city").val("");
				  	jQuery("#phone").val("");
				}
			});
		});
});