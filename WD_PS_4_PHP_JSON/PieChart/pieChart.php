<?php
  session_start();
  $fileName = "date.json";
  if(file_exists($fileName)){
    $date = json_decode(file_get_contents($fileName));
    $dataPoints = [
      ['Task', 'Voting'],
      ['House1',  $date->{'voting'}->{'House1'}],
      ['House2',  $date->{'voting'}->{'House2'}],
      ['House3',  $date->{'voting'}->{'House3'}]       
    ];
  }else{
    echo '<div class="error">Error: File date.json not found </div>';
  }
?>

<!DOCTYPE HTML>
<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable(<?= json_encode($dataPoints, JSON_NUMERIC_CHECK) ?>);

      var options = {
        title: 'Voting results',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
  </script>
  <link rel="stylesheet" type="text/css" href="css/pieChart.css">
</head>
<body>
  <div id="piechart_3d" style="width: 700px; height: 500px;"></div>
  <?php
    $count = 1;
    while($count <= $_SESSION['COUNT_IMAGES']){
      $listInput .= "<div class='image_pattern pattern{$count}'>
        <div class='image_conteiner{$count}'></div><span class='image_option'>House{$count}</span>
        </div>";
      $count++; 
    }
    echo $listInput;
  ?>
</body>
</html>