// Script to control chat registration form
$(document).ready(function() {	
	// Installed listening for loss of focus and keyup in input
	let name, pass, inp;
	$('input').focusout(function() {
		inp = $(this);
		if (inp.val().length === 0) {
			inp.addClass('error');
		} else {
			inp.removeClass('error');
		}
	});

	$('input').keyup(function() {
		inp = $(this);
		if (inp.hasClass('chat_userName')) {
			if (inp.val().length > 1) {
				inp.removeClass('error');
			}
			name = inp.val();
		} else if (inp.hasClass('chat_userPassword')) {
			if (inp.val().length >= 8) {
				inp.removeClass('error');
			}
			pass = inp.val();
		}
	});


	// Submit the form and receive errors made by the user when entering 
	// user data, which displays or loads the chat form.
	$('form').submit(function (e) {
		e.preventDefault();
		let dataUser = {name: name,	pass: pass};
		const path = '../../../Chat-MySQL/resources/php/dataValidator.php';
		$.post(path, dataUser, function (result, textStatus, xhr) {
			$('#name_Error, #pass_Error').html('');
			try {
	      data = $.parseJSON(result);
	      if (data.name.length > 0) {
					$('#userName').addClass('error');
					$('#name_Error').removeClass('hide_Error').addClass('show_Error').text(data.name);
				}
				if (data.pass.length > 0) {
					$('#userPassword').addClass('error');
					$('#pass_Error').removeClass('hide_Error').addClass('show_Error').text(data.pass);
				}
	    } catch (error) {
				$('.registration_block').remove();
				$('.chat').html($('.chat').html() + result);
	    }
		});
	});	
});


