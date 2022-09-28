<!DOCTYPE html>
<html lang="en">
<head>

    <!-- customer can register new account here -->

<link rel="stylesheet" href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css"/>
</head>
<body>
<?php
    // register.html is the layout
include("register.html");
include("..\DBconfig.php");
if(isset($_POST["submit"])) {
    $message = "";
        // $_POST firstname lastname email and password that are filled in the form will be added to the database
    $name = htmlspecialchars($_POST["lastname"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute(array($email));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result) {
        $message = "This e-mail address has already been registered.";
    }else{
        $sql = "INSERT INTO user (ID, name, email, password, rol)
        values (null,?,?,?,?)";

        $stmt = $connection->prepare($sql);
        try {
            $stmt->execute(array(
                $name,
                $email,
                $passwordHash,
                0)
            );
            $message = "New account registered.";
        }
        catch(PDOException $e) 
        {
            $message = "Could not register new account.".$e->getMessage();
        }
    }
    echo "<div id='message'>".$message."</div>";
}
?>

<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html>