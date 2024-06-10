<!DOCTYPE html>
<html>

<head>
    <title>Data Dari Database</title>
    <style>
        body {
            text-align: center;
        }

        #chart-container {
            width: 50%;
            margin: auto;
            text-align: left;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        #lightSensorChart {
            margin: 10%;
        }

        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin: auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <!-- Include jQuery and Chart.js libraries -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h2>Data dari Database</h2>

    <div id="chart-container">
        <?php
        include 'koneksi.php';

        $sql = "SELECT * FROM uap ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
               
                <th>Cahaya</th>
                <th>Rain</th>
                <th>LED</th>
                <th>Servo</th>
                </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["sensor_cahaya"] . "</td>";
                echo "<td>" . $row["sensor_rain"] . "</td>";
                echo "<td>" . $row["led"] . "</td>";
                echo "<td>" . $row["servo"] . "</td>";
                echo "</tr>";

                $chartData = array();
                $resultChart = $conn->query("SELECT id, sensor_cahaya FROM uap ORDER BY id DESC LIMIT 10");

                if ($resultChart->num_rows > 0) {
                    while ($rowChart = $resultChart->fetch_assoc()) {
                        $chartData[] = array("id" => $rowChart['id'], "sensor_cahaya" => $rowChart['sensor_cahaya']);
                    }
                }
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>

        <canvas id="lightSensorChart" width="400" height="200"></canvas>
    </div>

    <!-- Chart.js script with jQuery -->
    <script>
        $(document).ready(function () {
            var ctx = document.getElementById('lightSensorChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode(array_reverse(array_column($chartData, 'id'))); ?>,
                    datasets: [{
                        label: 'Sensor Cahaya',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        data: <?php echo json_encode(array_reverse(array_column($chartData, 'sensor_cahaya'))); ?>,
                        fill: false,
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            type: 'linear',
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
