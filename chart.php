<?php 
include 'header.php';
?>
<html>
<head>
<script src="amcharts/amcharts.js" type="text/javascript"></script>
<script src="amcharts/serial.js" type="text/javascript"></script>
</head>
<body>
<div id="mid-format-chart">
	<div id="chartdiv" style="width: 1000px; height: 400px;"></div>
	<div id="chartTable"></div>
	<br>
</body>

<script type="text/javascript">

AmCharts.loadJSON = function(url) {
  // create the request
  if (window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Opera, Safari
    var request = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    var request = new ActiveXObject('Microsoft.XMLHTTP');
  }
  
  request.open('GET', url, false);
  request.send();

  // parse and return the output
  return eval(request.responseText);
};

var chart;

//create chart
AmCharts.ready(function() {

// load the data
var chartData = AmCharts.loadJSON('salesdata.php');

// SERIAL CHART    
var chart = new AmCharts.AmSerialChart();
chart.pathToImages = "http://www.amcharts.com/lib/images/";
chart.dataProvider = chartData;
chart.categoryField = "product";

var graph = new AmCharts.AmGraph();
graph.valueField = "sales";
graph.type = "column";
chart.addGraph(graph);

graph.fillAlphas = 0.8;
chart.angle = 30;
chart.depth3D = 15;

// writes the chart
chart.write("chartdiv");

});


</script>
</div>
</html>
