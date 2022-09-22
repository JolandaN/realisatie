<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css">
</head>
<body>
<?php
if(!isset($_SESSION["ID"])&&$_SESSION["STATUS"]!="ACTIVE"){
    echo "<script>
    alert('You have no access to this page.');
    location.href='../index.php';
    </script>";
}

    // destroys session

unset($_SESSION["ID"]);
unset($_SESSION["USER_ID"]);
unset($_SESSION["USER_NAAM"]);
unset($_SESSION["STATUS"]);
unset($_SESSION["E-MAIL"]);
unset($_SESSION["ROL"]);
session_destroy();
$connection = null;
echo "<script>location.href='".$_SERVER["PHP_SELF"]."'</script>";
?>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html>