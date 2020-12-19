<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap styleSheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>php crud</title>
</head>

<body class="w-100 h-auto">
    <?php require_once 'process.php'; ?>

    <?php 
    
    if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message'])
        ?>

    </div>
    <?php endif  ?>

    <?php
        $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    
        //getting all records
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

      ?>
    <div class="row justify-content-center p-5">
        <table class="table" class="col-md-6">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
            while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['location']?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-info"> Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

    </div>



    <?php
        function pre_r($array){
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

    ?>

    <div class="row justify-content-center">
        <form action="process.php" method="POST" class="col-md-4 text-left">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-group ">
                <label for="">Name : </label>
                <br>
                <input type="text" name="name" class="form-control" value="<?php echo $name ?>" placeholder="Enter your name">
            </div>
            <div class="form-group my-4 ">
                <label for="">Location : </label>
                <br>
                <input type="text" name="location" class="form-control" value="<?php echo $location ?>" placeholder="Enter your location">
            </div>
            <div class="form-control">
                <?php
                if($update==true): ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php endif; ?>

            </div>
        </form>
    </div>

    <!-- bootstrap cdn -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>