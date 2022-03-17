<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../views/login.php");
}


require_once '../db_connection.php';


if($_POST){
    try{
        $message = $_POST['text'];
        $user = $_SESSION['username'];
        
        // inserting new post into db
        $sql = "INSERT INTO posts (first_name, message) VALUES ('$user', '$message')";
        $querry = $conn->prepare($sql);
        $querry->execute();
        header("Location:../views/newsfeed.php");

    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}
?>