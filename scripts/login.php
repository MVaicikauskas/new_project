<?php
require_once ("../db_connection.php");


// Taking neccesary info from form
if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];
}


// Taking neccesary info from database
try{
    $sql = "SELECT * FROM users WHERE email='$email'";
    $querry = $conn->prepare($sql);
    $querry->execute();
    $result = $querry->fetch();
    
} catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

// Checking if we do have user like somebody who's trying to login

if($result){
    session_start();
    

    // Checking password
    $passwordHash = $result['password'];
    
    if(password_verify($password, $passwordHash)){
        $_SESSION['username'] = $result['first_name'];
        header('Location: ../views/users.php');
    } else {
        echo "Password is incorrect";
    }
} else {
    echo "Wrong email or password, try again.";
}


?>