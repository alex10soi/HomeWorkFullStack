<?php
session_start();

// The path to the users.json file where information about users and their personal data is stored
define('ACCOUNTS_FILE_PATH', '..' . DIRECTORY_SEPARATOR . 'json_saveFiles' . DIRECTORY_SEPARATOR . 'users');

$validation_rules = [
	'registration' => [
		['name' => 'chat_username', 'pattern' => '/^[^!@#$%&*]{2,}$/i'],
		['name' => 'password', 'pattern' => '/[\d\w!@#$%&*^]{8,}/']
	]
];

// Checks the method for transmitting the request and if this method is "post", then it calls the
// method for checking incoming information
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['registration_form'])){
		checkRegistraionForm($_POST);
	}
}


// Checks for the entered username and if there is such a name in the users.php file, loads the chat form,
// and if there is no such user or the password for this user was entered incorrectly, then returns the
// user to the registration form
function checkRegistraionForm($array_post){
	global $validation_rules;
	if(checkInputs($array_post, $validation_rules['registration'])){
		if(file_get_contents(ACCOUNTS_FILE_PATH . '.json')){
			$file = file_get_contents(ACCOUNTS_FILE_PATH . '.json');
			$file_arr = json_decode($file); 

			foreach ($file_arr as $index => $value) {		
				if($value->chat_username == $array_post['chat_username']){
					if($value->password == $array_post['password']){
						$_SESSION['pass_Error'] = '';
						header('Location: ../../chatWindow.php');
					}else{
						$_SESSION['pass_Error'] = 'show_Error';
						header('Location: ../../index.php');
					}
				}

				if($index == count($file_arr) - 1  && $value->chat_username != $array_post['chat_username']){
					saveAccountToFile($array_post, $file_arr);
				}
			}
		}
	}
}


// Checks the validity of the input name and password.
function checkInputs ($array_post, $registration){
	$result = true;
	foreach ($registration as $input) {
		$name = $input['name'];
		$array_post[$name] = test_input($array_post[$name]);
		$_SESSION['flag'][$name] = isset($array_post[$name]) ? preg_match($input['pattern'], $array_post[$name]) : false;
		if($_SESSION['flag'][$name]){
			$_SESSION[$name] = $array_post[$name];
		}else{
			$result = false;
			$_SESSION[$name] = '';
		}
	}
	return $result;
}

// Saves the new user to the users.php file
function saveAccountToFile ($array_post, $file_arr) {
	$newUser = (object) array('chat_username' => $array_post['chat_username'], 
								  'password' => $array_post['password']);

	array_push($file_arr, $newUser);
	$file = fopen(ACCOUNTS_FILE_PATH . '.json', 'w');
	fwrite($file, json_encode($file_arr));
	fclose($file);
	$_SESSION['pass_Error'] = '';
	header('Location: ../../chatWindow.php');
}

// Checks each $_POST variable with the test_input() function
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

