<?php
include '../layouts/header.php';

session_start();

if(isset($_SESSION['first_name']) && isset($_SESSION['last_name']) && isset($_SESSION['email'])){
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
}
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-light mb-8">
                <div class="card-header bg-warning">Sing up new account</div>
                <div class="card-body">
                    <h3 class="card-title text-center text-danger"><?php 
                    if(isset($_SESSION['reg_errors'])){
                        foreach ($_SESSION['reg_errors'] as $error){
                            echo $error.". ";
                        } 
                        $_SESSION['reg_errors'] = [];
                        
                        $first_name =$last_name =$email = "";
                    } ?>
                    </h3>
                    <!-- Gathering info for registration -->
                   <form action="http://192.168.64.2/new_project/scripts/register.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $first_name; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $last_name; ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="your@email.com" name="email" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include '../layout/footer.php' ?>