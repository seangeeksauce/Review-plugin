$(function() {
	$('#form-submission-splash').click(function() {
		event.preventDefault();

		var nameTest = $('input[name=name]').val().length > 2;
		var emailTest = /.+@.+\..+/.test($('input[name=email]').val());
		var phone = $('input[name=custom_Phone]').val();

		if (!nameTest)
			$('input[name=name]').css('border-color', '#ff0000');
		else
			$('input[name=name]').css('border-color', '#012a51');

		if (!emailTest)
			$('input[name=email]').css('border-color', '#ff0000');
		else
			$('input[name=email]').css('border-color', '#012a51');

		if (phone.length < 9)
			$('input[name=custom_Phone]').css('border-color', '#ff0000');
		else
			$('input[name=custom_Phone]').css('border-color', '#012a51');

		if (nameTest && emailTest && phone.length >= 9 ) {
			var cookieTime = $('input[name=cookieTime]').val();
			var cookieName = $('input[name=cookieName]').val();
			setCookie(cookieName,1,cookieTime);
			document.getElementById("form-splash-pages").submit();
		}
	});

});