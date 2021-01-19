<?php
  include 'dbcon.php';
  if (isset($_POST['registerBtn'])){
    $query = $pdo->prepare('insert into users(name, email, password, phoneNumber, userTypeId) values(:name, :mail, :password, :phoneNo, 1)');
    $query->bindParam('name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam('mail', $_POST['mail'], PDO::PARAM_STR);
    $query->bindParam('password', $_POST['pass1'], PDO::PARAM_STR);
    $query->bindParam('phoneNo', $_POST['phoneNo'], PDO::PARAM_STR);
    $query->execute();
  }

?>

<?php
  include("_template.php");
  head();
  include 'style.php';
?>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" style="margin: auto; text-align: center">
                    <div class="contact__form">
                        <div style="margin: 40px;" class="section-title">
                            <h2>Create Account</h2>
                        </div>
                        <form action="" method="post">
                            <div id="register_form" class="input__list">
                                <input class="input-full" name="name" type="text" placeholder="Name" required>
                                <input class="input-full" name="mail" type="email" placeholder="Email" required>
                                <input class="input-half" name="pass1" id="pass1" type="password" placeholder="Password" required>
                                <input class="input-half" name="pass2" id="pass2" oninput="checkToSubmit(this.value)" type="password" placeholder="Re-enter Password" required>
                                <p id="error" style="color: red; margin-bottom: 10px; display: none">
                                  The passwords don't match!
                                </p>
                                <input class="input-full" name="phoneNo" type="number" placeholder="Phone Number" required>
                            </div>
                            <button style="margin-top: 20px; width: 200px; border-radius: 20px;" id="registerBtn" name="registerBtn" type="submit" class="site-btn">
                              Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->


<?php footer(); ?>

<script type="text/javascript">
  function checkToSubmit(pass2){
    pass1 = document.getElementById('pass1').value;
    if (pass1 == pass2) {
      document.getElementById('error').style.display = "none";
      document.getElementById("registerBtn").disabled = false;
    } else {
      document.getElementById('error').style.display = "block";
      document.getElementById("registerBtn").disabled = true;
    }
  }
</script>
