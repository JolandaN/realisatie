<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type"
    content="text/html"; charset="utf-8">
    <title>Stattracker</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css"/>
    <script>
        function logout() {
            var loguit = confirm('Are you sure you want to logout?');
            if (loguit) {
                location.href='index.php?page=logout'
            }
        }
    </script>
</head>

<?php

    $totals = 'SELECT SUM(`goals`) AS totalGoals, SUM(`assists`) AS totalAssists FROM user';
    $stmt = $connection->prepare($totals);
    $stmt->execute();
    $totals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<body>

<div class="col-6">
<!-- Shows total goals and assists -->
        <h2 class="h2-title">Goals</h2>
        <p class="h2-title"><?php foreach ($totals as $total) {
            echo $total['totalGoals'];
        ?></p>
    </div>
    <div class="col-6">
        <h2 class="h2-title">Assists</h2>
        <p class="h2-title"><?php {
            echo $total['totalAssists'];
        } }?></p>
</div>

<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html> 