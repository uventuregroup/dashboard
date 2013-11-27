<?php
	require_once("config.php");
	require_once("class/Api.php");
	require_once("class/Helper.php");

	$RequestURL = BASE_DOMAIN ."/api/trans_daily/result:(transactions),filter:(time:(last30),product:(id=". $_GET['productID']. ")";
	if (isset($_GET['storeID']))
	{
		if ($_GET['storeID'] !== "all")
		{
			$RequestURL .= ",store:(id=". $_GET['storeID'] .")";
		}
	}
	$RequestURL .= ")";

	$Response = Api::Request($RequestURL);
	$ResponseXML = new SimpleXMLElement($Response);

?>

<div>SALES TRANSACTIONS (LAST 30 DAYS)</div>
<canvas id="myChart" width="900" height="200"></canvas>

	<script>

		function drawChart()
		{
			var lineChartData = {
				labels : ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","",""],
				datasets : [
					{
						fillColor : "rgba(28,137,227,0.5)",
						strokeColor : "rgba(28,137,227,1)",
						pointColor : "rgba(246,146,64,1)",
						pointStrokeColor : "#fff",
						data : [<?php foreach ($ResponseXML->timeperiod as $NextDay) { echo $NextDay->transactions .","; } ?>]
		
					}
				]			
			}
			
			var lineOptions = {
				scaleShowLabels : true,
				scaleOverlay : false,
				scaleShowGridLines : false,
				scaleGridLineColor : "rgba(242,242,242,1)",
				scaleLineColor : "rgba(0,0,0,.1)",
				barShowStroke : true,
				animation : true,
				datasetStrokeWidth : 3,
				datasetFill : false,
				bezierCurve : true,
				pointDot : false
			}
	
			var myLine = new Chart(document.getElementById("myChart").getContext("2d")).Bar(lineChartData, lineOptions);
		}
	
		window.onload = drawChart;
	
	</script>

