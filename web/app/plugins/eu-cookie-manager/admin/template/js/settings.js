jQuery(document).ready(function($){
	$('.color-field').wpColorPicker();
	$('#outcss').click(function(){
		if($(this).is(':checked')) {
			$('tr.inner_css').hide();
		} else {
			$('tr.inner_css').show();
		}
	}); 
});