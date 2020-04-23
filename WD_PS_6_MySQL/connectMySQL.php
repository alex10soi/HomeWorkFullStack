<?php
	require 'Chat-MySQL/resources/php/configDataServer.php';
	createDB();

	// Creates a database called 'easyChat' if it does not exist and two tables 
	// 'registrInfo' (created to store the registration data of chat users) and 
	// 'chatInfo' (to store user correspondence).
	function createDB () {
		$conn = mysqli_connect(SERVER_NAME, USER_NAME, MYSQL_PASSWORD);
		printError ($conn);
		$sql = "CREATE DATABASE IF NOT EXISTS `easyChat` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
		if (mysqli_query($conn, $sql)) {
			echo "The database was created successfully <br>";
		} else {
			echo 'Error creating database "easyChat"';
			exit;
		}

		$conn = mysqli_connect(SERVER_NAME, USER_NAME, MYSQL_PASSWORD, 'easyChat');
		printError ($conn);
		$sql = "CREATE TABLE IF NOT EXISTS `registrInfo` (
			id INT(11) unsigned NOT NULL AUTO_INCREMENT,
			chat_username VARCHAR(50) NOT NULL,
			pass VARCHAR(70) NOT NULL,
			PRIMARY KEY (id)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8;";
		if (mysqli_query($conn, $sql)) {
			echo "The table 'registrInfo' was created successfully <br>";
		} else {
			echo 'Error creating table "registrInfo"';
			exit;
		}

		$sql = "CREATE TABLE IF NOT EXISTS `chatInfo` (
			id INT(11) unsigned NOT NULL AUTO_INCREMENT,
			chat_username VARCHAR(50) NOT NULL,
			time VARCHAR(20) NOT NULL,
			sec INT(11) unsigned NOT NULL,
			message text NOT NULL,
			PRIMARY KEY (id)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8;";
		if (mysqli_query($conn, $sql)) {
			echo "The table 'chatInfo' was created successfully <br>";
		} else {
			echo 'Error creating table "chatInfo"';
			exit;
		}

		mysqli_close($conn);
	}

	// Prints an error message if the connection to MySQL fails.
	function printError ($link) {
		if (!$link) {
			printf("Failed to connect: %s\n", mysqli_connect_error());
			exit();
		}
	}
?>