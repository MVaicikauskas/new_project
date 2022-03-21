<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new_project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
<body class="bg-secondary">


<nav class="navbar navbar-expand-lg navbar-light bg-warning">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://192.168.64.2/new_project/index.php">Mini Twitter</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://192.168.64.2/new_project/views/newsfeed.php">News feed</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://192.168.64.2/new_project/views/users.php">Users</a>
        </li>
    </div>    
    <div class="collapse navbar-collapse d-flex " id="">
                <!-- authentication links -->
                <ul class="navbar-nav ms-auto">
                    <?php 
                    if($_SESSION['username']){
                      echo '
                      <li class="navbar-text text-light">
                      <span>'.$_SESSION['username'].'</span>
                      </li>
                      <li class="nav-item">
                      <a href="http://192.168.64.2/new_project/scripts/logout.php"
                          class="nav-link">Log out</a>
                      </li>';
                    } else {
                      echo '                    
                      <li class="nav-item">
                      <a href="http://192.168.64.2/new_project/views/login.php"
                          class="nav-link">Login</a>
                      </li>
                      <li class="nav-item">
                          <a href="http://192.168.64.2/new_project/views/register.php"
                              class="nav-link">Register</a>
                      </li>';
                    }
                    ?>

                </ul>
    </div>
    </div>
  </div>
</nav>
<div class="gradient-background">
 
