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

        <!-- this is profile -->

        show profile content logged in user. 

        <?php
        if(!isset($_SESSION["ID"])&&$_SESSION["STATUS"]!="ACTIVE"){
            echo "<script>
            alert('You have no access to this page.');
            location.href='../index.php';
            </script>";
        }
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "stattracker");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM user WHERE ID = Can't get ID ";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>name</th>";
                echo "<th>email</th>";
                echo "<th>password</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

<body>

<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html> 