<?php
    include('config/db_connect.php');
    $title = "";
    $description = "";
    $errors = ["title"=>"", "description"=>""];
    if(isset($_POST["submit"])){
        if(empty($_POST["title"])){
            $errors["title"] = "A title is required <br/>";
        } else {
            $title = $_POST["title"];
            if(!preg_match('/^[a-zA-Z0-9\s]+$/',$title)){
                $errors["title"] = "Title must only containe letters, numbers and spaces <br/>";
            }
        }
        if(!empty($_POST["description"])){
            $description = $_POST["description"];
            if(!preg_match('/^[a-zA-Z0-9\s]+$/',$description)){
                $errors["description"] = "Description must only containe letters, numbers and spaces <br/>";
            }
        }
        if(!array_filter($errors)){
            $title = mysqli_real_escape_string($connection, $_POST['title']);
            $description = mysqli_real_escape_string($connection, $_POST['description']);

            // Creates the query.
            $sql = "INSERT INTO todos(title,description,personId) VALUES('$title','$description','1')";

            // Save to the database.
            if(mysqli_query($connection,$sql)){
                // Sucess
                header("Location: index.php");
            } else {
                // Error
                echo 'query error ' . mysqli_error($connection);
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <?php include("templates/header.php"); ?>
    <div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 "></div>
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="container form-container">
            <form class="p-5" action="addTodo.php" method="POST">
                <div class="text-center">
                    <h1>Add todo</h1>
                </div>
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Title" id="title" value="<?php echo $title;?>">
                    <div style="color:red;"><?php echo $errors["title"];?></div>
                </div>
                <div class="form-group">
                    <input type="text" name="description" class="form-control" placeholder="Description" id="description" value="<?php echo $description;?>">
                    <div style="color:red;"><?php echo $errors["description"];?></div>
                </div>
                <a class="btn btn-primary" href="index.php" role="button">Back</a>
                <button type="submit" name="submit" class="btn btn-primary float-right">Add</button>
            </form>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4"></div>
    </div>
    <?php include("templates/footer.php"); ?>
</html>

