<?php
require_once ("../db_connection.php");
session_start();
$_SESSION['login_err'] = [];

// Taking neccesary info from form
if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];
}


// Taking neccesary info from database
try{
    $sql = "SELECT * FROM users";
    $querry = $conn->prepare($sql);
    $querry->execute();
    $users = $querry->fetchAll();
    
} catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

if(!$_POST){
    header("Location: ../views/login.php");
}

if(!isset($_POST['email']) || !isset($_POST['password'])){
    array_push($_SESSION['login_err'], "Something went wrong, please contact your administrator");
}

if($email == ""){
    array_push($_SESSION['login_err'], "Please enter your email address");
}

if($password ==""){
    array_push($_SESSION['login_err'], "Please enter your password");
}

$email_exists = 0;

foreach($users as $user){
    if(array_search($email, $user)){
        $email_exists +=1;
        
    }
}

if($email_exists === 0){
    array_push($_SESSION['login_err'], "Email does not exist");
}

foreach($users as $user){
    if($user['email'] == $email){
        if(password_verify($password, $user['password'])){
            $_SESSION['username'] = $user['first_name'];
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../views/users.php");
            die;
        } else{
            $_SESSION['login_count'] += 1;
            if($_SESSION['login_count'] === 3){
                array_push($_SESSION['login_err'], "Log in is locked");
            }else {
                array_push($_SESSION['login_err'], "Please check your password");
            }
            
        }
    }
}

if(!empty($_SESSION['login_err'])){
    header("Location: ../views/login.php");
}

// Checking if we do have user like somebody who's trying to login

// if($result){
    
    

//     // Checking password
//     $passwordHash = $result['password'];
    
//     if(password_verify($password, $passwordHash) && $email=== $result['email']){
//         $_SESSION['username'] = $result['first_name'];
//         header('Location: ../views/users.php');
//     } else {
//         // echo "Password is incorrect";
//         session_unset();
//         header('Location: ../views/login.php?error="Wrong email or password, please try again!"');
//     }
// } else {
//     session_unset();
//     header('Location: ../views/login.php?error="Wrong email or password, please try again!"');
// }


?>