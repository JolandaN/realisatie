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

        stats go here. 


<?php

$sql = "SELECT * FROM user WHERE ID = :id";
$stmt = $connection->prepare($sql);
$stmt->execute([':id' => $_SESSION["USER_ID"]]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($_SESSION["USER_ID"]);

foreach ($users as $user) {
    $id = $user["ID"];
    $name = $user["name"];
    $goals = $user["goals"];
    $assists = $user["assists"];

?>

<body>

<div class="container">
        <br>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <h3>Goals and Assists</h3>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo 'Name: ' . $name; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo 'Goals: ' .
                            $goals ?></td>
                    </tr>
                    <tr>
                        <td><?php echo 'Assists: ' .
                            $assists ?></td>
                    </tr>

                    <tr>
                        <?php echo "<td><span class='right uppercase'> <a class='btn btn-primary' href='index.php?page=profile_edit&id=" .
                            $user['ID'] .
                            "'>Edit profile</a></span></td>"; ?>
                </tbody>
            </table>
</div>

<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html> 

<?php } ?>