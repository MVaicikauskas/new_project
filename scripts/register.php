<?php
require_once("../db_connection.php");
session_start();



// Taking all info from form
if($_POST){
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    
    // Checking if all spaces of form is filled
    if(empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirm)){

        header("Location: ../views/register.php?error=All spaces must to be filled!");
        die;
    } else {
     
        //Email validation
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "{$email}: A valid email"."<br>";
        }
        else {
            header("Location: ../views/register.php?error=Email is not valid!");
            die;
        }

        //Hashing password for security purposes
        //And checking if password and confirmed password do mach
        if($password == $confirm){
            $password = password_hash($password, PASSWORD_BCRYPT);
            // echo "password hash veikia";

        } else {
            header("Location: ../views/register.php?error=Passwords do not match!");
            die;
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

        //Checking if user's email is already used
        foreach ($result as $user) {

            if($user['email'] == $email){
                header("Location: ../views/register.php?error=This email is already in use, please check is already have an acc!");
                die;
            }

        }


        // Sending gathered information into database
        try{
            $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
            $querry = $conn->prepare($sql);
            $querry->execute();
            header("Location: http://192.168.64.2/new_project/views/login.php");
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }

    
} else {
    header("Location: ../views/register.php");
    echo "Registration failed, please try again.";
    die;
}







?>