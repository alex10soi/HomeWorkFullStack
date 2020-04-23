<!-- Chat registration form template -->
<div class="registration_block">
  <form id="registration_form" 
        class="regitration_form" 
        name="registration_form" 
  >
    <div class="chat_name">Easy Chat</div>
    <div class="chat_inputs">
      <label for="userName">Enter your name</label>
      <input type="text" id="userName" class="chat_userName" name="chat_username" required>
      <div id="name_Error"></div>
      <label for="userPassword">Enter your password</label>
      <input type="password" id="userPassword" class="chat_userPassword" name="password" required>
      <div id="pass_Error" ></div>
      <button type="submit" id="enterSubmit" class="chat_enterSubmit">Submit</button>
      <div class="chat_shadow"></div>
    </div>
  </form>
</div>
<script src='public/js/loginForm.js'></script>
