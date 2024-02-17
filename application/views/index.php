<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Client Billing</title>
    <!-- CSS for styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            font-family: "Roboto", sans-serif;
            color: #2e2e2e
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2, form {
            display: inline-block;
        }

        form {
            margin-left: 130px;
        }

        form label {
            font-weight: 500;
        }

        form input[type="date"],
        form input[type="submit"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        form input[type="submit"] {
            background-color: #66C0E1;
            font-weight: bolder;
        }

        form input[type="submit"]:hover {
            background-color: #5bacca;
        }

        h3 {
            font-weight: bolder;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #66C0E1;
            color: #1D1D1D;
        }

        table tr:hover {
            background-color: #d1ecf6;
        }

        #chartContainer {
            height: 370px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Client Billing</h2>
        <form action="/charges/index" method="post">
            <label for="start">Start date:</label>
            <input type="date" name="start" required>
            <label for="end">End date:</label>
            <input type="date" name="end" required> 
            <input type="submit" value="Show">
        </form>
        <!-- Table -->
        <h3>List of total charges per month:</h3>
        <table>
            <tr>
                <th>Month</th>
                <th>Year</th>
                <th>Total Cost</th>
            </tr>
            <?php foreach($charges as $charge): ?>
                <tr>
                    <td><?= $charge['month'] ?></td>
                    <td><?= $charge['year'] ?></td>
                    <td><?= $charge['total_cost'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Chart Container -->
        <h3>Chart: </h3>
        <div id="chartContainer"></div>
    </div>

    <!-- JavaScript libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <!-- JavaScript for rendering chart -->
    <script>
        window.onload = function () {
            // Ajax request to fetch data and render chart
            $.ajax({
                url: 'get_charges_data.php',
                dataType: 'json',
                success: function (data) {
                    var dataPoints = [];
                    $.each(data, function (index, value) {
                        var month = value.month;
                        var total_cost = parseFloat(value.total_cost);
                        dataPoints.push({ label: month, y: total_cost });
                    });

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light2",
                        title: {
                            text: "Client Billing - 2011"
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
</body>
</html>
