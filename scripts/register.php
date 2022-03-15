<?php
require_once("../db_connection.php");



// Taking all info from form
if($_POST){
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    

    
} else {
    header("Location: ../views/register.php");
    echo "Registration failed, please try again.";
    die;
}

echo "iki password hash veikia".$firstName.$lastName.$email.$password.$confirm;
//Hashing password for security purposes
//And checking if password and confirmed password do mach
if($password == $confirm){
    $password = password_hash($password, PASSWORD_BCRYPT);
    echo "password hash veikia";

} else {
    echo "<h3 style='color:red'>Passwords do not match! Pleace check and try again!</h3>";
    header("Location: ../views/register.php");
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
        echo "<h3 style='color:red'>PThis email has been used, please check if you already have an account!</h3>";
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





?>