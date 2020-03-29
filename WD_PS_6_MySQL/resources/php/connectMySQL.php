<?php
	// Data Required to Access MySQL Databases
	define('SERVER_NAME', '127.0.0.1:3306');
	define('USER_NAME', 'mysql');  // 
	define('MYSQL_PASSWORD', '');
	

	// Connecting to the database and creating the necessary tables for storing user registration 
	// information and information collected in the chat process.
	// $flag_str - indicates what information from what form came to save;
	// $sql_request - sql query. 
	function connect($flag_str, $sql_request){
		$sql = "CREATE DATABASE IF NOT EXISTS `easyChat` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
		$conn = mysqli_connect(SERVER_NAME, USER_NAME, MYSQL_PASSWORD);
		if (mysqli_connect_errno()) {
			printf("Не удалось подключиться: %s\n", mysqli_connect_error());
			exit();
		}
		
		mysqli_query($conn, $sql);
		$conn = mysqli_connect(SERVER_NAME, USER_NAME, MYSQL_PASSWORD, 'easyChat');
		if($flag_str === 'registrUserInfo'){
			$sql = "CREATE TABLE IF NOT EXISTS `registrInfo` (
				id INT(11) unsigned NOT NULL AUTO_INCREMENT,
				chat_username VARCHAR(50) NOT NULL,
				pass VARCHAR(70) NOT NULL,
				PRIMARY KEY (id)
			) ENGINE = MyISAM DEFAULT CHARSET = utf8;";
		}else{
			$sql = "CREATE TABLE IF NOT EXISTS `chatInfo` (
				id INT(11) unsigned NOT NULL AUTO_INCREMENT,
				chat_username VARCHAR(50) NOT NULL,
				time VARCHAR(20) NOT NULL,
				sec INT(11) unsigned NOT NULL,
				message text NOT NULL,
				PRIMARY KEY (id)
			) ENGINE = MyISAM DEFAULT CHARSET = utf8;";
		}
		
		mysqli_query($conn, $sql);
		mysqli_query($conn, $sql_request);
		mysqli_close($conn);
	}
?>