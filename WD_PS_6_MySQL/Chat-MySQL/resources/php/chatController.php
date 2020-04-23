<?php
require 'connectMySQL.php';

/**
 *  A class for controlling the connection to the database, recording 
 *  new messages, checking the password and user in the database, as 
 *  well as selecting messages for requests during the chat.
 *  Chat is extended from the DBConnect class, which connects to the 
 *  database
 */
class Chat extends DBConnect {
  // Open Database Connection
	public $conn;
    /**
     * Constructor function
     */
  public function __construct() {
    $this->conn = $this->connectToDB();  
  }

  // Selects messages from the database according to parameter $lastTimeUpdate
  // (the time the database was last accessed.).
  public function pullNewMessages($lastTimeUpdate) {
    $messages = [];
    $request = "SELECT `time`, `sec`, `chat_username`, `message` FROM `chatinfo` WHERE `sec` > '$lastTimeUpdate' ORDER BY `id`";
    $result = mysqli_query($this->conn, $request);
    if (mysqli_num_rows($result)) {
      while ($row = mysqli_fetch_assoc($result)) {
        array_push($messages, $row);
      }
      mysqli_free_result($result); 
    } 
    return $messages;
  }

  // Adds new user messages to the database
  public function addNewMessage($chat_username, $time, $sec, $message) {
    $request = "INSERT INTO `chatinfo` (`chat_username`, `time`, `sec`, `message`) 
      VALUES ('$chat_username', '$time', '$sec', '$message')";
    mysqli_query($this->conn, $request);
  }
}