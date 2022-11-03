<?php 

if(!isset($_SESSION["ID"])&&($_SESSION["STATUS"]!="ACTIVE")) {
    echo "<script>
    alert('You have no access to this page.');
    location.href='../index.php';
    </script>";
}
$sql = "SELECT * FROM user WHERE ID = ?";
$stmt = $connection->prepare($sql);
$stmt->execute([$_GET['id']]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($_SESSION["USER_ID"]);

foreach ($users as $user) {
    $id = $user["ID"];
    $name = $user["name"];
    $email = $user["email"];
    $password = $user["password"];
    
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
<form action="" method="post">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th><input type="hidden" name="id" id="id" value="<?php echo $user[
                        'ID'
                    ]; ?>" /></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="name" class="form-control" id='name' placeholder="Name" value="<?php echo $name?>" required>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- User can't edit email -->
                        <input type="email" name="email" class="form-control" placeholder="E-mail" id='email' value=<?php echo $email ?> readonly>
                    </td>
                    <td>
                    </td>
                </tr>
                
            </tbody>
                    
            <thead>
                <tr>
                    <th>Password</th>
                    <th><input type="hidden" name="id" id="id" value="<?php echo $user[
                        'ID'
                    ]; ?>" /></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <!-- User needs to confim password -->
                        <input type="password" name="password" class="form-control" placeholder="Password" id='password' value='' required>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="password_confirm" class="form-control" id='password' placeholder="Confirm Password" required>
                    </td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" class="btn btn-dark" value="Submit">
        <span class="right"><a class="text-red" style="text-decoration: none;" href="index.php?page=profilepage">Back</a></span>
        </form>
</div>

</body>
</html>

<?php } 

 // if password does match with password_confirm then update user
 if (isset($_POST['password']) && isset($_POST['password_confirm'])) {
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $name = $_POST['name'];
    if ($password == $password_confirm) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE user SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        echo '<script>alert("Password is successfully changed!")</script>';
        echo '<script>window.location.href="index.php?page=profilepage"</script>';
    } else {
        echo '<div class="alert alert-danger">';
        echo '<strong>Error!</strong> Password and Confirm Password are not the same!';
        echo '</div>';
    }
}
?>
</div>
</body>
</html>