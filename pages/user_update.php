<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} elseif ($_SESSION['ROL'] == 0) {
    header('Location: index.php?page=homepage');
} else {
     ?>
     <!-- Update user name, assists, team, goals, admin -->
<?php if (isset($_POST['submit'])) {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $assist = htmlspecialchars($_POST['assists']);
    $teamid = htmlspecialchars($_POST['teamid']);
    $goals = htmlspecialchars($_POST['goals']);

    $sql =
        'UPDATE user SET `name` = ?,  `goals` = ?, `assists` = ?, `teamid` = ? WHERE `ID` = ?';
    $stmt = $connection->prepare($sql);
    try {
        $stmt = $stmt->execute([$name, $goals, $assist, $teamid, $id]);
        // Alert script with confirmation message
        echo "<script>alert('User is updated');
            location.href='index.php?page=searchplayer';</script>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} ?>
<?php
} ?>