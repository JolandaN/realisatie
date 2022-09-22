<?php

// DBconfig establishes a connection with the database.

DEFINE("USER","root");
DEFINE("PASSWORD", "");
try {
    $connection = new
    PDO("mysql:host=localhost;dbname=stattracker",USER,PASSWORD);
    $connection->setAttribute
    (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    echo $e->getMessage();
    echo "Could not connect.";
}
?>  