<?php
    
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "pbw";

    // Create connection
    $koneksi = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    } else {
        echo "Connection successful";
    }
?>