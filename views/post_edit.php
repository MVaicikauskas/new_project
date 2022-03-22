<?php 
include '../layouts/header.php';

session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

require_once '../db_connection.php';


if($_GET){
    try{
        $postid = $_GET['postid'];
        $sql = "SELECT * FROM posts WHERE id='$postid'";
        $querry = $conn->prepare($sql);
        $querry->execute();
        $result = $querry->fetchAll();
        
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}


?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-light mb-8">
                <div class="card-header">Post Edit</div>
                <div class="card-body">
                   <form action="http://192.168.64.2/new_project/scripts/post_edit.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group">
                            <span class="input-group-text">Update post</span>
                            <textarea class="form-control" aria-label="With textarea" placeholder="Enter text to update previous post" name="message"></textarea>
                        </div>
                        <!-- hidden info to get exact post's id for update -->
                        <input type="hidden" name="postid" value="<?php echo $postid?>">
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer.php' ?>