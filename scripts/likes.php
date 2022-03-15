<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../views/login.php");
}



require_once '../db_connection.php';

if($_GET){
    try{

        // taking count of like already we have
        $postid = $_GET['postid'];

        $sql1 = "SELECT * FROM posts WHERE id='$postid'";
        $querry1 = $conn->prepare($sql1);
        $querry1->execute();
        $likes = $querry1->fetch();
        // +1 like after hitting like button
        
         if($postid == $likedPost['id']){
            $likeCount = $likedPost['like_count']+1;
        }
 

        // updating count of likes with new count we get
        $sql = "UPDATE posts SET like_count = '$likeCount'";
        $querry = $conn->prepare($sql);
        $result = $querry->execute();

        if($result){
            header("Location: ../views/newsfeed.php");
        } else {
            echo "failed to update like count";
        }

        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}



?>