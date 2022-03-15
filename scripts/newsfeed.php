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
        // $likeCount = 0;

        $sql = "INSERT INTO posts (first_name, message) VALUES ('$user', '$message')";
        $querry = $conn->prepare($sql);
        $querry->execute();
        header("Location:../views/newsfeed.php");

    } catch(Exception $e){
        
        header("Location: ../views/newsfeed.php");
        echo "Error: " . $e->getMessage();
    }
}
?>