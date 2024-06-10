<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UAP PIRDAS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#konten").load("index.php");
            var refreshid = setInterval(function() {
                $("#konten").load('index.php');
            }, 1000);
            $.ajaxSetup({ cache: false });
        });
    </script>
</head>

<body>
    <center>
        <div id="konten"></div>
    </center>
</body>

</html>
