<!DOCTYPE html>
<html lang="EN">
<head>

    <!-- adds video's to the database -->

<link rel="stylesheet" href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css">
</head>
<body> 

  
<div class="container d-flex justify-content-center">
    <form name="adduser" class="form" method="post">
        
        <h4 class="h4 mb-1 fw-normal">Add user</h4>

        <h6  style="color: red;">Name:</h6>
        <input type="text" name="name" id="name"/>

        <h6  style="color: red;">Email:</h6>
        <input type="text" name="email" id="email"/>

        <h6  style="color: red;">Password:</label><br>
        <input type="text" name="password" id="password" />
        
        <div class="icon_container">
        <br>
            <input type="submit" class="icon" id="submit"
            name="submit" value="Submit"/>
        </div>
        <br>
        <a href="index.php?page=homepage">Terug</a>
    </form>
</div>
<?php
if(!isset($_SESSION['ID'])&&($_SESSION['STATUS']!='ACTIVE')){
    echo "<script>
    alert('You have no access to this page');
    location.href='../index.php';
    </script>";
}
if(isset($_POST['submit'])) {
    $message = "" ;
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $sql = "INSERT INTO user (ID, name,  email, password) values (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    try {
        $stmt->execute(array(
            NULL,
            $name,
            $email,
            $password)
        );
        $message = "New user added.";
    }
    catch(PDOException $e) {
        $message = "Couldn't add new user.".$e->getMessage();
    }
    echo "<div id='message'>".$message."</div>";
}
?>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html>