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
        $conn = new mysqli($servername, $username, $password, "todo");
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $sql = file_get_contents('./resources/create_users_table.sql');
    if ($conn->query($sql) === TRUE) {
        $sql = file_get_contents('./resources/create_todos_table.sql');
        if ($conn->query($sql) === TRUE) {
            echo "Table created";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }

?>