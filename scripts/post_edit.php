<?php

session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../views/login.php");
}



require_once '../db_connection.php';

if($_POST){
    try{
        $postid = $_POST['postid'];
        $message = $_POST['message'];

        //updating post from db with new values
        $sql = "UPDATE posts SET message='$message' WHERE id='$postid'";
        $querry = $conn->prepare($sql);
        $result = $querry->execute();
        if($result){
            header("Location: ../views/newsfeed.php");
        } else {
            echo "Error: ".$e->getMessage();
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
} else {
    header("Location: ../views/newsfeed.php");
}

?>