<?php
session_start();
if (isset($_SESSION['taskResult_7'])) {
    $_SESSION['taskResult_7']++;
} else {
    $_SESSION['taskResult_7'] = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WD_PS_PHP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="task">
    <h2 class="task_name">Task 1</h2>
    <div class="task_body">
        <div class="task_condition">
            <p><strong>Task conditions: </strong> Calculate the sum of numbers from -1000 to 1000</p>
        </div>
        <form action="mainBrain.php" method="post">
            <input type="hidden" name="task" value="1">
            <input type="submit" value="Calculate">
        </form>
        <div class="task_result">
            <strong class="result">Result:</strong>
            <output class="task_resultValue"><?php echo isset($_SESSION['taskResult_1']) ? $_SESSION['taskResult_1'] : '' ?></output>
        </div>
    </div>
</section>
<section class="task">
    <h2 class="task_name">Task 2</h2>
    <div class="task_body">
        <div class="task_condition">
            <p><strong>Task conditions: </strong> Calculate the sum of numbers from -1000 to 1000, summing only numbers that end in 2,3, and 7</p>
        </div>
        <form action="mainBrain.php" method="post">
            <input type="hidden" name="task" value="2">
            <input type="submit" value="Calculate">
        </form>
        <div class="task_result">
             <strong class="result">Result:</strong>
            <output class="task_resultValue"><?php echo isset($_SESSION['taskResult_2']) ? $_SESSION['taskResult_2'] : '' ?></output>
        </div>
    </div>
</section>

<section class="task">
    <h2 class="task_name">Task 3</h2>
    <div class="task_body">
        <div class="task_condition">
            <p><strong>Task conditions: </strong> Make file upload to a separate folder. All files from the folder should be displayed in a list containing only the name and file size in a human-readable size (1kB, 3mb, 1.5gb) in brackets. Files can be downloaded. Make a small preview for image files.</p>
        </div>
        <div class="task_result">
            <div class="task_upload">
                <form class="task_uploadForm" action="mainBrain.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="uploadFile">
                    <input type="submit" name="loadFile" value="Load">
                </form>
                <span class="error">
                    <?php
                    echo isset($_SESSION['taskError_3']) ? $_SESSION['taskError_3'] : ''; ?>
                </span>
            </div>
            <div class="task_resultLinks">
                <h3>List of downloaded files</h3>
                <?php echo isset($_SESSION['taskResult_3']) ? $_SESSION['taskResult_3'] : '';  ?>
            </div>
        </div>
    </div>
</section>
<section class="task">
    <h2 class="task_name">Task 4</h2>
    <div class="task_body">
        <div class="task_condition">
            <p><strong>Task conditions: </strong> Draw a chessboard</p>
        </div>
        <div class="task_result">
            <form action="mainBrain.php" method="post">
                <label for="boardValue">Enter the size of the chessboard. The format, minimum and maximum values ​​are as follows:(max: 10x10 min: 2x2):</label><br>
                <input id="boardValue" name="boardValue" type="text" required>
                <input type="hidden" name="task" value="4">
                <input type="submit" name="chessBoard" value="Draw">
            </form>
            <div class="myResult"><?php echo $_SESSION['taskResult_4'] ? $_SESSION['taskResult_4'] : '' 
            ?></div>
        </div>
    </div>
</section>
<section class="task">
    <h2 class="task_name">Task 5</h2>
    <div class="task_body">
        <div class="task_condition">
            <p><strong>Task conditions: </strong> Find the sum of the digits of the entered number.</p>
        </div>
        <form action="mainBrain.php" method="post">
            <label for="value">Insert the number:</label><br>
            <input id="value" name="value" type="number" required>
            <input type="hidden" name="task" value="5">
            <input type="submit" name="chessBoard" value="Calculate">
        </form>
        <div class="task_result">
              <strong class="result">Result:</strong>
            <output class="task_resultValue"><?php echo isset($_SESSION['taskResult_5']) ? $_SESSION['taskResult_5'] : '' ?>
            </output>
        </div>
    </div>
</section>
<section class="task">
    <h2 class="task_name">Task 6</h2>
    <div class="task_body">
        <div class="task_condition">
            <p><strong>Task conditions: </strong> Generate an array of random integers from 1 to 10, the
             length of the array is 100. Remove repeats from the array, sort, reverse and multiply
              each element by two.</p>
        </div>
        <form action="mainBrain.php" method="post">
            <input type="hidden" name="task" value="6">
            <input type="submit" value="Display result">
        </form>
        <div class="task_result">
             <strong class="result">Result:</strong>
            <output class="task_resultValue"><?php echo isset($_SESSION['taskResult_6']) ? $_SESSION['taskResult_6'] : '' ?>
            </output>
        </div>
    </div>
</section>
<section class="task">
    <h2 class="task_name">Task 7</h2>
    <div class="task_body">
        <div class="task_condition">
            <p><strong>Task conditions: </strong> The page should have a counter for counting page visits through the php session.</p>
        </div>
        <form method="post" action="mainBrain.php">
            <input type="hidden" name="task" value="7">
            <input type="submit" value="Reset">
        </form>
        <div class="task_result">
              <strong class="result">Result:</strong>
            <output class="task_resultValue"><?php 
                if($_SESSION['taskResult_7'] == 1) {
                    echo '<span class="resultVisitPage">' . $_SESSION['taskResult_7'] . 
                    ' time you visited this page </span';
                }else{
                    echo '<span class="resultVisitPage">' . $_SESSION['taskResult_7'] .
                     'th times you visited this page </span';
                }?>      
            </output>
        </div>
    </div>
</section>
<section class="task">
    <h2 class="task_name">Task 8</h2>
    <div class="task_body">
        <div class="task_condition">
            <p><strong>Task conditions: </strong> Count the number of lines, letters and spaces in 
            the entered text. Consider the Cyrillic alphabet, emoji and special characters. Check
             with any online counter</p>
        </div>
        <form action="mainBrain.php" method="post">
            <label for="value">Enter text:</label><br>
            <div class="task_form">
            <textarea id="value" name="value"></textarea>
            <input type="hidden" name="task" value="8">
            <input type="submit" value="Display result">
        </div>
        </form>
        <div class="task_result">
              <strong class="result">Result:</strong>
            <output class="task_resultValue"><?php echo isset($_SESSION['taskResult_8']) ? $_SESSION['taskResult_8'] : '' ?></output>
        </div>
    </div>
</section>
</body>
</html>