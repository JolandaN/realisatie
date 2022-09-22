<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Stattracker</title>
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css"/>
</head>
<body style="background-image: linear-gradient(to right top, #000000, #141414, #212121, #2f2f2f, #3d3d3d);   
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;">

            <!-- form to require customers e-mail -->
    <div class="container d-flex justify-content-center">
            <form name="forgotpassword" class="form" method="post">
                <h1 class="h3 mb-3 fw-normal" style="color: red;">Forgot password</h1>
            <input type="email" required name="email" placeholder="e-mail"/>
</div>
<br/>
<div class="icon_container">
    <input type="submit" class="icon" id="submit" name="submit" />
</div>
<a href="../index.php?page=login" >Back</a>
</form>
</div>  
<?php

    // once email is submitted this code will generate a token and timestamp

if(isset($_POST["submit"])) {
    $message = "";
    $email = htmlspecialchars($_POST["email"]);
    $token = bin2hex(random_bytes(32));
    $timestamp = new DateTime("now");
    $timestamp = $timestamp->getTimestamp();
    include('../DBconfig.php');
    try {
        $sql = "UPDATE customer SET `token` = ? WHERE `email` = ?";
        $stmt = $connection->prepare($sql);
        $stmt = $stmt->execute(array($token,$email));

    }catch(PDOException $e) {
        echo $e->getMessage();

                // generates link on the webpage to reset password, link will send the customer to password_reset.php
    }
        $url =  "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/password_reset.php";
        $url = $url."?token=".$token."&timestamp=".$timestamp;

        $subject = "Password reset";

        $message = "<p><a href=".$url.">If you want to reset your password click this link.</a></p>";

        echo "<div id='message'>".$message."</div>";
}
?>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>