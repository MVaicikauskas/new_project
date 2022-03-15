<?php

session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

require_once '../db_connection.php';

if($_POST){
    try{
        $userid = $_POST['userid'];
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $email = $_POST['email'];

        $sql = "UPDATE users SET first_name='$firstName', last_name='$lastName', email='$email' WHERE id='$userid'";
        $querry = $conn->prepare($sql);
        $result = $querry->execute();
        if($result){
            header("Location: ../views/users.php");
        } 
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
} else {
    header("Location: ../");
}
?>