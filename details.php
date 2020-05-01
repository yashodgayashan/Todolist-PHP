<?php 
    include('config/db_connect.php');
    if(isset($_GET["id"])){
        $id = mysqli_real_escape_string($connection,$_GET["id"]);

        $sql = "SELECT * FROM todos WHERE id=$id";

        $result = mysqli_query($connection, $sql);
        $todo = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($connection);
        print_r($todo);
    }
?>
<!DOCTYPE html>
<html>
    <?php include("templates/header.php"); ?>
    <div class="row">
        <div class="col-sm-12 col-md-1 col-lg-2"></div>
        <div class="col-sm-12 col-md-10 col-lg-8">
            <div class="container">
                <form class="p-5" action="details.php" method="POST">
                    <div class="text-center">
                        <h1><?php echo $todo["title"]; ?></h1>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title" id="title" value="<?php echo $todo["title"];?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description" id="description" value="<?php echo $todo["description"];?>">
                    </div>
                    <a class="btn btn-primary" href="index.php" role="button">Back</a>
                    <button type="submit" name="update" class="btn btn-primary float-right" style="margin:5px;">Update</button>
                    <button type="submit" name="delete" class="btn btn-danger float-right" style="margin:5px;">Delete</button>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-1 col-lg-2"></div>
    <?php include("templates/footer.php"); ?>
</html>