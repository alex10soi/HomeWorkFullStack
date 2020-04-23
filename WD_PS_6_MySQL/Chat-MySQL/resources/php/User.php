<?php
require 'connectMySQL.php';

/**
 *  The class manages the user by checking it in the database, checks 
 *  its registration data, if the current user is not in the database, 
 *  saves it to the database. Class User extended from DBConnect class
 *  to connect to database
 */
class User extends DBConnect {
  // Open database connectio
	public $conn;
  // $ UserExists value in the true position - the user 
  // exists in the database, false - this user does not exist in the database
	private $userExists = false;
  // The correctness of the user password. The value true - the password 
  // is the correct username, false - no.
	public $correctPass = true;

  // Initializes User Properties
  public function __construct ($name, $pass) {
    $this->conn = $this->connectToDB();
    $this->userExists = $this->checkUserInDB ($name, $pass);
    if (!$this->userExists) {
    	$this->saveToDB($name, $pass);
    }
  }

  // Checks user in database
  function checkUserInDB ($name, $pass) {
  	$sql_request = "SELECT `pass` FROM `registrinfo` WHERE `chat_username` = '$name'";
  	$result = mysqli_query($this->conn, $sql_request);
  	if (mysqli_num_rows($result)) {
  		$row = mysqli_fetch_assoc($result);
  		$this->correctPass = password_verify($pass, $row['pass']);
      mysqli_free_result($result); 
  	} else {
  		return false;
  	}
  	return true;
  }

  // Saves a new user to the database
  function saveToDB ($name, $pass) {
  	$password_hash = password_hash($pass, PASSWORD_DEFAULT);
  	$sql_requst = "INSERT INTO `registrinfo` (`chat_username`, `pass`) VALUES ('$name', '$password_hash')";
  	$this->conn->query($sql_requst);
  }
}