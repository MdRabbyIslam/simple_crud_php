<?php

session_start();
$name = '';
$location = "";
$update = false;
$id = 0;

$mysqli = new mysqli('localhost','root',"",'crud') or die(mysqli_error($mysqli));

//insert

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $_SESSION['message'] ="Record has been saved!";
    $_SESSION['msg_type'] = "success";

    $mysqli->query("INSERT INTO data(name, location) VALUES('$name', '$location')") or
            die($mysqli->error());
    header('location: index.php');
}

//delete

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $_SESSION['message'] ="Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
    header('location: index.php');
}

//getting single data
if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    $row = $result -> fetch_array();
    $name = $row['name'];
    $location = $row['location']; 
}

//update
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name']; 
    $location = $_POST['location']; 

    $_SESSION['message'] = "Updated successfully";
    $_SESSION['msg_type'] = 'warning';

    $mysqli->query("UPDATE data SET name ='$name', location='$location' WHERE id='$id'") or
    die($mysqli->error);

    header('location:index.php');
}


?>