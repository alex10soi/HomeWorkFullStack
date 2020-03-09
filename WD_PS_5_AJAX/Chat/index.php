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
    <div class='registration_wrap'>
      <div class="registration_block">
        <form id="registration_form" 
              class="regitration_form" 
              name="registration_form" 
              action="resources/php/authorization.php" 
              method="post">
          <div class="chat_name">Easy Chat</div>
          <div class="chat_inputs">
            <label for="userName">Enter your name</label>
            <input type="text" id="userName" class="chat_userName" name="chat_username" required>
            <label for="userPassword">Enter your password</label>
            <input type="password" id="userPassword" class="chat_userPassword" name="password" required>
            <div id="pass_Error" class="<?= !empty($_SESSION['pass_Error']) ? $_SESSION['pass_Error'] : 'hide_Error' ?>">
              Incorrect login or password. Try again
            </div>
            <!-- <div id="emptyFields" class="hideError">You must fill in all fields</div> -->
            <!-- <div class="chat_buttonContainer"> -->
            <button type="submit" id="enterSubmit" class="chat_enterSubmit">Submit</button>
            <div class="chat_shadow"></div>
            <input type="hidden" name="registration_form">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src='javaScript/indexScript.js'></script>
</body>
</html>