<?php
session_start();
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(isset($_POST['votingItem']) && !isset($_COOKIE['user'])){
			$cookie_name = "user";
			$cookie_value = "voted";
			setcookie($cookie_name, $cookie_value, time() + 30);
			$_SESSION['message'] = 'Thank you for voting. The next vote will open for you in 30 seconds';
			unset($_SESSION['error']);
			$filename = 'date.json';
			if(file_exists($filename)){
				$file = json_decode(file_get_contents($filename));
				$file->{'voting'}->{'House' . $_POST['votingItem']}++;
				file_put_contents($filename, json_encode($file));
			}else{
				$data = ['voting' => ['House1' => 0, 'House2' => 0, 'House3' => 0]];
				$data['voting']['House' . $_POST['votingItem']]++;
				file_put_contents($filename, json_encode($data));
			}
		}else{
			unset($_SESSION['message']);
			$_SESSION['error'] = '<span class="error">You have already voted</span>';
		}
	}
header('Location: index.php');
?>