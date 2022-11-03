<?php

// DBconfig establishes a connection with the database.

DEFINE("user","root");
DEFINE("password", "");
try {
    $connection = new
    PDO("mysql:host=localhost;dbname=stattracker",user,password);
    $connection->setAttribute
    (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    echo $e->getMessage();
    echo "Could not connect.";
}
?>  