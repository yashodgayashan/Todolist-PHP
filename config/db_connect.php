<?php

    $servername = "localhost";
    $username = "yashod";
    $password = "test1234";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else{
        echo "Connected";
    }

    // Create database
    $sql = file_get_contents('./resources/create_db.sql');
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

?>