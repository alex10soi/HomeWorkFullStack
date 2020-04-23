<?php
session_start();

// The path to the users.json file where information about users and their personal data is stored
define('ACCOUNTS_FILE_PATH', '..' . DIRECTORY_SEPARATOR . 'json_saveFiles' . DIRECTORY_SEPARATOR . 'users.json');

// Variable controlling the correctness of user data (username and password).
// Values ​​true - means the data is correct, false - accordingly, there are 
// errors in the data.
$correctDataUser = true;
// Array with errors in user data (username and password)
$error = ['name' => '', 'pass' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$dataUser = $_POST;
	$dataUser = test_input($dataUser);
	checkDataUser($dataUser);	
}

function checkDataUser ($dataUser) {
	global $correctDataUser, $error;
	$name = $dataUser['name'];
	$pass = $dataUser['pass'];

	if (iconv_strlen($name) > 25) {
		$error['name'] = 'Maximum length must be 25 characters';
		$correctDataUser = false;
	} elseif (iconv_strlen($name) <= 1) {
		$error['name'] = 'Minimum length must be 2 characters';
		$correctDataUser = false;		
	} elseif (!preg_match('/^\w+$/', $name)) {
		$error['name'] = 'Only alphanumeric names are allowed';
		$correctDataUser = false;
	} elseif ($name != strip_tags($name)) {
		$error['name'] = 'HTML tags are not allowed';
		$correctDataUser = false;
	}
	if (iconv_strlen($pass) < 8) {
		$error['pass'] = 'Minimum length password must be 8 characters';
		$correctDataUser = false;
	} elseif (iconv_strlen($pass) > 25) {
		$error['pass'] = 'Maximum length password must be 25 characters';
		$correctDataUser = false;				
	}

	if ($correctDataUser) {
		require 'User.php'; 
		$newUser = new User($name, $pass);
		$newUser->conn->close();
		if ($newUser->correctPass) {
			$_SESSION['user_name'] = $name;
			saveUserToFile($name, $pass); 
			header('Location: ../../../../../Chat-MySQL/public/content/chatForm.php');
			exit();
		} else {
			$error['pass'] = 'Wrong password';
			echo json_encode($error);
			exit();
		}
	} else {
		echo json_encode($error);
		exit();
	}
}

// Checks each $_POST variable with the test_input() function
function test_input ($data) {
	foreach ($data as $index) {
		$data[$index] = trim($data[$index]);
  	$data[$index] = stripslashes($data[$index]);
	} 
  return $data;
}

// Saves a new user to a file called  'users.json'
function saveUserToFile ($username, $pass) {
	$password_hash = password_hash($pass, PASSWORD_DEFAULT);
	$newUser = (object) array('chat_username' => $username, 
		'password' => $password_hash);
	if ($file_arr = file_get_contents(ACCOUNTS_FILE_PATH)) {
		$accounts_arr = json_decode($file_arr);
		array_push($accounts_arr, $newUser);
		$file = fopen(ACCOUNTS_FILE_PATH, 'w');
		fwrite($file, json_encode($accounts_arr));
		fclose($file);
	}
}
