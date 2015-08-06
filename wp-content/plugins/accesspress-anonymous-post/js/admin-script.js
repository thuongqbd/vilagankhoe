(function ($) {
	$(function () {
		//All the backend js for the plugin 

		/*
		 Settings Tabs Switching 
		 */
		$('.ap-tabs-trigger').click(function () {
			$('.ap-tabs-trigger').removeClass('ap-active-tab');
			$(this).addClass('ap-active-tab');
			var board_id = 'board-' + $(this).attr('id');
			$('.ap-tabs-board').hide();
			$('#' + board_id).show();
		});
		//admin email addition
		$('#ap-admin-email-add-trigger').click(function () {
			var email_counter = $('#ap-admin-email-counter').val();
			if (email_counter < 3)
			{
				email_counter++;
				var email_field_html = '<div class="ap-each-admin-email"><input type="text" name="admin_email_list[]" placeholder="" data-email-count="' + email_counter + '"/><span class="ap-remove-email-btn">X</span></div>';
				$('.ap-admin-email-list').append(email_field_html);
				$('input[data-email-count="' + email_counter + '"]').focus();
				$('#ap-admin-email-counter').val(email_counter);
			}
			else
			{
				$('.ap-admin-email-add-btn').hide();
			}
		});

		//removing admin email field
		$('.ap-admin-email-list').on('click', '.ap-remove-email-btn', function () {
			var email_counter = $('#ap-admin-email-counter').val();
			email_counter--;
			$('#ap-admin-email-counter').val(email_counter);
			if (email_counter < 3)
			{
				$('.ap-admin-email-add-btn').show();
			}
			$(this).parent().remove();
		});

	});
}(jQuery));
