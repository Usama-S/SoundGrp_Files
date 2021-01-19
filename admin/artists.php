<!-- Database connection and template files included -->
<?php
  include("admin_template.php");
  include("../dbcon.php");
?>


<!-- Edit query -->
<?php
  if (isset($_POST['editBtn'])){
    $query = $pdo->prepare('update artists set name=:name where id=:id');
    $query->bindParam('id', $_POST['id'], PDO::PARAM_INT);
    $query->bindParam('name', $_POST['name'], PDO::PARAM_STR);
    $query->execute();
    header("location:artists.php");
  }
?>
<!-- /Edit query -->


<!-- Delete Query -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $query = $pdo->prepare('delete from artists where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    header("location:artists.php");
  }
?>
<!-- /Delete Query -->


<!-- Fetch Query -->
<?php
  $query = $pdo->query("select * from artists");
  $artists = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- /Fetch Query -->


<!-- Fetch query for editing -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'fetch') {
    $query = $pdo->prepare('select * from artists where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    $artist = $query->fetch(PDO::FETCH_ASSOC);
  }
?>
<!-- /Fetch query -->


<!-- insert query -->
<?php
  if (isset($_POST['addNew']) && $_POST['name'] != "") {
    $query = $pdo->prepare('insert into artists(name) values(:name)');
    $query->bindParam('name', $_POST['name'], PDO::PARAM_STR);
    $query->execute();
    header("location:artists.php");
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
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Artist</h5>
        <button type="button" onclick="window.location.href='artists.php'" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="artists.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?php echo $artist['id']; ?>">
          <label>Name</label>
          <input class="form-control" type="text" name="name" value="<?php echo $artist['name']; ?>">
        </div>
        <div class="modal-footer">
          <button type="button" onclick="window.location.href='artists.php'" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="editBtn" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Edit modal -->


<div class="container-fluid">

  <h1>Artists</h1>

<!-- Add new button + dropdown -->
  <div align="right">
    <a style="margin: 10px;" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      Add New
    </a>
  </div>
  <br>
  <div style="margin-bottom: 10px;" class="collapse" id="collapseExample">
    <div class="card card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <h3>Add Artist</h3>
          <form class="" action="" method="post">
            <tr>
              <th scope="row"> <input class="form-control" type="text" disabled name="id" value=""> </th>
              <td><input required class="form-control" type="text" name="name" value=""></td>
                <td>
                  <input class="btn btn-anchor" name="cancel" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" value="Cancel"> |
                  <input class="btn btn-anchor" name="addNew" type="submit" value="Save changes">
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
      <th scope="col">Name</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <!-- Displaying data -->
    <?php foreach ($artists as $item) { ?>
        <tr>
          <th scope="row"><?php echo $item["id"] ?></th>
          <td><?php echo ucwords($item["name"]) ?></td>
          <td><a href="artists.php?action=fetch&id=<?php echo $item['id']; ?>">Edit</a> | 
          <a href="artists.php?action=delete&id=<?php echo $item['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
  </tbody>
</table>

</div>
<!-- /data display -->



<!-- Added Footer -->
<?php footer(); ?>


<!-- script to show modal -->
<?php if(isset($artist)) { ?>
<script>
  $('#exampleModalCenter').modal('show');
</script>;
<?php } ?>
<!-- /script to show modal -->
