<!-- Database connection and template files included -->
<?php
  include("admin_template.php");
  include("../dbcon.php");
?>


<!-- Edit query -->
<?php
  if (isset($_POST['editBtn'])){
    $query = $pdo->prepare('update users set name=:name, email=:email, phoneNumber=:phoneNumber where id=:id');
    $query->bindParam('id', $_POST['id'], PDO::PARAM_INT);
    $query->bindParam('name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam('email', $_POST['email'], PDO::PARAM_STR);
    $query->bindParam('phoneNumber', $_POST['phoneNumber'], PDO::PARAM_STR);
    $query->execute();
    header("location:users.php");
  }
?>
<!-- /Edit query -->


<!-- Delete Query -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $query = $pdo->prepare('delete from users where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    header("location:users.php");
  }
?>
<!-- /Delete Query -->


<!-- Fetch Query -->
<?php
  $query = $pdo->query("select * from users");
  $users = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- /Fetch Query -->


<!-- Fetch query for editing -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'fetch') {
    $query = $pdo->prepare('select * from users where id=:id');
    $query->bindParam('id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    $user_edit = $query->fetch(PDO::FETCH_ASSOC);
  }
?>
<!-- /Fetch query -->


<!-- insert query -->
<?php
  if (isset($_POST['addNew']) && $_POST['name'] != "" && $_POST['email'] != "" && $_POST['phoneNumber'] != "") {
    $password_default = "sound_123";
    $userTypeId = 1;
    $query = $pdo->prepare('insert into users(name, email, password, phoneNumber, userTypeId) values(:name, :email, :password, :phoneNumber, :userTypeId)');
    $query->bindParam('name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam('email', $_POST['email'], PDO::PARAM_STR);
    $query->bindParam('password', $password_default, PDO::PARAM_STR);
    $query->bindParam('phoneNumber', $_POST['phoneNumber'], PDO::PARAM_INT);
    $query->bindParam('userTypeId', $userTypeId, PDO::PARAM_INT);
    $query->execute();
    header("location:users.php");
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
        <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
        <button type="button" onclick="window.location.href='users.php'" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="users.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?php echo $user_edit['id']; ?>">
          <label>Name</label>
          <input class="form-control" type="text" name="name" value="<?php echo $user_edit['name']; ?>">
          <label>Email</label>
          <input class="form-control" type="email" name="email" value="<?php echo $user_edit['email']; ?>">
          <label>Ph Number</label>
          <input class="form-control" type="number" name="phoneNumber" value="<?php echo $user_edit['phoneNumber']; ?>">
        </div>
        <div class="modal-footer">
          <button type="button" onclick="window.location.href='users.php'" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="editBtn" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Edit modal -->


<div class="container-fluid">

  <h1>Users</h1>

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
                    <!-- <th scope="col">ID</th> -->
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone #</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <h3>Add User</h3>
                <form class="" action="" method="post">
                    <tr>
                        <!-- <th scope="row"> <input class="form-control" type="text" disabled name="id" value=""> </th> -->
                        <td><input required class="form-control" type="text" name="name" value=""></td>
                        <td><input required class="form-control" onkeyup="checkEmail(this.value)" type="email" name="email" value=""></td>
                        <td><input required class="form-control" type="number" name="phoneNumber" value=""></td>
                        <td>
                            <input class="btn btn-anchor" name="cancel" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" value="Cancel"> |
                            <input id="addUserBtn" class="btn btn-anchor" name="addNew" type="submit" value="Save changes">
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
        <div align="center">
            <p id="error" style="color: red; margin-bottom: 10px; font-weight: bold; display: none">
                A user with this email already exists.
            </p>
        </div>
    </div>
  </div>
<!-- /Add new button + dropdown -->

<!-- data display -->
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone #</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <!-- Displaying data -->
    <?php foreach ($users as $item) { ?>
        <tr>
          <th scope="row"><?php echo $item["id"] ?></th>
          <td><?php echo ucwords($item["name"]) ?></td>
          <td><?php echo $item["email"] ?></td>
          <td><?php echo $item["phoneNumber"] ?></td>
          <td><a href="users.php?action=fetch&id=<?php echo $item['id']; ?>">Edit</a> | 
          <a href="users.php?action=delete&id=<?php echo $item['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
  </tbody>
</table>

</div>
<!-- /data display -->



<!-- Added Footer -->
<?php footer(); ?>


<!-- script to show modal -->
<?php if(isset($user_edit)) { ?>
  <script>
    $('#exampleModalCenter').modal('show');
  </script>;
<?php } ?>
<!-- /script to show modal -->

<!-- script to check if email exists -->

<?php $user_emails = array_column($users, 'email'); ?>

<script>
  function checkEmail(params) {
    var user_emails = <?php echo json_encode($user_emails); ?>;
    var email = params;
    var url = "../api.php?method=checkEmail&email=" + email + "&user_emails=" + user_emails;
    var xhr = new XMLHttpRequest;
    xhr.open("get", url);
    xhr.onload = function () {
      console.log(xhr.response);
      if (xhr.response == 'true') {
        document.getElementById('error').style.display = "block";
        document.getElementById("addUserBtn").disabled = true;
      } else {
        document.getElementById('error').style.display = "none";
        document.getElementById("addUserBtn").disabled = false;
      }
    }
    xhr.send();
  }
</script>

<!-- /script to check if email exists -->
