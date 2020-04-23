<?php
session_start();
require 'chatController.php';

// The path to the file with user messages.
define('FILE_PATH', '..' . DIRECTORY_SEPARATOR . 'json_saveFiles' . DIRECTORY_SEPARATOR . 'messages.json');

// One hour expressed in seconds
define('ONE_HOUR', 3600);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Checks the availability of posts in the database for the last hour
	// at the start of the chat, or new posts in the chat process and returns 
	// data to the request
	if (isset($_POST['lastTimeUpdate'])) {
		$result = array();
	
		if (intval($_POST['lastTimeUpdate']) === 0) {
			$_SESSION['lastTimeUpdate'] = round(microtime(true) - ONE_HOUR);
		} else {
			$_SESSION['lastTimeUpdate'] = intval($_POST['lastTimeUpdate']);
		}
		$chat = new Chat();
		$messages = $chat->pullNewMessages($_SESSION['lastTimeUpdate']);
		$chat->conn->close();
		if (count($messages) > 0) {
			foreach ($messages as $index => $value) {
				$postTime = $messages[$index]['time'];
				$sec = $messages[$index]['sec'];
				$username = $messages[$index]['chat_username'];
				$message = $messages[$index]['message'];
				$objMessage = getNewObjMessage($message, $postTime, $username, $sec);
				array_push($result, $objMessage);
				if ((count($messages) - 1) === $index) {
					array_unshift($result, $sec);
				}
			}
		}
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit();
	}

	// Returns username on request
	if (isset($_POST['get_username'])) {
		echo $_SESSION['user_name'];
		exit();
	}

	// Adds a new message to the database.
	if (isset($_POST['message'])) {
		$message = $_POST['message'];
		date_default_timezone_set('Europe/Athens');
	  $currentTime = date("H:i:s");
	  $sec = strtotime($currentTime);
		$userName = $_POST['userName'];
		$chat = new Chat();
		$chat->addNewMessage($userName, $currentTime, $sec, $message);
		$chat->conn->close();

		// Write message to file called 'messages.json'
		// $file = file_get_contents(FILE_PATH);
		if ($file = file_get_contents(FILE_PATH)) {
			$file = json_decode($file);
			$newObjMessage = getNewObjMessage($message, $currentTime, $userName, $sec);
			array_push($file, $newObjMessage);
			saveFile ($file);
		}
	} else {
		exit();
	}
}

// Saves a file with a new message 
function saveFile ($newFile) {
	$file = fopen(FILE_PATH, 'w');
	fwrite($file, json_encode($newFile));
	fclose($file);
}

// Creates a new object for a new message sent by user
function getNewObjMessage ($message, $currentTime, $chat_username, $sec) {
	$newObjMessage = (object) array('time' => $currentTime,
																	'sec' => '' . $sec, 
																  'chat_username' => $chat_username,
																  'message' => $message);
	return $newObjMessage;
}
