<!-- Database connection and template files included -->
<?php
  include("admin_template.php");
  include("../dbcon.php");
?>


<!-- Edit query -->
<?php
  if (isset($_POST['editBtn'])){
    $query = $pdo->prepare('update albums set name=:name, artistId=:artistId, description=:description, coverPhoto=:cover where id=:id');
    $query->bindParam('id', $_POST['id'], PDO::PARAM_INT);
    $query->bindParam('name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam('artistId', $_POST['artistId'], PDO::PARAM_INT);
    $query->bindParam('description', $_POST['description'], PDO::PARAM_STR);
    $cover = "";
    if (isset($_FILES['cover'])) {
      //uploading new file
      //renaming the file if the one already exists with the same name
      $name = pathinfo($_FILES['cover']['name'], PATHINFO_FILENAME);
      $extension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
      $increment = '';
      while(file_exists("../uploads/img/" . $name . $increment . '.' . $extension)) {
          $increment++;
      }
      $_FILES['cover']['name'] = $name . $increment . '.' . $extension;

      move_uploaded_file($_FILES["cover"]["tmp_name"], "../uploads/img/" . $_FILES["cover"]["name"]);

      $cover = $_FILES["cover"]["name"];

    } else {
      $cover = $_POST['cover_old'];
    }
    $query->bindParam('cover', $cover, PDO::PARAM_STR);
    $query->execute();
    header("location:albums.php");
  }
?>
<!-- /Edit query -->


<!-- Delete Query -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $query = $pdo->prepare('delete from albums where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    header("location:albums.php");
  }
?>
<!-- /Delete Query -->


<!-- Fetch Query -->
<?php
  //$query = $pdo->query("select * from albums");
  $query = $pdo->query("SELECT albums.id, albums.name, artists.name AS artist, albums.description, albums.coverPhoto FROM albums INNER JOIN artists ON albums.artistId = artists.id");
  $albums = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- /Fetch Query -->


<!-- Fetch query for editing -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'fetch') {
    $query = $pdo->prepare('select * from albums where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    $album = $query->fetch(PDO::FETCH_ASSOC);
  }
?>
<!-- /Fetch query -->


<!-- insert query -->
<?php
  if (isset($_POST['addNew'])) {
    
    //renaming the file if the one already exists with the same name
    $name = pathinfo($_FILES['coverPhoto']['name'], PATHINFO_FILENAME);
    $extension = pathinfo($_FILES['coverPhoto']['name'], PATHINFO_EXTENSION);
    $increment = '';
    while(file_exists("../uploads/img/" . $name . $increment . '.' . $extension)) {
        $increment++;
    }
    $_FILES['coverPhoto']['name'] = $name . $increment . '.' . $extension;

    move_uploaded_file($_FILES["coverPhoto"]["tmp_name"], "../uploads/img/" . $_FILES["coverPhoto"]["name"]);

    $query = $pdo->prepare('insert into albums(name, artistId, description, coverPhoto) values(:name, :artistId, :description, :coverPhoto)');
    $query->bindParam('name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam('artistId', $_POST['artistId'], PDO::PARAM_STR);
    $query->bindParam('description', $_POST['description'], PDO::PARAM_STR);
    $query->bindParam('coverPhoto', $_FILES['coverPhoto']['name'], PDO::PARAM_STR);
    $query->execute();
    header("location:albums.php");
  }
?>
<!-- /insert query -->


<!-- calling header from the _template.php -->
<?php head(); ?>


<!-- inlcuding custom css file -->
<?php include("../style.php"); ?>


<!-- Edit modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Album</h5>
        <button type="button" onclick="window.location.href='albums.php'" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="albums.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?php echo $album['id']; ?>">

          <div class="form-group">
            <label>Name</label>
            <input class="form-control" type="text" name="name" value="<?php echo $album['name']; ?>">
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
                  <option <?php if ($album['artistId'] == $item['id']) { echo "selected"; } ?> value="<?php echo $item["id"]; ?>"><?php echo ucwords($item["name"]); ?></option>
                <?php
                }
                ?>
            </select>
          </div>
          
          <!-- description -->
          <div class="form-group">
            <label>Description</label>
            <input class="form-control" type="text" name="description" value="<?php echo $album['description']; ?>">
          </div>

          <!-- cover photo -->
          <div class="form-group">
            <label>Cover Photo</label>
            <span style="color: red">(Leave blank if you don not want to change)</span>
            <input type="file" name="cover" value="">
            <input type="text" name="cover_old" hidden value="<?php echo $album['coverPhoto']; ?>">
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" onclick="window.location.href='albums.php'" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="editBtn" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Edit modal -->


<div class="container-fluid">

  <h1>Albums</h1>

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
            <th scope="col">ID</th>
            <th scope="col">Album</th>
            <th scope="col">Artist</th>
            <th scope="col">Description</th>
            <th scope="col">Cover Photo</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <h3>Add Album</h3>
          <form class="" action="" method="post" enctype="multipart/form-data">
            <tr>
              <th scope="row"> <input class="form-control" type="text" disabled name="id" value=""> </th>
              <td><input required class="form-control" type="text" name="name" value=""></td>
              <td>
                <select required name="artistId" class="form-control">
                  <option value="">--select--</option>
                  <?php 
                    $query = $pdo->query('select * from artists');
                    $artists = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($artists as $item) {
                    ?>
                      <option value="<?php echo $item["id"]; ?>"><?php echo ucwords($item["name"]); ?></option>
                    <?php
                    }
                    ?>
                </select>
              </td>
              <td><input required class="form-control" type="text" name="description" value=""></td>
              <td>
                <input onchange="checkFile(this)" required class="form-control" type="file" accept=".jpg, .png" name="coverPhoto" style="overflow: hidden">
                  <br/>
                  <div align="center">
                    <p id="error" style="color: red; margin-bottom: 10px; font-weight: bold; display: none">
                        Only .jpg and .png files are supported!
                    </p>
                  </div>
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
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Album</th>
      <th scope="col">Artist</th>
      <th scope="col">Description</th>
      <th scope="col">Cover Photo</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <!-- Displaying data -->
    <?php foreach ($albums as $item) { ?>
        <tr>
          <th scope="row"><?php echo $item["id"] ?></th>
          <td><?php echo ucwords($item["name"]) ?></td>
          <td><?php echo ucwords($item["artist"]) ?></td>
          <td><?php echo ucwords($item["description"]) ?></td>
          <td><image src="../uploads/img/<?php echo ucwords($item["coverPhoto"]) ?>" height="50" width="50"/></td>
          <td><a href="viewalbum.php?id=<?php echo $item['id']; ?>">View</a> | 
          <a href="albums.php?action=fetch&id=<?php echo $item['id']; ?>">Edit</a> | 
          <a href="albums.php?action=delete&id=<?php echo $item['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
  </tbody>
</table>

</div>
<!-- /data display -->



<!-- Added Footer -->
<?php footer(); ?>


<!-- script to show modal -->
<?php if(isset($album)) { ?>
<script>
  $('#exampleModalCenter').modal('show');
</script>;
<?php } ?>
<!-- /script to show modal -->


<!-- script to check file type -->
<script>
  function checkFile(file) {
    
    var allowedTypes = /(\.jpg|\.png)$/i;

    if (!(allowedTypes.exec(file.value))) {
      document.getElementById('error').style.display = "block";
      document.getElementById('addNewBtn').disabled = true;
      file.value = "";
    }else {
      document.getElementById('error').style.display = "none";
      document.getElementById('addNewBtn').disabled = false;
    }
  }
</script>
<!-- /script to check file type -->