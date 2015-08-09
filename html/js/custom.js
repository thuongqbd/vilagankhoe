//jQuery(document).ready(function() {
//	jQuery('.scrollbar-inner').scrollbar();
//});
$(function() {
	if ($("#camon-fb").length && $('#huongung').length) {
		var dialog = $("#camon-fb").dialog({
			autoOpen: false,
			height: 400,
			width: 960,
			modal: true
		});

		$("#btn-toihuongung").button().on("click", function() {
			dialog.dialog("open");
		});
		$('.btn-close').click(function() {
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

		$("#btn-dangky-test").on('click',function(event) {			
			event.preventDefault();			
			dialog2.dialog("open");
		});
		$('.btn-close').click(function() {			
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

		$("#btn-guicauhoi").on('click',function(event) {			
			event.preventDefault();			
			dialog3.dialog("open");
		});
		$('.btn-close').click(function() {			
			dialog3.dialog("close");
		});
	}

});