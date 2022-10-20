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
$sql = 'SELECT * FROM user';
$stmt = $connection->prepare($sql);
$stmt->execute([]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<div class="container d-flex justify-content-center">

<div class="row my-3">
    <div class="col-12">
        <h1>Delete user</h1>

    </div>
</div>    

<?php foreach($users as $user) { ?>
            <!-- this form shows all users with the option to delete them from the database -->

        <form name="edit" class="form"
        action="index.php?page=deleteuser"
        method="POST"
        style="border:1px solid black">
                        <h6 class="h6 mb-1 fw-normal" >Name:</h6 >
                        <input type="text" name="title" value="<?php echo $user['name'];?>" />  
                        
                        <h6 class="h6 mb-1 fw-normal" >Email:</h6>   
                        <input type="text" name="genre" value="<?php echo $user['email'];?>" /> 
                                               
                        <div class="icon_container">
                        <input type="submit" class="icon" name="delete" value="Delete"/>

                        <input type="hidden" name="id" value="<?php echo $user['ID'];?>" />
                        <br>
                        <br>
                    <a href="index.php?page=homepage">Back</a>
            <br>
            <br>
        </form> 


<?php
}
?>

</div>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html>


<!-- nog profiel bewerken ipv alleen deleten.  -->