<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type"
    content="text/html"; charset="utf-8">
    <title>Stattracker</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css"/>
    <script>
        function logout() {
            var loguit = confirm('Are you sure you want to logout?');
            if (loguit) {
                location.href='index.php?page=logout'
            }
        }
    </script>
</head>

        <!-- this is homepage -->

<body style="background-image: linear-gradient(to right top, #000000, #141414, #212121, #2f2f2f, #3d3d3d);   
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;">

<?php
if(!isset($_SESSION["ID"])&&$_SESSION["STATUS"]!="ACTIVE"){
    echo "<script>
    alert('You have no access to this page.');
    location.href='../index.php';
    </script>";
}

if(!empty($_POST['title'])) {
    $sql = "SELECT * FROM video WHERE title = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute(array($_POST['title']));
} else {
    $sql = "SELECT * FROM video";
    $stmt = $connection->prepare($sql);
    $stmt->execute(array());
}

$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($videos as $video) {
    ?>
    <iframe
    style="margin-top: 5%; float: left; margin-left: 3%; border-radius: 10%;" 
    width="280" height="157" src="<?php echo $video['link']?>" 
        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <?php
}
?>

<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html> 