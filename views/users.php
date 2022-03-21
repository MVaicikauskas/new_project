<?php
include '../layouts/header.php';
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}



require_once '../db_connection.php';

try{
    $sql = "SELECT * FROM users";
    $querry = $conn->prepare($sql);
    $querry->execute();
    $result = $querry->fetchAll();
} catch(PDOException $e){
    echo "Select failed: " . $e->getMessage();
}
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header bg-warning">
                    Hello <?php echo $_SESSION['username'].", It's a list of all members of Mini Tweeter."; ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Users list</h5>
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            foreach ($result as $user){
                                echo "<tr><td>".$user['first_name']."</td><td>".$user['last_name']."</td><td>".$user['email']."</td><td>".$user['created']."</td><td>".$user['updated']."</td>";
                                if($user['first_name']!=$_SESSION['username']){
                                    echo "<td> </td><td> </td></tr>";
                                }

                                if($user['first_name']==$_SESSION['username']){
                                    echo "<td><a class='btn btn-warning' href='user_edit.php?userid=".$user['id']."'>Edit</a><a class='btn btn-danger' href='../scripts/user_delete.php?userid=".$user['id']."'>Delete</a></td></tr>";
                                }
                            }


                        ?>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    
                </div>
            </div>
        </div>


    </div>
</div>

<?php include '../layout/footer.php' ?>
