<?php
require_once("../db_connection.php");
session_start();

$_SESSION['reg_errors'] = [];


// Taking all info from form
if($_POST){

    
    // Checking if all spaces of form is filled
    if(!(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm']))){
        array_push($_SESSION['reg_errors'], "Something went wrong, please contact the administrator");
    } 

    $_SESSION['first_name'] = $firstName = $_POST['first_name'];
    $_SESSION['last_name'] = $lastName = $_POST['last_name'];
    $_SESSION['email'] = $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];   
    
    if(($firstName=="" || $lastName=="" || $email=="" || $password=="" || $confirm=="")){
        array_push($_SESSION['reg_errors'], "Please fill all fields");
    }
    
    if(strlen($firstName)>50){
        array_push($_SESSION['reg_errors'], "First name is too long! MAX 50 symbols");
            
    }
    
    if(strlen($lastName)>50){
        array_push($_SESSION['reg_errors'], "Last name is too long! MAX 50 symbols");
            
    }

    //Taking all info  from our DB's table users
    try{
        $sql1 = "SELECT * FROM users";
        $querry1 = $conn->prepare($sql1);
        $querry1->execute();
        $result = $querry1->fetchAll();
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }

    //Email validation
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
    }
    else {
        array_push($_SESSION['reg_errors'], "Email is not valid!");
    }

    //Hashing password for security purposes
    //And checking if password and confirmed password do mach
    if($password != $confirm){
        array_push($_SESSION['reg_errors'],"Passwords do not match");
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT);
    }

    //Checking if user's email is already used
    foreach ($result as $user) {

        if($user['email'] == $email){
            array_push($_SESSION['reg_errors'], "This email is already used, please check if you already have an acc!");
        }

    }



    if(!empty($_SESSION['reg_errors'])){
        
        header("Location: ../views/register.php");
        
    } else {

        // if($password == $confirm){
        //     $password = password_hash($password, PASSWORD_BCRYPT);
        
        // } else{
        //      array_push($_SESSION['reg_errors'],"Passwords do not match");
        // }
    
        try{
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
        $querry = $conn->prepare($sql);
        $querry->execute();
        header("Location: http://192.168.64.2/new_project/views/login.php");
        } catch (PDOException $e) {
             echo "Error: ".$e->getMessage();
        };
    }
    

    
} else {
    header("Location: ../views/register.php");
}







?>