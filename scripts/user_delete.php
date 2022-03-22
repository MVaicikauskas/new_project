<?php
include '../layouts/header.php';
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

require_once '../db_connection.php';

if($_GET){
    try{
        $userid = $_GET['userid'];

        // Deleting user from db
        $sql = "DELETE FROM users WHERE id='$userid'";
        $querry = $conn->prepare($sql);
        $result = $querry->execute();
        
        if($result){
            header("Location: ../views/users.php");
        }
    } catch (PDOException $e) {
        echo "Failed to delete user ".$result['first_name'].". Error: ".$e->getMessage();
    }
}
?>