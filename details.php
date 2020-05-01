<?php 
    include('config/db_connect.php');
    $errors = ["title"=>"", "description"=>""];
    if(isset($_GET["id"])){
        $id = mysqli_real_escape_string($connection,$_GET["id"]);
        if(isset($_GET["delete"])){
            $sql = "DELETE FROM todos WHERE id=$id";
            
            if (mysqli_query($connection, $sql)){
                header("Location: index.php");
            }else{
                echo "Query error " . mysqli_error($connection);
            } 
        } else {
            $sql = "SELECT * FROM todos WHERE id=$id";

            $result = mysqli_query($connection, $sql);
            $todo = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            mysqli_close($connection);
        }
    }elseif(isset($_POST["update"])){
        $todo = ["id"=>htmlspecialchars($_POST["id"]), 
                "title"=> htmlspecialchars($_POST["title"]), 
                "description"=> htmlspecialchars($_POST["description"])
                ];
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
            $id = mysqli_real_escape_string($connection, $_POST['id']);
            $title = mysqli_real_escape_string($connection, $_POST['title']);
            $description = mysqli_real_escape_string($connection, $_POST['description']);
            // Creates the query.
            $sql = "UPDATE todos SET title = '$title', description = '$description' WHERE id = '$id'";
            
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
                        <div style="color:red;"><?php echo $errors["title"];?></div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description" id="description" value="<?php echo $todo["description"];?>">
                        <div style="color:red;"><?php echo $errors["description"];?></div>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php echo $todo["id"]; ?>">
                    <a class="btn btn-primary" href="index.php" role="button">Back</a>
                    <button type="submit" name="update" class="btn btn-primary float-right" style="margin:5px;">Update</button>
                    <button type="button" class="btn btn-danger float-right" style="margin:5px;" data-toggle="modal" data-target="#myModal">
                        Delete
                    </button>

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal body -->
                            <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                Are you sure to delete <?php echo $todo["title"];?> ?
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-danger float-right" href="details.php?id=<?php echo $todo["id"];?>&&delete=true" role="button">Delete</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-1 col-lg-2"></div>
    <?php include("templates/footer.php"); ?>
</html>