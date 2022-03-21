<?php
include '../layouts/header.php';

session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
};



require_once '../db_connection.php';

// taking info from posts table
try{
    $sql = "SELECT * FROM posts ORDER BY updated DESC";
    $querry = $conn->prepare($sql);
    $querry->execute();
    $result = $querry->fetchAll();

} catch(PDOException $e){
    echo "Select failed: " . $e->getMessage();
};



?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header bg-warning">
                    <h3 class="card-title">News Feed</h3>
                </div>
                <form action="http://192.168.64.2/new_project/scripts/newsfeed.php" method="post">
                <div class="card-body">
                    <div>
                        <h3 class="text-muted">Post something!</h3>
                    </div>
                    <div class="input-group">
                        
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon1">POST</button>
                        <textarea class="form-control" aria-label="text" placeholder="Write here..." name="text"></textarea>
                        
                    </div>
                    <div class="input-group mt-5">
                    <?php
                        foreach($result as $post){
                            $id = $post['id'];
                            $sql = "SELECT * FROM likes WHERE post_id='$id'";
                            $querry = $conn->prepare($sql);
                            $querry->execute();
                            $likes = $querry->fetchAll();
                            // var_dump($likes);
                            
                            echo "<div class=".'input-group'.">
                            <span class=".'input-group-text'.">".$post['first_name']."<br>".$post['updated']."</span> 
                            <textarea class=".'form-control'." aria-label=".'text'." placeholder=".'Write here...'."name=".'text'.">".$post['message']."</textarea>
                            <a class='btn btn-primary' href='../scripts/likes.php?postid=".$post['id']."'>Like<br>".count($likes)."</a>
                            </div>";
                        
                            if($post['first_name']==$_SESSION['username']){
                                echo "<a class='btn btn-warning' href='post_edit.php?postid=".$post['id']."'>Edit</a><a class='btn btn-danger' href='../scripts/post_delete.php?postid=".$post['id']."'>Delete</a>";
                            }
                        }
                    ?>
                    </div>
                </div>
                </form>
            </div>
        </div>


    </div>
</div>

<?php include '../layout/footer.php' ?>