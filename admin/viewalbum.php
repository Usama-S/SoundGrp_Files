
<?php 
    include "admin_template.php";
    include "../dbcon.php";
?>

<!-- Insert Query -->
<?php
  if (isset($_POST['addNew'])) {
    $query = $pdo->prepare('update music set albumId=:albumId where id=:id');
    $query->bindParam('albumId', $_POST['albumId'], PDO::PARAM_INT);
    $query->bindParam('id', $_POST['track'], PDO::PARAM_INT);
    $query->execute();
    header("Refresh:0");
  }
?>
<!-- /Insert Query -->

<!-- Remove from album -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $query = $pdo->prepare('update music set albumId=NULL where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    header('location: '. $_SERVER['HTTP_REFERER']);
  }
?>
<!-- /Remove from album -->


<!-- Fetch Query -->
<?php
  $query = $pdo->prepare("SELECT music.id, music.title, artists.name AS artist, albums.name AS album, genres.name AS genre, languages.language AS language, music.releaseDate, music.description, music.source FROM music INNER JOIN artists ON music.artistId = artists.id INNER JOIN albums ON music.albumId = albums.id INNER JOIN genres ON music.genreId = genres.id INNER JOIN languages ON music.languageId = languages.id WHERE music.albumId=:albumid");
  //$query = $pdo->prepare("SELECT * FROM music WHERE albumId=:albumid");
  $query->bindParam("albumid", $_GET['id'], PDO::PARAM_INT);
  $query->execute();
  $music = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- /Fetch Query -->

<?php head(); ?>

<!-- inlcuding custom css file -->
<?php include("../style.php"); ?>

<div class="container-fluid">

  <h1><?php echo ucwords($music[0]['album']); ?></h1>


<!-- Add new button + dropdown -->
<div align="right">
    <a style="margin: 10px;" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      Add New
    </a>
  </div>
  <br>
  <div style="margin-bottom: 10px;" class="collapse" id="collapseExample">
    <div class="card card-body" style="overflow-x: scroll !important;">
      <table class="table table-hover" style="">
        <thead>
          <tr>
            <th scope="col">Track</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <h3>Add Music</h3>
          <form class="" action="" method="post">
            <tr>
              <td><input required hidden class="form-control" type="text" name="albumId" value="<?php echo $_GET['id']; ?>"></td>
              <!-- track -->
              <td>
                <select required name="track" class="form-control">
                  <option value="">--select--</option>
                  <?php 
                    $query = $pdo->query('select * from music where albumId IS NULL');
                    $tracks = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($tracks as $item) {
                  ?>
                  <option value="<?php echo $item["id"]; ?>"><?php echo $item["title"]; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td>
              <td>
                <input class="btn btn-anchor" name="cancel" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" value="Cancel"> |
                <input id="addNewBtn" class="btn btn-anchor" name="addNew" type="submit" value="Add">
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
        <th scope="col">Genre</th>
        <th scope="col">Language</th>
        <th scope="col">Release Date</th>
        <th scope="col">Desctiption</th>
        <th scope="col">Audio</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <!-- Displaying data -->
      <?php foreach ($music as $item) { ?>
          <tr>
            <th scope="row"><?php echo $item["id"] ?></th>
            <td><?php echo ucwords($item["title"]) ?></td>
            <td><?php echo ucwords($item["genre"]) ?></td>
            <td><?php echo ucwords($item["language"]) ?></td>
            <td><?php echo ucwords($item["releaseDate"]) ?></td>
            <td><?php echo ucwords($item["description"]) ?></td>
            <td>
            <audio controls>
              <source src="<?php echo "../uploads/audio/".$item["source"]; ?>">
            </audio>
            </td>
            <td><a href="viewalbum.php?action=remove&id=<?php echo $item['id']; ?>">Remove</a></td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</div>
<!-- /data display -->

<?php footer(); ?>