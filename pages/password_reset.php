<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Stattracker</title>
</head>
<body>

    <!-- form that asks for all the information necessary to change the password -->

    <div class="content">
        <form name="resetform" method="POST"
        ectype="multipart/form-data" action=""
        onsubmit="
        if(document.resetform.password1 !==
        document.resetform.password2) {
            alert('Passwords must be similar'); return false;">
            <p id="page_titel">Password reset</p>
            <input required="true" type="email" name="email"
            placeholder="ex@ample.com"/><br>
            <input required="true" type="password" name="password1"
            placeholder="New password"/><br>    
            <input required="true" type="password" name="password2"
            placeholder="Repeat new password"/><br>     
            <div class="icon_container">
                <input type="submit" class="icon" id="submit"
                name="submit_password"/>
        </div>
        <a href="../index.php?page=login">Terug</a>
        </form>
    </div>
    </body>
</html>

<?php

if(isset($_POST["submit_password"])) {

    if(isset($_GET["token"]) && isset($_GET['timestamp'])) {


        $token = $_GET['token'];
        $timestamp1 = $_GET['timestamp'];
        $message = "";
// looks in the database for email and token in the link
include("../DBconfig.php");
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password1']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $sql = "SELECT * FROM customer WHERE email = ? AND token = ?";
            $stmt = $connection->prepare($sql);
            $stmt->execute(array($email,$token));
            $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
// check if link has expired
        if($stmt) {
            $timestamp2 = new DateTime("now");
            $timestamp2 = $timestamp2->getTimestamp();
            $dif = $timestamp2 - $timestamp1;
// if the link is valid save password
            if(($timestamp2 - $timestamp1) < 43200)
            {
                $query = "UPDATE customer SET `password` = ?
                    WHERE `email` = ?";
            $stmt = $connection->prepare($query); 
            $stmt = $stmt->execute(array($passwordHash,$email));
            if ($stmt) {
                echo "<script>alert('Your password has been reset');
                location.href='../index.php';</script>";
            }
            else {
                echo "<script>alert('Link has expired');
                location.href='../index.php';</script>";
            }
            }
        }
        }catch(PDOException $e){
            echo $e->getMessage();
        }}
    }
?>  