<?php
include '../layouts/header.php';

$error = $_GET['error'];
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-light mb-8">
                <div class="card-header bg-warning">Sing up new account</div>
                <div class="card-body">
                    <h3 class="card-title text-center text-danger"><?php echo $error; ?></h3>
                    <!-- Gathering info for registration -->
                   <form action="http://192.168.64.2/new_project/scripts/register.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First Name" name="first_name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="your@email.com" name="email">
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