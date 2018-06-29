(function($) {

$.fn.validation = function() {		

    var error = 0;
		
	$('.required-field', this).each(function() {
		var input = $(':input', this).attr("value");
		if (input == "") {
			$('span.error-message', this).remove();
			$(this).append('<span class="error-message"><span class="error"></span></span>');
			$('span.error', this).html('Please fill in this mandatory field.');
			$(':input', this).addClass("error-highlight");
			error++;
		} else {
			$('span.error-message', this).remove();
			$(':input', this).removeClass("error-highlight");
		}
	});
	
	if (error == 0) {
		return true;
	} else {
		return false;
	}
};

})(jQuery);

$(document).ready(function() {
	$("#myform").submit(function () {
		return $(this).validation();
	});
});