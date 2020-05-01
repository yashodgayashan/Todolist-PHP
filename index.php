<?php 
    include('config/db_connect.php');

    $sql = 'SELECT title, description, id FROM todos ORDER BY createdTime';
    
    $result = mysqli_query($connection, $sql);

    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free result memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($connection);

    print_r($pizzas);
?>
<!DOCTYPE html>
<html>
    <?php include("templates/header.php"); ?>
    <?php include("templates/footer.php"); ?>
</html>

