<?php
$connect=mysqli_connect("localhost","root","","Mymerit");
$query = "SELECT program_location,count(*)as number FROM report_parmerit GROUP BY  program_location";
$result = mysqli_query($connect,$query);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>The location </title>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
					['program_location','Number'],
					<?php
					while($row = mysqli_fetch_array($result))
					{
						echo "['".$row["program_location"]."',".$row["number"]."],";
					}
					?>
				]);
        var options = {
          title: 'location of program'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
			
		</script>

	</head>
	<body>
		<br /><br />
		<div style="width:900px;">
		<h3 align="center">Location of the programs</h3>
		<br/>
		<div id="piechart" style="width: 900px; height: 500px;"></div>
	</div>
	</body>
</html>