<!DOCTYPE html>
<html lang="en">
<head>

    <!-- customer can register new account here -->

<link rel="stylesheet" href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css"/>
</head>
<body style="background-image: linear-gradient(to right top, #000000, #141414, #212121, #2f2f2f, #3d3d3d);   
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;">
<?php
    // register.html is the layout
include("register.html");
include("..\DBconfig.php");
if(isset($_POST["submit"])) {
    $message = "";
        // $_POST firstname lastname email and password that are filled in the form will be added to the database
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $token = "";
    $sql = "SELECT * FROM customer WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute(array($email));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result) {
        $message = "This e-mail address has already been registered.";
    }else{
        $sql = "INSERT INTO customer (ID, firstname, lastname, email, password, token, rol)
        values (null,?,?,?,?,?,?)";

        $stmt = $connection->prepare($sql);
        try {
            $stmt->execute(array(
                $firstname,
                $lastname,
                $email,
                $passwordHash,
                $token,
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
<style>
    #message {
        color: white !important;
    }
</style>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html>