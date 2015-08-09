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
	jQuery('#btn-toihuongung').click(function(){
		var data = {
			action: 'huong_ung',
			security : MyAjax.security
		};

		jQuery.post(MyAjax.ajaxurl, data, function(response) {
			jQuery('#concurred_count').text(numeral(response).format('0,0'));
			alert('Got this from the server: ' + response);
		});
	});
});