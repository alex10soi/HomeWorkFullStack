<?php 

    function countSumNumbers(){
      $result = 0;
      for ($i = -1000; $i <= 1000; $i++) { 
        $result += $i;
      }
      return $result;
    }


    function countSumNumbers_2($regex) {
      $result = 0;
      for ($i = -1000; $i <= 1000; $i++) { 
        if(preg_match($regex, $i)){
          $result += $i;
        }
      }
      return $result;
    }


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
            $result .= '<span>' . $directoryFiles[$i] . ' (Size is: ' .  $newFileSize . '</span></a></li>';
          }   
        }
        $result .= '</ul></div>';
      }

    return $result;     
    }


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


    function getTaskResult_6(){
      $result = [];
      $count = 0;
      $arrayRandomNumber = [];
      for ($i = 0; $i < 100; $i++) { 
        array_push($arrayRandomNumber, rand(1, 10));
      }

      $arrayRandomNumber = array_unique($arrayRandomNumber);
      foreach ($arrayRandomNumber as $value) {
        $result[$count] = $value * 2;
        $count++;
      }
      rsort($result);
   
      return implode(', ', $result);
    }

    function getTaskResult_8($text){
      $lenghtOfText = strlen($text);
      $textNoLineBreak = preg_replace('/\n/', '/br', $text);
      $amountLines = substr_count($textNoLineBreak, '/br', 0, strlen($textNoLineBreak));
      $amountSpaces = substr_count($textNoLineBreak, ' ', 0, strlen($textNoLineBreak));
      $amountLetters = mb_strlen(preg_replace('/\s/', '', $text), 'UTF-8');

      return '</br>Lines = ' . ($amountLines + 1) . '</br> Letters = ' . $amountLetters .
               '</br> Spaces = ' . $amountSpaces; 
    }
 
?>