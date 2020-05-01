<?php 
    include('config/db_connect.php');

    if(isset($_POST["complete"])){
        $id = mysqli_real_escape_string($connection,$_POST["id"]);
        $sql= "UPDATE todos SET isCompleted = 1 WHERE id='$id'";
        $result = mysqli_query($connection, $sql);
        echo "Completed";
    } elseif(isset($_POST["incomplete"])){
        $id = mysqli_real_escape_string($connection,$_POST["id"]);
        $sql= "UPDATE todos SET isCompleted = 0 WHERE id='$id'";
        $result = mysqli_query($connection, $sql);
        echo "incompleted";
    }

    $sql = 'SELECT title, description, id, isCompleted FROM todos ORDER BY createdTime';
    
    $result = mysqli_query($connection, $sql);

    $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free result memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($connection);

?>
<!DOCTYPE html>
<html>
    <?php include("templates/header.php"); ?>
    <div class="row">
        <div class="col-sm-12 col-md-1 col-lg-2"></div>
        <div class="col-sm-12 col-md-10 col-lg-8">
            <div class="button-container">
                <a class="btn btn-primary float-right" href="addTodo.php" role="button">Add Todo</a>
            <div>
            <div class="button-container"></div>
            <table class="table table-striped table-secondary table-hover" style="margin:20px 0;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Completed</th>
                    <th>Action</th>
                    <th>See more</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($todos as $todo):?>
                    <tr>
                        <?php $completed = $todo["isCompleted"] ? "Completed" : "Not completed"?>
                        <td class="align-middle"><?php echo htmlspecialchars($todo["title"]); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($todo["description"]); ?></td>
                        <td class="align-middle"><?php echo $completed; ?></td>
                        <td class="align-middle">
                            <form action="index.php" method="POST">
                                <input type="hidden" id="id" name="id" value="<?php echo $todo["id"]; ?>">
                                <?php if($todo["isCompleted"]):?>
                                    <button type="submit" name="incomplete" class="btn btn-warning">Mark as incompleted</button>
                                <?php else:?>
                                    <button type="submit" name="complete" class="btn btn-success">Mark as done</button>
                                <?php endif;?>
                            </form>
                        </td>
                        <td class="align-middle">
                            <a class="btn btn-primary float-right" href="details.php?id=<?php echo $todo["id"];?>" role="button">See more</a>
                        </td>
                    </tr>
                <?php endforeach; ?> 
            </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-1 col-lg-2"></div>
    </div>
    <?php include("templates/footer.php"); ?>
</html>

