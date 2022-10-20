<?php 

if(!isset($_SESSION["ID"])&&($_SESSION["STATUS"]!="ACTIVE")) {
    echo "<script>
    alert('You have no access to this page.');
    location.href='../index.php';
    </script>";
}
$sql = "DELETE FROM user WHERE ID = ?";
$stmt = $connection->prepare($sql);
try{
    $stmt->execute(array($_POST['id']));
    echo "<script>alert('User is deleted.');
    location.href='index.php?page=changeprofile';
    </script>";
}catch(PDOException $e) {
    echo $e->getMessage();
}
?>