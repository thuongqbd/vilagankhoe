$ = jQuery;
var windowWidth;
jQuery(document).ready(function () {
	windowWidth = $(window).width();
	$(window).resize(function(){
		windowWidth = $(window).width();			
	});
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
		if(windowWidth>=750){
			var dialog = $("#camon-fb").dialog({
				resizable: true,
				autoOpen: false,
				height: 250,
				width: 600,
				modal: true
			});
		}else{
			var dialog = $("#camon-fb").dialog({
				resizable: true,
				autoOpen: false,					
				modal: true
			});
		}
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
			resizable: true,
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
			resizable: true,
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
	if(jQuery('#avatar').length){
		var croppicHeaderOptions = {
				// uploadUrl:'img_save_to_file.php',
				cropData:{
					action: 'upload_avatar',
					security: MyAjax.security
				},
				cropUrl:MyAjax.ajaxurl,
				customUploadButtonId:'cropContainerHeaderButton',
				modal:false,
				enableMousescroll:true,
				processInline:true,
				outputUrlId:'cropOutput',
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){
					this.cropControlRemoveCroppedImage.replaceWith('<i class="cropControlDownloadCroppedImage"></i>');
//					jQuery('#cropOutput').val();
					console.log('onAfterImgCrop',this,jQuery('#cropOutput').val()) ;
				},
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}	
		var croppic = new Croppic('croppic', croppicHeaderOptions);
		
		jQuery('#croppic').on('click','.cropControlDownloadCroppedImage',function(){
			var cropOutput = jQuery('#cropOutput').val();
			if(cropOutput){
				var data = {
					action: 'download_avatar',
					security: MyAjax.security,
					pic_url:cropOutput
				};
				jQuery.get(MyAjax.ajaxurl, data, function (response) {

				});
			}
			
		});
		
	}
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



