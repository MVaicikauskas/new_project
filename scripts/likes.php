<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../views/login.php");
}



require_once '../db_connection.php';

if($_GET){
    try{
        $postid = $_GET['postid'];
        $user = $_SESSION['username'];

        //Gathering all info we need
        $sql = "SELECT * FROM likes WHERE first_name='$user' AND post_id='$postid'";
        $querry = $conn->prepare($sql);
        $querry->execute();
        $result = $querry->fetchAll();

        
        if(empty($result)){
            // inserting new likes
            $sql = "INSERT INTO likes (first_name, post_id) VALUES ('$user', '$postid')";
            $querry = $conn->prepare($sql);
            $querry->execute();
     
            header("Location: ../views/newsfeed.php");

            
            
        } else{
            // if same person hits like button for second time on same post, so his like is deleting (unlike)
            $sql = "DELETE FROM likes WHERE post_id='$postid' AND first_name='$user'";
            $querry = $conn->prepare($sql);
            $result = $querry->execute();
            if($result){
                header("Location: ../views/newsfeed.php");
            }
        }
        
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}





?>