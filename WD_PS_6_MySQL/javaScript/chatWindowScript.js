$(document).ready(() => {
	$('#chat_window').text('');

	$('#send_message').on({
		'click': (e) => {
			runApp(e);
		},
		'keydown': (e) => {
			if(e.which == 13){
				runApp(e);
			}	
		}
	});

	setInterval(messageRefresh, 5000);
});


function runApp (e) {
	e.preventDefault();
	const message = getMessage();
	if(message.length != 0){
	    sendRequest(message);
	}
}


// Captures a new user message from the input field and returns its value
function getMessage () {
	return $('#chat_message').val();
}

// Sends a request using ajax
function sendRequest (message) {
	$.ajax({
		type: 'POST',
		url: 'resources/php/chat.php',
		data: {"message" : '' + message},
		context: $('#chat_window'),
		error: function () {
			console.log('Server fail');
		},
		success: function (data) {
			let response = JSON.parse(data);
			response = checkSmiles(response);
			let textResponse = '';
			$.each(response, (index, obj)=> {
				textResponse += `<p class="${new Date().getTime()}">[${obj.time}] <b>${obj.chat_username}</b>: ${obj.message}</p>`;
			});

			$(this).html($(this).html() + textResponse); 
			
			// This code governs message history "floating up"
			$(window).on('click',() => {
				 $(this).scrollTop(document.getElementById('chat_window').scrollHeight);
			});
			$(window).trigger("click");
			$("#chat_message").val('');
		}
	});
}

// Checks for smiles in incoming information and changes emoticons to emoji
function checkSmiles (data) {
	$.each(data, (index, obj)=> {
		let value = obj.message;

		// Emoji Insertion Option
		value = value.replace(/:\)/g, '&#128522;'); 
		value = value.replace(/:\(/g, '&#128553;');
		// The commented-out option for inserting images is "Smile" and "Sadness".
		// value = value.replace(/:\)/g, '<img src="../images/smiley_PNG36230.png" alt="Image of smile">'); 
		// value = value.replace(/:\(/g, '<img src="../images/smiley_PNG198.png" alt="picture of sadness">');
		obj.message = value;
	});
	return data;
}


// Clears the chat window from messages that arrived more than an hour ago 
function messageRefresh () {
	const oneHour = 3600;  // Time in seconds
	const oneSecond = 1000;  // Time in milliseconds
	const currentTime = ((new Date().getTime()) / oneSecond); // Current time in seconds
	const arr_messages = $('#chat_window>p');

	$.each(arr_messages, (index, value) => {
		if((value.className / oneSecond) < (currentTime - oneHour)){
			$('.' + value.className).fadeOut('slow');
		}
	});
}