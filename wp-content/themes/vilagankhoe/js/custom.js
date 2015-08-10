$ = jQuery;
jQuery(document).ready(function () {
//	if(jQuery('.scrollbar-inner').length)
//		jQuery('.scrollbar-inner').scrollbar();

	jQuery('#ewd-feup-register-input-4').change(function () {
		if (jQuery(this).val() > 99) {
			jQuery(this).val(99);
		} else if (jQuery(this).val() <= 0) {
			jQuery(this).val(1);
		}
	});
	if ($("#camon-fb").length && $('#huongung').length) {
		var dialog = $("#camon-fb").dialog({
			autoOpen: false,
			height: 250,
			width: 600,
			modal: true
		});
		jQuery('#btn-toihuongung').click(function () {
			var data = {
				action: 'huong_ung',
				security: MyAjax.security
			};
			dialog.dialog("open");
			jQuery.post(MyAjax.ajaxurl, data, function (response) {
				jQuery('#concurred_count').text(numeral(response).format('0,0'));
			});
		});
//		$("#btn-toihuongung").button().on("click", function() {
//			dialog.dialog("open");
//		});
		$('.btn-close').click(function () {
			dialog.dialog("close");
		});
	}
	if ($("#dangky-test").length && $("#camon-dk").length) {
		var dialog2 = $("#camon-dk").dialog({
			autoOpen: false,
			width: 316,
			height: 290,
			modal: true
		});

		if ($("#ewd-feup-register-form-div").find(".success").length) {
			dialog2.dialog("open");
		}
		;
		$('.btn-close').click(function () {
			dialog2.dialog("close");
		});
	}
	if ($("#datcauhoi").length && $("#camon-dch").length) {
		var dialog3 = $("#camon-dch").dialog({
			autoOpen: false,
			width: 316,
			height: 290,
			modal: true
		});

		if ($(".ap-post-submission-message").length) {
			dialog3.dialog("open");
		}
		;
		$('.btn-close').click(function () {
			dialog3.dialog("close");
		});

	}
	jQuery('#btn-toihuongung').click(function () {
		var data = {
			action: 'huong_ung',
			security: MyAjax.security
		};

		jQuery.post(MyAjax.ajaxurl, data, function (response) {
			jQuery('#concurred_count').text(numeral(response).format('0,0'));
			alert('Got this from the server: ' + response);
		});
	});
	

});
function fbshareCurrentPage()
{
	var href = window.location.href;
	if (window.location.href.indexOf("localhost")) {
		href = 'http://vilagankhoe.vn/';
	}
	console.log(href);
	window.open("https://www.facebook.com/sharer/sharer.php?u=" + escape(href) + "&t=" + document.title, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
	$("#camon-fb").dialog('close');
	return false;
}



