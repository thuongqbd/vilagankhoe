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
	if ($("#camon-fb").length) {
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
				updateCounter(response);
				//jQuery('#concurred_count').text(numeral(response).format('0,0'));
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
	if (jQuery("#concurred_count").length){
		jQuery('#concurred_count').counterUp({
				delay: 5, // the delay time in ms
				time: 500 // the speed time in ms
			});
		setTimeout(function(){ updateCounter(parseInt(jQuery('#concurred_count').text()),true);}, 1000);
		
		/*
		if(jQuery('#concurred_count').text() == '0'){
			jQuery('#concurred_count').text('0000');
		}else{
			jQuery('#concurred_count').counterUp({
				delay: 5, // the delay time in ms
				time: 500 // the speed time in ms
			});
		}
		*/
	}
	jQuery('.gallery-caption').hover(function(event){
		jQuery(this).addClass('hover');
	},function(event){
		jQuery(this).removeClass('hover');
	});
	jQuery('.gallery-caption').click(function(event){
		event.preventDefault();
		if(jQuery(this).hasClass('hover')){
			var item = jQuery(this).closest('.gallery-item');
			if(item.length){
				var link = item.find('a');
				if(link.length)
					window.location.href = link.attr('href');
			}
		}else{
			jQuery(this).addClass('hover');
		}
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

function updateCounter(concurred_count,first) {
    //var concurred_count = parseInt(jQuery('#concurred_count').text()),
    var    filler = '';
    if (concurred_count > 0 && concurred_count < 1000) {
        if (concurred_count < 10) {
            filler = '000';
		} else if (concurred_count < 100 && concurred_count >= 10) {
            filler = '00';
        } else if (concurred_count < 1000 && concurred_count >= 100) {
            filler = '0';
        }
        jQuery("#concurred_count").text(filler + concurred_count);
    } else if (concurred_count >= 1000){
		jQuery("#concurred_count").text(numeral(concurred_count).format('0,0'));
		
	}else{
        jQuery("#concurred_count").text('0000');
    }
}



