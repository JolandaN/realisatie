<?php 

if(!isset($_SESSION["ID"])&&($_SESSION["STATUS"]!="ACTIVE")) {
    echo "<script>
    alert('You have no access to this page.');
    location.href='../index.php';
    </script>";
}
$sql = "SELECT * FROM user WHERE ID = :id";
$stmt = $connection->prepare($sql);
$stmt->execute([':id' => $_SESSION["USER_ID"]]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($_SESSION["USER_ID"]);

foreach ($users as $user) {
    $id = $user["ID"];
    $name = $user["name"];
    $email = $user["email"];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stattracker</title>
</head>
<body>
 
<div class="container">
        <h1 class='title'>Account</h1>
        <br>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Account information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo 'Name: ' . $name; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo 'Email address: ' .
                            $email ?></td>
                    </tr>

                    <tr><?php echo "<td><span class='right uppercase'> <a class='btn btn-primary' href='index.php?page=profile_edit&id=" .
                            $user['ID'] .
                            "'>Edit profile</a></span></td>"; ?>
                </tbody>
            </table>
</div>

</body>
</html>

<?php } ?>