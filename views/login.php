<?php
include '../layouts/header.php';

session_start();

$locked = false;

if(isset($_SESSION['login_count'])){
    if($_SESSION['login_count'] === 3){
        $locked = true;
    } 
} else {
    $_SESSION['login_count'] = 0;
}
?>

<div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-light mb-8 ">
                    <div class="card-header bg-warning">Sign Up</div>
                    <div class="card-body">
                    <h3 class="card-title text-center text-danger"><?php 
                    if(isset($_SESSION['login_err'])){
                        $errors = $_SESSION['login_err']; 
                        $_SESSION['login_err'] = [];
                        foreach($errors as $error){
                            echo $error.". ";
                        }
                     }
                    ?></h3>
                    <form action="http://192.168.64.2/new_project/scripts/login.php" method="POST" enctype="multipart/form-data">

                            <!-- Gathering all info for log in  -->
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="your@email.com" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>

                            <button type="submit" class="btn btn-primary" <?php if($locked){echo "disabled";}; ?>>Submit</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include '../layout/footer.php' ?>