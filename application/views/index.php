<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
		<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
		<title>Client Billing</title>
		<script>
			window.onload = function () {
				$.ajax({
					url: 'get_charges_data.php', // PHP script to fetch data from the server
					dataType: 'json',
					success: function (data) {
						var dataPoints = [];
						$.each(data, function (index, value) {
							var month = value.month; // Assuming 'month' is the column name in your database
							var total_cost = parseFloat(value.total_cost); // Assuming 'total_cost' is the column name in your database
							dataPoints.push({ label: month, y: total_cost });
						});

						var chart = new CanvasJS.Chart("chartContainer", {
							animationEnabled: true,
							theme: "light2", // "light1", "light2", "dark1", "dark2"
							title: {
								text: "Client Billing-2011"
							},
							axisY: {
								title: "Estimate Cost"
							},
							data: [{        
								type: "column",  
								showInLegend: true, 
								legendMarkerColor: "grey",
								legendText: "Month",
								dataPoints: dataPoints
							}]
						});
						chart.render();
					}
				});
			}
		</script>
	</head>
	<body>
		<!-- Table below -->
		<p>List of total charges per month: </p>
			<table style="border-collapse: collapse" border=1>
				<tr>
					<th>Month</th>
					<th>Year</th>
					<th>Total Cost</th>
				</tr>
<?php			foreach($charges as $charge)
				{	?>
					<tr>
						<td><?= $charge['month'] ?></td>
						<td><?= $charge['year'] ?></td>
						<td><?= $charge['total_cost'] ?></td>
					</tr>
<?php			}?>
			</table>

		<!-- chart below -->
		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	</body>
</html>
