<?php
	session_start();
	// The number of points participating in the vote
	$_SESSION['COUNT_IMAGES'] = 3;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/styles.css">
	<title>Voting</title>
</head>
<body>
	<div class="mainContent">
		<div class="questionForVoting">Which one do you like better?</div>
		<div class="images_conteiner">
			<div class="image image_1"></div>
			<div class="image image_2"></div>
			<div class="image image_3"></div>
		</div>
		<div class="voting">
			<form action="voting_handler.php" method="post">
				<div class="images_conteiner">
					<?php 
						$count = 1;
						while($count <= $_SESSION['COUNT_IMAGES']){
							$listInput .= '<input class="votingItem" type="submit" name="votingItem" value="' . $count . '">';
							$count++; 
						}
						echo $listInput;
					?>
			  </div>
			</form>
		</div>
      <div class="display_pieChart">
      	<p class="messegeOfPieChart">
      	 	<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?>
          <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : '' ?>
        </p>
          <button class="draw_pieChart"><a href="pieChart.php">Display pieChart</a></button>
      </div>
	</div>
</body>
</html>