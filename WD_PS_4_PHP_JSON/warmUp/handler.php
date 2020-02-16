<?php 
session_start();
include 'block_functions.php';

//Executes code with the corresponding passed value after submitting the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['task'])) {
  	$number = $_POST['task'];
  	if($number  == '1'){
  		$_SESSION['taskResult_1'] = countSumNumbers();
  	}elseif($number  == '2'){
  		$_SESSION['taskResult_2'] = countSumNumbers_2('/[2|3|7]$/');
  	}elseif($number  == '4'){
          $boardValue =  mb_strtolower($_POST['boardValue'], 'UTF-8');
  		if(preg_match('/\d+[x]\d+/', $boardValue)){
  			$arrayStr = explode("x", trim($boardValue));	
  		$x = $arrayStr[0];
  		$y = $arrayStr[1];
  		}

  		$_SESSION['taskResult_4'] = drawChessBoard($x, $y);
  	}elseif($number  == '5'){
  		$_SESSION['taskResult_5'] = getSumEnteredNumber($_POST['value']);
  	}elseif($number  == '6'){
  		$_SESSION['taskResult_6'] = getTaskResult_6();
  	}elseif($number  == '8'){
		if($_POST['value'] == '') {
			$_SESSION['taskResult_8'] = '</br>Lines = 0 </br> Letters = 0 </br> Spaces = 0';
		}else{
  			$_SESSION['taskResult_8'] = getTaskResult_8($_POST['value']);
  		}
  	}
  }

  //Task 3: Writes a file to the specified folder on the server. Restricts writing files if they are not with similar extensions (jpg, jpeg, png, gif). and displays a list of all the files in the specified folder on the screen.
  if( isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name'] !== ''){
  	$target_dir = 'uploads/';
  	if(!file_exists($target_dir)){
  		mkdir($target_dir);
  	}
  	$target_path = $target_dir . basename($_FILES['uploadFile']['name']);
  	$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
  	if (file_exists($target_path)) {
      $_SESSION['taskError_3'] = "Sorry, file already exists.";
      header('Location: index.php');
  	}

  	// Allow certain file formats
  	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  		&& $imageFileType != "gif") {
  	    $_SESSION['taskError_3'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  	    header('Location: index.php');
  	}
  	
    move_uploaded_file($_FILES['uploadFile']['tmp_name'], $target_path);  
    $_SESSION['taskResult_3'] = getListOfFiles();
    $_SESSION['taskError_3'] = '';    
	}else{
		$_SESSION['taskResult_3'] = '';
		$_SESSION['taskError_3'] = '<span class="error">Select file to upload</span>'; 
	}
}


header('Location: index.php');

?>