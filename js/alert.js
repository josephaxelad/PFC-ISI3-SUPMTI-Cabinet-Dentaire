jQuery(function ($) {
	var alert = $('#alert-1');
	if(alert.length > 0){
		alert.hide().slideDown(500).delay(3000).slideUp();
	}
});