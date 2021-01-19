
<!-- Fetch Query -->
<?php include("dbcon.php");

  $query_track = $pdo->prepare("SELECT videos.title AS title, artists.name AS artist, videos.releaseDate AS releaseDate, videos.description AS description, videos.source AS source FROM videos LEFT JOIN artists ON videos.artistId=artists.id WHERE videos.id=:id");
  $query_track->bindParam("id", $_GET['id'], PDO::PARAM_INT);
  $query_track->execute();
  $track = $query_track->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- /Fetch Query -->

<!-- rating query -->
<?php
if(isset($_POST['rateBtn'])){
    $query = $pdo->prepare('select * from videoratings where userId=:userId and videoId=:videoId');
    $query->bindParam('userId', $_POST['userId'], PDO::PARAM_INT);
    $query->bindParam('videoId', $_POST['videosId'], PDO::PARAM_INT);
    $query->execute();
    $user=$query->fetch(PDO::FETCH_ASSOC);
    
    if ($user != ""){
        $query_rate = $pdo->prepare('UPDATE videoratings set rating=:rating where userId=:userId and videosId=:videosId');
        $query_rate->bindParam('userId', $_POST['userId'], PDO::PARAM_INT);
        $query_rate->bindParam('rating', $_POST['rating'], PDO::PARAM_INT);
        $query_rate->bindParam('videosId', $_POST['videosId'], PDO::PARAM_INT);
        $query_rate->execute();
        //var_dump($_POST);
    } else {
        $query_rate = $pdo->prepare('INSERT INTO videoratings(userId, rating, videoId) VALUES(:userId, :rating, :videoId)');
        $query_rate->bindParam('userId', $_POST['userId'], PDO::PARAM_INT);
        $query_rate->bindParam('rating', $_POST['rating'], PDO::PARAM_INT);
        $query_rate->bindParam('videoId', $_POST['videoId'], PDO::PARAM_INT);
        $query_rate->execute();
        //var_dump($_POST);
    }
}
?>
<!-- /rating query -->

<!-- insert comment query -->
<?php
if(isset($_POST['commentBtn'])){
    $query_comment = $pdo->prepare('INSERT INTO videoreviews(userId, comment, videoId) VALUES(:userId, :comment, :videoId)');
    $query_comment->bindParam('userId', $_POST['userId'], PDO::PARAM_INT);
    $query_comment->bindParam('comment', $_POST['comment'], PDO::PARAM_STR);
    $query_comment->bindParam('videoId', $_POST['videoId'], PDO::PARAM_INT);
    $query_comment->execute();
    //var_dump($_POST);
}
?>
<!-- /insert comment query -->

<!-- Fetch query for editing -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $query = $pdo->prepare('select * from videoreviews where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    $comment_edit = $query->fetch(PDO::FETCH_ASSOC);
    $videoId_old = $_GET['videoId'];
    //var_dump($comment_edit);
  }
?>
<!-- /Fetch query -->

<!-- Edit query -->
<?php
  if (isset($_POST['editBtn'])){
    $query = $pdo->prepare('update videoreviews set comment=:comment where id=:id');
    $query->bindParam('id', $_POST['id'], PDO::PARAM_INT);
    $query->bindParam('comment', $_POST['comment'], PDO::PARAM_STR);
    $query->execute();
    header("location:video_view.php?id=" . $_POST['videoId']);
    //var_dump($_POST);
  }
?>
<!-- /Edit query -->


<!-- Delete Query -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $query = $pdo->prepare('delete from videoreviews where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    //var_dump($_GET);
    header("location:video_view.php?id=" . $_GET['videoId']);
  }
?>
<!-- /Delete Query -->



<?php include("_template.php");
head(); ?>

<style>
    .link:hover {
        text-decoration: underline;
        color: #0056b3;
    }
</style>

<!-- Edit comment modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Comment</h5>
        <button type="button" onclick="window.location.href='javascript:history.go(-1)'" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="video_view.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?php echo $comment_edit['id']; ?>">
          <input type="hidden" name="videoId" value="<?php echo $videoId_old; ?>">
          <label>Comment</label>
          <input class="form-control" type="text" name="comment" value="<?php echo $comment_edit['comment']; ?>">
        </div>
        <div class="modal-footer">
          <button type="button" onclick="window.location.href='video_view.php?id=<?php echo $videoId_old; ?>'" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="editBtn" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Edit comment modal -->

<section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="videos__large__item set-bg" data-setbg="template/img/videos/large-item.jpg">
                        <a href="<?php echo $track[0]['source']; ?>" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                        <div class="videos__large__item__text">
                            <h4><?php echo $track[0]['title']; ?></h4>
                            <ul>
                                <li>By <span><?php echo $track[0]['artist']; ?></span></li>
                                <li><?php echo $track[0]['releaseDate']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="template/img/blog/blog-5.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <!-- <span><a class="viewLink" href="video_view.php?id=<?php //echo $track[0]['id']; ?>">View</a></span> --
                            <h5><?php //echo $track[0]['title']; ?></h5>
                            <ul>
                                <li>By <span><?php //echo $track[0]['artist']; ?></span></li>
                                <li><?php //echo $track[0]['releaseDate']; ?></li>
                                <audio controls style="margin-top: 20px;">
                                    <source src="uploads/audio/<?php //echo $track[0]['source']; ?>">
                                </audio>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h3><?php echo $track[0]['title']; ?></h3>
                    By <span><?php echo ucwords($track[0]['artist']); ?></span>
                    | <?php echo $track[0]['releaseDate']; ?>
                    <br /><br />
                    <h4>Description:</h4>
                    <p><?php echo ucfirst($track[0]['description']); ?></p>

                    <br /><br />
                    <h4>Rating :</h4>
                    <?php 
                        $query = $pdo->prepare('SELECT AVG(rating) FROM videoratings WHERE videoId=:videoId');
                        $query->bindParam('videoId', $_GET['id'], PDO::PARAM_INT);
                        $query->execute();
                        $rate=$query->fetch(PDO::FETCH_ASSOC);
                        //var_dump($rate);
                    ?>
                    <p><?php echo $rate['AVG(rating)']; ?></p>

                    <h4>Rate this video</h4>
                    <br>
                    <form action="" method="post">
                        <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']; ?>">
                        <input type="hidden" name="videoId" value="<?php echo $_GET['id']; ?>">
                        <select required name="rating" id="" class="form-control">
                            <option value="1">1-star</option>
                            <option value="2">2-star</option>
                            <option value="3">3-star</option>
                            <option value="4">4-star</option>
                            <option value="5">5-star</option>
                        </select>
                        <br>
                        <button name="rateBtn" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <br><br><br>
            <div class="row">
                <h2>Comments</h2>
                <br><br><br>
                <form class="col-lg-12" action="" method="post">
                    <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']; ?>">
                    <input type="hidden" name="videoId" value="<?php echo $_GET['id']; ?>">
                    <div class="form-group">
                        <input class="form-control" required type="text" name="comment" placeholder="place a comment...">
                        <br>
                        <button name="commentBtn" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <table class="table table-hover">

                    <?php 
                    
                    
                    $query_comments = $pdo->prepare("SELECT videoreviews.id AS id, users.id AS userId, users.name AS user, videoreviews.comment AS comment, videoratings.rating AS rating from videoreviews LEFT JOIN users on videoreviews.userId=users.id LEFT JOIN videoratings ON videoreviews.videoId=videoratings.videoId where videoreviews.videoId=:videoId");
                    $query_comments->bindParam("videoId", $_GET['id'], PDO::PARAM_INT);
                    $query_comments->execute();
                    $comments = $query_comments->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($comments as $item) { ?>
                        <tr>
                            <td>
                                <h4><?php echo $item['user']; ?></h4>
                                <?php
                                    //session_start();
                                    if ($item['userId'] == $_SESSION['userId']) {
                                ?>
                                <div style="float: right;">
                                    <a class="link" href="video_view.php?action=edit&id=<?php echo $item['id']; ?>&videoId=<?php echo $_GET['id']; ?>" ><span class="fa fa-pencil"></span></a>&nbsp; | &nbsp;
                                    <a class="link" href="video_view.php?action=delete&id=<?php echo $item['id']; ?>&videoId=<?php echo $_GET['id']; ?>" ><span class="fa fa-trash"></span></a>
                                </div>
                                    <?php } ?>
                                <br />
                                <p><?php echo $item['rating']; ?></p>
                                <p><?php echo $item['comment']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    </table>
                </div>
            </div>
        </div>
</section>

<?php footer(); ?>

<!-- script to show modal -->
<?php if(isset($comment_edit)) { ?>
<script>
  $('#exampleModalCenter').modal('show');
</script>;
<?php } ?>
<!-- /script to show modal -->
