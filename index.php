<?php

// DBconfig establishes a connection with the database

session_start();
include_once ("dbconfig.php");
include_once("header.php");


if(isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "login";
}
if($page) {
    include("pages/".$page.".php");
}