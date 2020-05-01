<?php

    $servername = "localhost";
    $username = "yashod";
    $password = "test1234";

    // Create connection
    $connection = new mysqli($servername, $username, $password);
    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Create database
    $sql = file_get_contents('./resources/create_db.sql');
    if ($connection->query($sql) === TRUE) {
        $connection = new mysqli($servername, $username, $password, "todo");
    } else {
        die("Error creating database: " . $connection->error);
    }

    $sql = file_get_contents('./resources/create_users_table.sql');
    if ($connection->query($sql) === TRUE) {
        $sql = file_get_contents('./resources/create_todos_table.sql');
        if (!$connection->query($sql) === TRUE) {
            die("Error creating t: " . $connection->error);
        }
    } else {
        die("Error creating table: " . $connection->error);
    }

?>