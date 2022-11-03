<?php
// if team isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} elseif ($_SESSION['ROL'] == 0) {
    header('Location: index.php?page=homepage');
} else {
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.1.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Stat Tracker - team Edit</title>
</head>
<body>
<?php
$sql = 'SELECT * FROM team WHERE ID= ?';
$stmt = $connection->prepare($sql);
$stmt->execute([$_GET['id']]);
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($teams as $team) { ?>
<div class="container">
    <form class="form" action="" method="post">
        <h1 class="page-title uppercase"><span class="text-red center">E</span>dit team</h1>
        <br>
        <input type="hidden" name="id" id="id" value="<?php echo $team[
            'ID'
        ]; ?>" />
        <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $team[
                'teamname'
            ]; ?>"/>
        </div>
           <button type="submit" name="submit" class="btn btn-dark uppercase">Edit team</button>
        <span class="right"><a href="index.php?page=searchplayer" class="text-red" style="text-decoration: none;">Back</a></span>
    </form>
</div>
<?php }

if (isset($_POST['submit'])) {
    $id = $_REQUEST['id'];
    $teamname = $_POST['name'];
    $sql =
        "UPDATE team SET teamname = '$teamname' WHERE ID = '$id'";
    $stmt = $connection->prepare($sql);
    try {
        $stmt = $stmt->execute();
        // Alert script with confirmation message
        echo "<script>alert('Team is updated');
            location.href='index.php?page=searchplayer';</script>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} ?>
</body>
</html>
<?php
} ?>