<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css">
</head>
<body>

<div class="container d-flex justify-content-center"">
    <form name="login" class="login" method="POST"
    enctype="multipart/form-data" action="">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <input required type="email" class="form-control" id="floatingInput" name="email"
        placeholder="ex@ample.com"/>
    <input required type="password" class="form-control" id="floatingInput" name="password"
        placeholder="password"/>
    <div class="icon_container">
        <input type="submit" class="icon" id="submit" name="submit"
            value="Submit"/>
</div>
<a href="pages/register.php">Register</a><br>
</form>
</div>
</div>

    <!-- when data is correct customer goes to homepage, if not correct: than you shall not pass! -->

<?php
if(isset($_POST["submit"])) {
    $message = "";
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    try {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute(array($email));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result) {
            $passwordInDatabase = $result["password"];
            $rol = $result["rol"];
            if(password_verify($password, $passwordInDatabase)){
                $_SESSION["ID"] = session_id();
                $_SESSION["USER_ID"] = $result["ID"];
                $_SESSION["USER_NAAM"] = $result["firstname"];    
                $_SESSION["E-MAIL"] = $result["email"];
                $_SESSION["STATUS"] = "ACTIVE";
                $_SESSION["ROL"] = $rol;
                if($rol == 0) {
                    echo "<script>location.href='index.php?page=homepage';
                    </script>";
                }elseif($rol == 1) {
                    echo "<script>location.href='index.php?page=homepage';
                    </script>";
                }else{
                    $message .= "Access denied<br>";                         // insert Gandalf gif here
                }
            }else {
                $message .= "Try and login again<br>";
            }
        }
        } catch (PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        echo "<div id='message'>$message</div>";
    }
?>  

<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html>