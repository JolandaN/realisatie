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

        <!-- this is homepage -->

      
<?php

    $totals = 'SELECT SUM(`goals`) AS totalGoals, SUM(`assists`) AS totalAssists FROM user';
    $stmt = $connection->prepare($totals);
    $stmt->execute();
    $totals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<body>

<div class="col-6">
<!-- Shows total goals and assists -->
        <h2 class="h2-title">Total Goals</h2>
        <p class="h2-title"><?php foreach ($totals as $total) {
            echo $total['totalGoals'];
        ?></p>
    </div>
    <div class="col-6">
        <h2 class="h2-title">Total Assists</h2>
        <p class="h2-title"><?php {
            echo $total['totalAssists'];
        } }?></p>
</div>

<br>
            <br>
<h2 class="h2-title">Users</h2>
        <br>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Team</th>
                <th scope="col">Goals</th>
                <th scope="col">Assists</th>

            </tr>
        </thead>
        <tbody>

            <!-- Display users -->
            <?php

            $sql = 'SELECT user.ID, user.name, user.goals, user.assists, team.teamname FROM user INNER JOIN team ON user.teamid = team.ID;';
            $stmt = $connection->prepare($sql);
            $stmt->execute([]);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($users as $user) {
                $id = $user['ID'];

            
                echo '<tr>';
                echo '<td>' . $user['name'] . '</td>';
                echo '<td>' . $user['teamname'] . '</td>';
                echo '<td>' . $user['goals'] . '</td>';
                echo '<td>' . $user['assists'] . '</td>';

            }
            ?>
            </tbody>
        </table>

<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html> 