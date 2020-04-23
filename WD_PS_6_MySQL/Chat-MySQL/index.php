<?php
  require_once 'public/content/rainbowLine.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Easy Chat</title>
  <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
  <div class="chat">
    <div class='color_lines'>
      <?= drawColorLines(); ?>
    </div>
    <?php require_once 'public/content/loginForm.php'; ?>
  </div>
</body>
</html>


