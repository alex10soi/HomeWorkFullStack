<?php
  // The number of rows of colored lines in one div block.
	define('ROW_OF_COLOR_LINES', 2);
  // The number of columns of colored lines in one row
	define('COL_OF_COLOR_LINES', 4);

  // Draws a block with colored lines in the number of rows and columns provided
  // in the constants 'ROW_OF_COLOR_LINES', 'COL_OF_COLOR_LINES' and returns the 
  // created block of code for its further display on the screen.
	function drawColorLines() {
		$blockColorLines = '';
    for ($i = 0; $i < ROW_OF_COLOR_LINES; $i++) { 
      for ($j = 0; $j <= COL_OF_COLOR_LINES; $j++) { 
        $blockColorLines .= "<div class='chat_color_line line{$j}'></div>";
      }
    }
    return $blockColorLines;
	}

?>