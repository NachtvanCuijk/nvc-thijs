<!DOCTYPE html>
<html id="html">
<html>
<head>
    <meta charset="utf-8">
    <link href="pie/build/nv.d3.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js" charset="utf-8"></script>
    <script src="pie/build/nv.d3.js"></script>
    <script src="pie/examples/lib/stream_layers.js"></script>
    <script>
setInterval(function(){
    $("#html").load("walkin.php");
    ...
}, 5000);
</script>
    <style>
        text {
            font: 12px sans-serif;
        }
        svg {
            display: block;
            float: left;
        }
        #chart {
            height: 100%;
            width: 100%;
        }
        #test2 {
            height: 100% !important;
            width: 50% !important;
        }
        #test1 {
            height: 100% !important;
            width: 50% !important;
        }
        html, body {
            margin: 0px;
            padding: 0px;
            height: 100%;
            width: 100%;
        }
        .nvd3.nv-pie.nv-chart-donut2 .nv-pie-title {
            fill: rgba(70, 107, 168, 0.78);
        }
        .nvd3.nv-pie.nv-chart-donut1 .nv-pie-title {
            opacity: 0.4;
            fill: rgba(224, 116, 76, 1.0);
        }
		.nv-series {
			display: none;
		}

    </style>
</head>
<body id="body" class='with-3d-shadow with-transitions'>

<?php
require("inc/connection.php");
	//aantal mensen die binnen zijn
	$query = "SELECT
			COUNT(isbinnen)
		FROM
			register
		WHERE
			isbinnen = 1";
		$result = mysqli_query($link, $query);
		$data = [];
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	
	//aantal aanmeldingen
	$query2 = "SELECT
			COUNT(isbinnen)
		FROM
			register";
		$result2 = mysqli_query($link, $query2);
		$data2 = [];
		while ($row2 = $result2->fetch_assoc()) {
			$data2[] = $row2;
		}
	
	//temperatuur	
	$contents = file_get_contents('http://www.weather-forecast.com/locations/cuijk/forecasts/latest');
	preg_match('/3 Day Weather Forecast Summary:<\/b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">(.*?)</s', $contents, $matches);
	preg_match_all('!\d+!', $matches[1], $temp);
			
	//variabelen
	$binnen = $data[0]['COUNT(isbinnen)'];
	$aanmeldingen = $data2[0]['COUNT(isbinnen)'];
	$nog = $aanmeldingen - $binnen;
	
	$temperatuur = $temp[0][0];
	$tempOver = 60 - $temperatuur;
?>

<svg id="test1" class="mypiechart"></svg>

<svg id="test2" class="mypiechart"></svg>


<script id="chart">
    var testdata = [
		{key: "", y: <?php echo json_encode($aanmeldingen); ?>},
		{key: "", y: <?php echo json_encode($binnen); ?>}
    ];
	
	var testdata2 = [
		{key: "", y: <?php echo json_encode($tempOver); ?>},
		{key: <?php echo json_encode($temperatuur); ?>, y: <?php echo json_encode($temperatuur); ?>}
    ];
    var height = 960;
    var width = 960;
    var chart1;
    nv.addGraph(function() {
        var chart1 = nv.models.pieChart()
            .x(function(d) { return d.key })
            .y(function(d) { return d.y })
            .donut(true)
            .width(width)
            .height(width)
            .id('donut1'); // allow custom CSS for this one svg
        chart1.title(<?php echo json_encode($binnen); ?> + " bezoekers binnen");
        chart1.pie.donutLabelsOutside(true).donut(true);
        d3.select("#test1")
            .datum(testdata)
            .transition().duration(1200)
            .call(chart1);
        // LISTEN TO WINDOW RESIZE
        // nv.utils.windowResize(chart1.update);
        // LISTEN TO CLICK EVENTS ON SLICES OF THE PIE/DONUT
        // chart.pie.dispatch.on('elementClick', function() {
        //     code...
        // });
        // chart.pie.dispatch.on('chartClick', function() {
        //     code...
        // });
        // LISTEN TO DOUBLECLICK EVENTS ON SLICES OF THE PIE/DONUT
        // chart.pie.dispatch.on('elementDblClick', function() {
        //     code...
        // });
        // LISTEN TO THE renderEnd EVENT OF THE PIE/DONUT
        // chart.pie.dispatch.on('renderEnd', function() {
        //     code...
        // });
        // OTHER EVENTS DISPATCHED BY THE PIE INCLUDE: elementMouseover, elementMouseout, elementMousemove
        // @see nv.models.pie
        return chart1;
    });
    var chart2;
	var temptitle = <?php echo json_encode($temperatuur); ?> + ' graden';
    nv.addGraph(function() {
        var chart2 = nv.models.pieChart()
            .x(function(d) { return d.key })
            .y(function(d) { return d.y })
            //.labelThreshold(.08)
            .showLabels(false)
            .color(d3.scale.category20().range().slice(10))
            .width(width)
            .height(height)
            .donut(true)
            .id('donut2')
            .title(temptitle);
        // MAKES IT HALF CIRCLE
        chart2.pie.donutLabelsOutside(true).donut(true);
        d3.select("#test2")
            //.datum(historicalBarChart)
            .datum(testdata2)
            .transition().duration(1200)
            .call(chart2);
        return chart2;
    });
</script>
</body>
</html>