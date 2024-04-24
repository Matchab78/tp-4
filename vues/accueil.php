<main role="main">

 
  <div class="jumbotron container">
    <div class="container">
      <h1 class="display-3">Bienvenue !</h1>
      <p>Bienvenue sur le site d'administration BiblioWeb</p>
    </div>
  </div>

  <div class="container mt-5">
    
    <?php
 
 $dataPoints = array(
   array("label"=> "BD", "y"=> 18.37),
   array("label"=> "Essai", "y"=> 6.12),
   array("label"=> "Roman Comtemporain", "y"=> 4.08),
   array("label"=> "Litterature", "y"=> 8.16),
   array("label"=> "Terreur", "y"=> 16.03),
   array("label"=> "Science-fiction", "y"=> 10.33),
   
 );
   
 ?>
 <!DOCTYPE HTML>
 <html>
 <head>  
 <script>
 window.onload = function () {
  
 var chart = new CanvasJS.Chart("chartContainer", {
   animationEnabled: true,
   exportEnabled: true,
   title:{
     text: "Camembert des Livres "
   },
   subtitles: [{
     text: "Thèmes disponibles"
   }],
   data: [{
     type: "pie",
     showInLegend: "true",
     legendText: "{label}",
     indexLabelFontSize: 16,
     indexLabel: "{label} - #percent%",
     yValueFormatString: "$#,##0",
     dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
   }]
 });
 chart.render();
  
 }
 </script>
 </head>
 <body>
 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
 <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
 </body>
 </html>                                   
    <hr>

</main>