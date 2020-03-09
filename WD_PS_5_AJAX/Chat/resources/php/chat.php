<?php
session_start();

// The path to the file with user messages.
define('FILE_PATH', '..' . DIRECTORY_SEPARATOR . 'json_saveFiles' . DIRECTORY_SEPARATOR . 'messages.json');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$message =  $_POST['message'];

	$file = file_get_contents(FILE_PATH);
	if($file){
		$file = json_decode($file);
		date_default_timezone_set('Europe/Athens');
	    $currentTime = date("H:i:s");
	    $sec = strtotime($currentTime);
		$key = $_SESSION['chat_username'];

		// If the user already exists and is added to the massege.json file, then add to
		// file the new message sent, otherwise create a new user with
		// information about time, chat_username, message and write to message.json file
		if($file[0]->$key){
			$newObjMessage = getNewObjMessage($message, $currentTime, $key, $sec);
			array_push($file[0]->$key, $newObjMessage);
			saveFile ($file); 
			sendResponse($newObjMessage); 
		}else{
			$newObjMessage = getNewObjMessage($message, $currentTime, $key, $sec);
			$file[0]->$key = [$newObjMessage];
			saveFile ($file);
			sendResponse($newObjMessage); 
		}
	}
} else {
	return;
}



// Saves a file with a new message 
function saveFile ($newFile) {
	$file = fopen(FILE_PATH, 'w');
	fwrite($file, json_encode($newFile));
	fclose($file);
	$myfile = json_decode(file_get_contents(FILE_PATH));
}

// Creates a new object for a new message sent by user
function getNewObjMessage($message, $currentTime, $chat_username, $sec){
	$newObjMessage = (object) array('time' => $currentTime,
									'sec' => '' . $sec, 
								    'chat_username' => $chat_username,
								    'message' => $message);
	return $newObjMessage;
}


// Get an array of all messages sent in the last hour and send
// result for ajax request
function sendResponse ($newMessage){
	$arrayMessage = [];
	array_push($arrayMessage, $newMessage);
	echo json_encode($arrayMessage, JSON_UNESCAPED_UNICODE);
}

