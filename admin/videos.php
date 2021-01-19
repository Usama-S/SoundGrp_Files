<!-- Database connection and template files included -->
<?php
  include("admin_template.php");
  include("../dbcon.php");
?>


<!-- Edit query -->
<?php
  if (isset($_POST['editBtn'])){
    $query = $pdo->prepare('update videos set title=:title, artistId=:artistId, genreId=:genreId, languageId=:languageId, releaseDate=:releaseDate, description=:description, source=:source where id=:id');
    
    $query->bindParam('id', $_POST['id'], PDO::PARAM_INT);
    $query->bindParam('title', $_POST['title'], PDO::PARAM_STR);
    $query->bindParam('artistId', $_POST['artistId'], PDO::PARAM_STR);
    $query->bindParam('genreId', $_POST['genreId'], PDO::PARAM_STR);
    $query->bindParam('languageId', $_POST['languageId'], PDO::PARAM_STR);
    $query->bindParam('releaseDate', $_POST['releaseDate'], PDO::PARAM_STR);
    $query->bindParam('description', $_POST['description'], PDO::PARAM_STR);
    $query->bindParam('source', $_POST['source'], PDO::PARAM_STR);
    
    if ($_POST['albumId'] == ""){
      $query = $pdo->prepare('update videos set albumId=NULL where id=:id');
      $query->bindParam('id', $_POST['id'], PDO::PARAM_INT);
      $query->execute();
    } else {
      $query = $pdo->prepare('update videos set albumId=:albumId where id=:id');
      $query->bindParam('albumId', $_POST['albumId'], PDO::PARAM_INT);
      $query->bindParam('id', $_POST['id'], PDO::PARAM_INT);
      $query->execute();
    }

    $query->execute();
    header("location:videos.php");
  }
?>
<!-- /Edit query -->


<!-- Delete Query -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $query = $pdo->prepare('delete from music where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    header("location:videos.php");
  }
?>
<!-- /Delete Query -->


<!-- Fetch Query -->
<?php
  $query = $pdo->query("SELECT videos.id, videos.title, artists.name AS artist, albums.name AS album, genres.name AS genre, languages.language AS language, videos.releaseDate, videos.description, videos.source FROM videos INNER JOIN artists ON videos.artistId = artists.id LEFT JOIN albums ON videos.albumId = albums.id INNER JOIN genres ON videos.genreId = genres.id INNER JOIN languages ON videos.languageId = languages.id");
  $music = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- /Fetch Query -->


<!-- Fetch query for editing -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'fetch') {
    $query = $pdo->prepare('select * from videos where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    $video_edit = $query->fetch(PDO::FETCH_ASSOC);
  }
?>
<!-- /Fetch query -->


<!-- insert query -->
<?php
  if (isset($_POST['addNew'])) {

    //renaming the file if the one already exists with the same name
    // $name = pathinfo($_FILES['audioFile']['name'], PATHINFO_FILENAME);
    // $extension = pathinfo($_FILES['audioFile']['name'], PATHINFO_EXTENSION);
    // $increment = '';
    // while(file_exists("../uploads/audio/" . $name . $increment . '.' . $extension)) {
    //     $increment++;
    // }
    // $_FILES['audioFile']['name'] = $name . $increment . '.' . $extension;

    //move_uploaded_file($_FILES["audioFile"]["tmp_name"], "../uploads/audio/" . $_FILES["audioFile"]["name"]);

    $query = $pdo->prepare('insert into videos(title, artistId, genreId, languageId, releaseDate, description, source) values(:title, :artistId, :genreId, :languageId, :releaseDate, :description, :source)');
    $query->bindParam('title', $_POST['title'], PDO::PARAM_STR);
    $query->bindParam('artistId', $_POST['artistId'], PDO::PARAM_INT);
    //$query->bindParam('albumId', $_POST['albumId'], PDO::PARAM_INT);
    $query->bindParam('genreId', $_POST['genreId'], PDO::PARAM_INT);
    $query->bindParam('languageId', $_POST['languageId'], PDO::PARAM_INT);
    $query->bindParam('releaseDate', $_POST['releaseDate'], PDO::PARAM_STR);
    $query->bindParam('description', $_POST['description'], PDO::PARAM_STR);
    $query->bindParam('source', $_POST['source'], PDO::PARAM_STR);
    $query->execute();

    $query = $pdo->query('select LAST_INSERT_ID()');
    $id = $query->fetch();

    if ($_POST['albumId'] == ""){
      $query = $pdo->prepare('update videos set albumId=NULL where id=:id');
      $query->bindParam('id', $id['LAST_INSERT_ID()'], PDO::PARAM_INT);
      $query->execute();
    } else {
      $query = $pdo->prepare('update videos set albumId=:albumId where id=:id');
      $query->bindParam('albumId', $_POST['albumId'], PDO::PARAM_INT);
      $query->bindParam('id', $id['LAST_INSERT_ID()'], PDO::PARAM_INT);
      $query->execute();
    }
    
    header("location:videos.php");
  }
?>
<!-- /insert query -->


<!-- calling header from the _template.php -->
<?php head(); ?>


<!-- inlcuding custom css file -->
<?php include("../style.php"); ?>

<!-- page level styling -->
<style>
  #display td, #display th {
    padding-right: 40px !important;
  }
</style>
<!-- /page level styling -->

<!-- Edit modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Video</h5>
        <button type="button" onclick="window.location.href='videos.php'" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="videos.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?php echo $video_edit['id']; ?>">
          
          <div class="form-group">
            <label>Title</label>
            <input class="form-control" type="text" name="title" value="<?php echo ucwords($video_edit['title']); ?>">
          </div>
          
          <!-- artist -->
          <div class="form-group">
            <label>Artist</label>
            <select required name="artistId" class="form-control">
              <option value="">--select--</option>
              <?php 
                $query = $pdo->query('select * from artists');
                $artists = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($artists as $item) {
                ?>
                  <option <?php if ($video_edit['artistId'] == $item['id']) { echo "selected"; } ?> value="<?php echo $item["id"]; ?>"><?php echo ucwords($item["name"]); ?></option>
                <?php
                }
                ?>
            </select>
          </div>
          <!-- album -->
          <div class="form-group">
            <label>Album</label>
            <select name="albumId" class="form-control">
              <option value="">--select--</option>
              <?php 
                $query = $pdo->query('select * from albums');
                $albums = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($albums as $item) {
              ?>
              <option <?php if ($video_edit['albumId'] == $item['id']) { echo "selected"; } ?> value="<?php echo $item["id"]; ?>"><?php echo ucwords($item["name"]); ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          
          <!-- genre -->
          <div class="form-group">
            <label>Genre</label>
            <select required name="genreId" class="form-control">
              <option value="">--select--</option>
              <?php 
                $query = $pdo->query('select * from genres');
                $genres = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($genres as $item) {
              ?>
              <option <?php if ($video_edit['genreId'] == $item['id']) { echo "selected"; } ?> value="<?php echo $item["id"]; ?>"><?php echo ucwords($item["name"]); ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <!-- language -->
          <div class="form-group">
            <label>Language</label>
            <select required name="languageId" class="form-control">
              <option value="">--select--</option>
              <?php 
                $query = $pdo->query('select * from languages');
                $languages = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($languages as $item) {
              ?>
              <option <?php if ($video_edit['languageId'] == $item['id']) { echo "selected"; } ?> value="<?php echo $item["id"]; ?>"><?php echo ucwords($item["language"]); ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <!-- releaseDate -->
          <div class="form-group">
            <label>Release Date</label>
            <input required class="form-control" type="date" name="releaseDate" value="<?php echo strftime('%Y-%m-%d', strtotime($video_edit['releaseDate'])); ?>">
          </div>  
          
          <!-- description -->
          <div class="form-group">
            <label>Description</label>
            <input class="form-control" type="text" name="description" value="<?php echo $video_edit['description']; ?>">
          </div>

          <!-- video source -->
          <div class="form-group">
            <label>Video Source</label>
            <input class="form-control" type="text" name="source" value="<?php echo $video_edit['source']; ?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" onclick="window.location.href='videos.php'" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="editBtn" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Edit modal -->


<div class="container-fluid">

  <h1>Videos</h1>

<!-- Add new button + dropdown -->
  <div align="right">
    <a style="margin: 10px;" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      Add New
    </a>
  </div>
  <br>
  <div style="margin-bottom: 10px;" class="collapse" id="collapseExample">
    <div class="card card-body" style="overflow-x: scroll !important;">
      <table class="table table-hover" style="width: max-content;">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Artist</th>
            <th scope="col">Album</th>
            <th scope="col">Genre</th>
            <th scope="col">Language</th>
            <th scope="col">Release Date</th>
            <th scope="col">Desctiption</th>
            <th scope="col">Video Source</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <h3>Add Video</h3>
          <form class="" action="" method="post" enctype="multipart/form-data">
            <tr>
              <td><input required class="form-control" type="text" name="title" value=""></td>
              <!-- artists -->
              <td>
                <select required name="artistId" class="form-control">
                  <option value="">--select--</option>
                  <?php 
                    $query = $pdo->query('select * from artists');
                    $artists = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($artists as $item) {
                  ?>
                  <option value="<?php echo $item["id"]; ?>"><?php echo $item["name"]; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td>
              <!-- album -->
              <td>
                <select name="albumId" class="form-control">
                  <option value="">--select--</option>
                  <?php 
                    $query = $pdo->query('select * from albums');
                    $albums = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($albums as $item) {
                  ?>
                  <option value="<?php echo $item["id"]; ?>"><?php echo $item["name"]; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td>
              <!-- genre -->
              <td>
                <select required name="genreId" class="form-control">
                  <option value="">--select--</option>
                  <?php 
                    $query = $pdo->query('select * from genres');
                    $genres = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($genres as $item) {
                  ?>
                  <option value="<?php echo $item["id"]; ?>"><?php echo $item["name"]; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td>
              <!-- language -->
              <td>
                <select required name="languageId" class="form-control">
                  <option value="">--select--</option>
                  <?php 
                    $query = $pdo->query('select * from languages');
                    $languages = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($languages as $item) {
                  ?>
                  <option value="<?php echo $item["id"]; ?>"><?php echo $item["language"]; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td>
              <!-- release date -->
              <td><input required class="form-control" type="date" name="releaseDate" value=""></td>
              <!-- description -->
              <td><input required class="form-control" type="text" name="description" value=""></td>
              <!-- video source -->
              <td>
                <input required class="form-control" type="text" name="source" value="">
              </td>
                <td>
                  <input class="btn btn-anchor" name="cancel" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" value="Cancel"> |
                  <input id="addNewBtn" class="btn btn-anchor" name="addNew" type="submit" value="Save changes">
                </td>
            </tr>
            </form>
          </tbody>
        </table>
    </div>
  </div>
<!-- /Add new button + dropdown -->

<!-- data display -->
<div style="overflow-x: scroll !important;">
  <table id="display" class="table table-hover" style="width: max-content;">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Artist</th>
        <th scope="col">Album</th>
        <th scope="col">Genre</th>
        <th scope="col">Language</th>
        <th scope="col">Release Date</th>
        <th scope="col">Desctiption</th>
        <th scope="col">Video</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <!-- Displaying data -->
      <?php foreach ($music as $item) { ?>
          <tr>
            <th scope="row"><?php echo $item["id"] ?></th>
            <td><?php echo ucwords($item["title"]) ?></td>
            <td><?php echo ucwords($item["artist"]) ?></td>
            <td><?php echo ucwords($item["album"]) ?></td>
            <td><?php echo ucwords($item["genre"]) ?></td>
            <td><?php echo ucwords($item["language"]) ?></td>
            <td><?php echo ucwords($item["releaseDate"]) ?></td>
            <td><?php echo ucwords($item["description"]) ?></td>
            <td>
                <a href="<?php echo $item['source']; ?>" target="_blank"><?php echo $item['source']; ?></a>
            </td>
            <td><a href="videos.php?action=fetch&id=<?php echo $item['id']; ?>">Edit</a> | 
            <a href="videos.php?action=delete&id=<?php echo $item['id']; ?>">Delete</a></td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</div>
<!-- /data display -->



<!-- Added Footer -->
<?php footer(); ?>

<!-- script to show modal -->
<?php if(isset($video_edit)) { ?>
<script>
  $('#exampleModalCenter').modal('show');
</script>;
<?php } ?>
<!-- /script to show modal -->

<!-- script to check file type -->
<!-- <script>
  function checkFile(file) {
    
    var allowedTypes = /(\.mp4)$/i;

    if (!(allowedTypes.exec(file.value))) {
      document.getElementById('error').style.display = "block";
      document.getElementById('addNewBtn').disabled = true;
      file.value = "";
    }else {
      document.getElementById('error').style.display = "none";
      document.getElementById('addNewBtn').disabled = false;
    }
  }
</script> -->
<!-- /script to check file type -->

<!-- script to pause all the audios except the one which is clicked -->
<!-- <script>
  $('audio').each(function () {
    var myAudio = this;
    this.addEventListener('play', function () {
      $('audio').each(function () {
        if (!(this === myAudio)) {
          this.pause();
        }
      });
    });
  });
</script> -->
<!-- /script to pause all the audios except the one which is clicked -->
