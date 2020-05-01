<?php 
    include('config/db_connect.php');

    if(isset($_POST["complete"])){
        echo "Completed";
    } elseif(isset($_POST["incomplete"])){
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
        <div class="col-sm-12 col-md-2 col-lg-2"></div>
        <div class="col-sm-12 col-md-8 col-lg-8">
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
                        <td class="align-middle"><?php echo $todo["title"]; ?></td>
                        <td class="align-middle"><?php echo $todo["description"]; ?></td>
                        <td class="align-middle"><?php echo $completed; ?></td>
                        <td class="align-middle">
                            <form action="index.php" method="POST">
                                <?php if($todo["isCompleted"]):?>
                                    <button type="submit" name="incomplete" class="btn btn-secondary">Mark as incompleted</button>
                                <?php else:?>
                                    <button type="submit" name="complete" class="btn btn-secondary">Mark as done</button>
                                <?php endif;?>
                            </form>
                        </td>
                        <td class="align-middle">
                            <form>
                                <button type="submit" class="btn btn-secondary">See more</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?> 
            </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-2 col-lg-2"></div>
    </div>
    <?php include("templates/footer.php"); ?>
</html>

