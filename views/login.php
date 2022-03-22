<?php
include '../layouts/header.php';
if($_GET){
    $error=$_GET['error']; 
}
?>

<div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-light mb-8 ">
                    <div class="card-header bg-warning">Sign Up</div>
                    <div class="card-body">
                    <h3 class="card-title text-center text-danger"><?php echo $error; ?></h3>
                    <form action="http://192.168.64.2/new_project/scripts/login.php" method="POST" enctype="multipart/form-data">

                            <!-- Gathering all info for log in  -->
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="your@email.com" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include '../layout/footer.php' ?>