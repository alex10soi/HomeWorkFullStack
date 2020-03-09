<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Easy Chat</title>
  <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="chat">
    <div class='color_lines'>
      <div class="chat_color_line line0"></div>
      <div class="chat_color_line line1"></div>
      <div class="chat_color_line line2"></div>
      <div class="chat_color_line line3"></div>
      <div class="chat_color_line line4"></div>
      <div class="chat_color_line line0"></div>
      <div class="chat_color_line line1"></div>
      <div class="chat_color_line line2"></div>
      <div class="chat_color_line line3"></div>
      <div class="chat_color_line line4"></div>
    </div>
    <div class="chat_logOut"><a href="index.php">Log out</a></div>
    <div class='registration_wrap'>
      <div class="registration_block">
        <form id="registration_form" class="regitration_form" method="post">
          <div class="chat_name">Easy Chat</div>
          <div id="chat_window" class="chat_window"></div>
          <div class="chat_inputs_message">
            <!-- <textarea 
              id="chat_field" 
              class="chat_area" 
              name="chat_history" 
    
              readonly>
            </textarea>  -->
            <div class="chat_inputs_message_group"> 
              <input type="text" id="chat_message" class="chat_message" name="message">
              <button type="submit" id="send_message" class="send_message">Send</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src='javaScript/chatWindowScript.js'></script>
</body>
</html>