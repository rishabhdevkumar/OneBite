<?php
    error_reporting(0);
    session_start();

    $db_host     = 'localhost';
    $db_user     = 'root';
    $db_pass     = '@1234#1234';
    $db_database = 'burgatory';

    $connect = mysqli_connect($db_host,$db_user,$db_pass,$db_database);
    if(!$connect)
    {
        echo '<script>alert("Database Connect Error")</script>';
    }
    define("SITE_URL", "http://localhost/burgatory/");
?>