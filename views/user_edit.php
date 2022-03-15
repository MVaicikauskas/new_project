<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

require_once '../db_connection.php';
include '../layouts/header.php';

if($_GET){
    try{
        $userid = $_GET['userid'];
        $sql = "SELECT * FROM users WHERE id='$userid'";
        $querry = $conn->prepare($sql);
        $querry->execute();
        $result = $querry->fetch();
    } catch (PDOException $e){
        echo "Error: ".$e->getMessage();
    }
}
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-light mb-8">
                <div class="card-header bg-warning">Edit user's info</div>
                <div class="card-body">
                   <form action="http://192.168.64.2/new_project/scripts/user_edit.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First Name" name="fname" value="<?php echo $result['first_name']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last Name" name="lname" value="<?php echo $result['last_name']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="your@email.com" name="email" value="<?php echo $result['email'] ?>">
                        </div>
                        <input type="hidden" name="userid" value="<?php echo $result['id'] ?>">
                        <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include '../layout/footer.php' ?>