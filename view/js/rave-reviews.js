jQuery(function() {

	var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	var content = document.getElementById('js-copy-content');

	var client = new ZeroClipboard(document.getElementById('js-copy-btn'));

	if (!isMobile) {
		client.on( "copy", function (event) {
			var clipboard = event.clipboardData;
			clipboard.setData( "text/plain", content.value );
		});
	}

	 jQuery("#js-copy-btn").on("tap click",function(){
	 	event.preventDefault();

			content.focus();
  			content.setSelectionRange(0,9999);		
	});

	jQuery('.dealer-reviews-submit').click(function() {
		event.preventDefault();

		var nameTest = jQuery('input[name=full_name]').val().length > 0;
		var emailTest = /.+@.+/.test(jQuery('input[name=email]').val());
		var phone = jQuery('input[name=phone]').val();
		var phonePass = false;
		var review = jQuery('.dealer-reviews-textarea').val().length > 0;

		if (!nameTest)
			jQuery('input[name=full_name]').css('border-color', '#ff0000');
		else
			jQuery('input[name=full_name]').css('border-color', 'green');

		if (!emailTest)
			jQuery('input[name=email]').css('border-color', '#ff0000');
		else
			jQuery('input[name=email]').css('border-color', 'green');

		if (phone.length <= 9)
			jQuery('input[name=phone]').css('border-color', '#ff0000');
		else {
			jQuery('input[name=phone]').css('border-color', 'green');
			phonePass = true;
		}

		if (!review)
			jQuery('.dealer-reviews-textarea').css('border-color', '#ff0000');
		else 
			jQuery('.dealer-reviews-textarea').css('border-color', 'green');

		if (nameTest && emailTest && phonePass && review ) 
			jQuery('#review-form').submit();
	});
});
