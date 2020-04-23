// Script for monitoring the chat form
$(document).ready(() => {
	$('#chat_window').text('');
	const chat = {
		userName: '', 
		// Chat update time in milliseconds
		timeUpdateChat: 2000, 
		// The time the database was last accessed.
		lastTimeUpdate: 0,
		// Array with user posts
		posts: []
	}

	getUserName();
	pullPosts();
	setInterval(pullPosts, chat.timeUpdateChat);


	function getUserName () {
		$.post('../../../Chat-MySQL/resources/php/chat.php', {get_username: chat.userName},
		  function(data) {
				chat.userName = data;
			}
		);
	}

	// Publish posts by displaying them. While controlling the visibility of
	// the last published posts, by shifting the message history to the last post.
	function publishPosts(post) {
		$('.chat_window').html($('.chat_window').html() + post); 
		$('.chat_window').scrollTop($('.chat_window')[0].scrollHeight);
		$("#chat_message").val('');
	}

	// It makes a query to the database for new messages, and if any,
	// then calls a method for preparing messages for printing.
	function pullPosts() {
		$.post('../../../Chat-MySQL/resources/php/chat.php', {lastTimeUpdate: chat.lastTimeUpdate}, 
			function(data) {
				data = JSON.parse(data);
				if (!data.length) {
          return;
        }
				chat.lastTimeUpdate = data.shift();
				chat.posts = data;
				prepareForPublication();
			}
		);
	}

	// Checks for smiles in incoming information and changes emoticons to emoji
	function checkSmiles(message) {
		// Emoji Insertion Option
		message = message.replace(/:\)/g, '&#128522;'); 
		message = message.replace(/:\(/g, '&#128553;');
		// The commented-out option for inserting images is "Smile" and "Sadness".
		// value = value.replace(/:\)/g, '<img src="../images/smiley_PNG36230.png" alt="Image of smile">'); 
		// value = value.replace(/:\(/g, '<img src="../images/smiley_PNG198.png" alt="picture of sadness">');
		return message;
	}

	// Prepare posts for printout.
	function prepareForPublication() {
		if (!chat.posts.length) {
			return;
		}
    let message = '';
		let textPosts = '';
		chat.posts.forEach(function (post) {
			message = checkSmiles(post.message);
  		textPosts += `<p class="${new Date()
				.getTime()}">[${post.time}] <b>${post.chat_username}</b>: ${message}</p>`; 	
  	});
  	publishPosts(textPosts);
	}


	// Sets listeners to the Send message button in a chat when a 
	// click is triggered and the Enter button is pressed
	$('#send_message').on({
		'click': (e) => {
			checkMessage(e);
		},
		'keydown': (e) => {
			if (e.which == 13) {
				checkMessage(e);
			}	
		}
	});

	setInterval(messageRefresh, 5000);

	// Checks if there is a message at all
	function checkMessage (e) {
		e.preventDefault();
		const message = $('#chat_message').val();
		if (message.length != 0) {
		  sendMessage(message);
		}
	}

	// Sends a message
	function sendMessage (message) {   
		$.ajax({
			type: 'POST',
			url: '../../../Chat-MySQL/resources/php/chat.php',
			data: {'message' : '' + message, 'userName': chat.userName},
			context: $('#chat_window'),
			error: function () {
				console.log('Server fail');
			},
			success: function (data) {}
		});
	}

	// Clears the chat window from messages that arrived more than an hour ago 
	function messageRefresh () {
		const oneHour = 3600;  // Time in seconds
		const oneSecond = 1000;  // Time in milliseconds
		const currentTime = ((new Date().getTime()) / oneSecond); // Current time in seconds
		const arr_messages = $('#chat_window>p');

		$.each(arr_messages, (index, value) => {
			if ((value.className / oneSecond) < (currentTime - oneHour)) {
				$('.' + value.className).fadeOut('slow');
			}
		});
	}

});


