<?php

session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

require_once '../db_connection.php';

if($_GET){
    try{
        $postid = $_GET['postid'];

        // post delete
        $sql = "DELETE FROM posts WHERE id='$postid'";
        $querry = $conn->prepare($sql);
        $result = $querry->execute();
        if($result){
            header("Location: ../views/newsfeed.php");
        }

    } catch (PDOException $e) {
         echo "Error: ".$e->getMessage();
    }
} else {
    header("Location: ../views/newsfeed.php");
}

?>