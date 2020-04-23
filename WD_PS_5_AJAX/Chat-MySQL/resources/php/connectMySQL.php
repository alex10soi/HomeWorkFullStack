<?php
	// Connects data related to server access data (server name, username, password).
	require 'configDataServer.php';	

	// It connects to MySQL 'easyChat' database and executes the query inserting the collected
	// information from the user into the tables.
	// $sql_request - sql query. 
	class DBConnect {
	  
	  // Establishes a connection to the 'easychat' database and returns it  
	  function connectToDB() {
			$conn = mysqli_connect(SERVER_NAME, USER_NAME, MYSQL_PASSWORD, 'easyChat');
			if (mysqli_connect_errno()) {
				printf("Failed to connect: %s\n", mysqli_connect_error());
				exit();
			}
			return $conn;
		}
	}
?>