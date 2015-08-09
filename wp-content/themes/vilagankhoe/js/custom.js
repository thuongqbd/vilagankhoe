jQuery(document).ready(function(){
//	if(jQuery('.scrollbar-inner').length)
//		jQuery('.scrollbar-inner').scrollbar();
	
	jQuery('#ewd-feup-register-input-4').change(function(){
		if(jQuery(this).val() > 99){
			jQuery(this).val(99);
		}else if(jQuery(this).val() <= 0){
			jQuery(this).val(1);
		}
	});
});