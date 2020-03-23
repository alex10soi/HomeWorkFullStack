<?php 

  // Task 1: Counts the sum of numbers from -1000 to 1000
  function countSumNumbers($x, $y){
    $result = 0;
    for ($i = $x; $i <= $y; $i++) { 
      $result += $i;
    }
    return $result;
  }

  // Task 2 Counts the sum of numbers from -1000 to 1000, summing only numbers that end in 2,3, and 7
  function countSumNumbers_2($regex, $x, $y) {
    $result = 0;
    for ($i = $x; $i <= $y; $i++) { 
      if(preg_match($regex, $i)){
        $result += $i;
      }
    }
    return $result;
  }

  // Task 3: Gets a list of downloaded files in a folder and generates html code to display this list on a screen
  function getListOfFiles(){
    $result = "";
    $directoryFiles = scandir("uploads/");
    $amount = count($directoryFiles);
    if($amount > 2){
      $result .= '<div class="listFile"><ul class="blue">'; 
      $r = 0;
      for ($i = 2; $i < $amount; $i++) { 
        $r++;
        if (preg_match("/(jpg|jpeg|png|gif)$/", $directoryFiles[$i])) {
          $result .= '<li><a href="uploads/'. $directoryFiles[$i] . '" download><img class="minIcon" src="uploads/'.
           $directoryFiles[$i] . '" alt="' . $directoryFiles[$i] . '">';
          $filesize = filesize('uploads/'. $directoryFiles[$i]);
          $newFileSize = convertFileSize($filesize);
          $result .= '<span>' . $directoryFiles[$i] . ' (Size is: ' .  $newFileSize . ')</span></a></li>';
        }   
      }
      $result .= '</ul></div>';
    }

    return $result;     
  }

  // Converts file size to ['byte', 'kb', 'mb', 'gb', 'tb', 'pb'] decreasing the value
  // of the file for better readability
  function convertFileSize ($filesize){
    $count = 0;
    $newFileSize = '';
    $array = ['byte', 'kb', 'mb', 'gb', 'tb', 'pb'];
    while($filesize > 1024){
      $filesize /= 1024;
      $count++;
    }

    $newFileSize .= round($filesize, 2) . $array[$count]; 

   
    return $newFileSize;
  }

  // Task 4: Draws a chessboard according to two parameters ($ x - x-axis and $ y - y-axis),
  // generating html code for further display on the screen.
  function drawChessBoard($x, $y){
    $flag = true; 
    if($x <= 10 && $y <= 10 && $x >= 2 && $y >= 2){
      $sizeDiv = 80;
      $widthBlock = $x * $sizeDiv; 
      $heightBlock = $y * $sizeDiv; 
      $chessBoard = '<div class="displayChessBord" style="height:' . $heightBlock . 'px; 
                      width:' . $widthBlock . 'px">';
      for ($i = 0; $i < $y; $i++) { 
        for ($r = 0; $r < $x; $r++) {
          if($flag){
            $chessBoard .= '<div class="black"></div>';
          }else{
            $chessBoard .= '<div class="white"></div>';
          }
          $flag = !$flag;
        }
    
        if($x % 2 == 0){
          $flag = !$flag;
        }
      }
      $chessBoard .= '</div>';
    }else{
      $chessBoard = '<span class="alertInfo">Enter data according to the rules and format.</span';
    }       

    return $chessBoard;
  }

  // Task 5 Gets the sum of the entered number (if the number consists of several 
  //characters (numbers), then the function separates the entered number character by
  // character and sums these numbers) 
  function getSumEnteredNumber($value){
    $result = 0;
    $array = [];

    $array = str_split($value);

    // Or you can solve it by commenting on one line above.
    // do {
    //     if($value % 10 == $value){
    //         array_push($array, $value);
    //         break;
    //     } 
    //     array_push($array, $value % 10);
    //     $value = floor($value / 10);
    // } while ($value != 0);

    foreach ($array as $number) {
      $result += $number;
    }

    return $result;
  }

  // Task 6: Generate an array of random integers from 1 to 10, the length of the array
  // is 100. Remove repeats from the array, sort, reverse and multiply each element by two.
  function getTaskResult_6(){
    $textResult = '<p>An array of unique random numbers taken from an array of 100 numbers </br>';
    $result = [];
    $count = 0;
    $arrayRandomNumber = [];
    for ($i = 0; $i < 100; $i++) { 
      array_push($arrayRandomNumber, rand(1, 10));
    }

    $arrayRandomNumber = array_unique($arrayRandomNumber);
    $textResult .= implode(', ', $arrayRandomNumber) . '</p>';
    foreach ($arrayRandomNumber as $value) {
      $result[$count] = $value * 2;
      $count++;
    }
    rsort($result);
    $textResult .= '</br><p>The result after multiplying each number by 2 and displayed in descending 
                    order</br>' . implode(', ', $result) . '</p>'; 
 
    return $textResult;
  }

  // Task 8: Count the number of lines, letters and spaces in the entered text. Consider the 
  // Cyrillic alphabet, emoji and special characters. Check with any online counter
  function getTaskResult_8($text){
    $textNoLineBreak = preg_replace('/\n/', '/br', $text);
    $amountLines = substr_count($textNoLineBreak, '/br', 0, strlen($textNoLineBreak));
    $amountSpaces = substr_count($textNoLineBreak, ' ', 0, strlen($textNoLineBreak));
    $amountLetters = mb_strlen(preg_replace('/\s/', '', $text), 'UTF-8');

    return '</br>Lines = ' . ($amountLines + 1) . '</br> Letters = ' . $amountLetters .
             '</br> Spaces = ' . $amountSpaces; 
  }
?>