<?php
echo "hi";
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
                    <input type="text" class="form-control" placeholder="Title" id="title">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Description" id="description">
                </div>
                <a class="btn btn-primary" href="index.php" role="button">Back</a>
                <button type="submit" class="btn btn-primary float-right">Add</button>
            </form>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4"></div>
    </div>
    <?php include("templates/footer.php"); ?>
</html>

