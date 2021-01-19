<?php
  include("dbcon.php");

  if (isset($_POST['loginBtn'])) {
    $query = $pdo->prepare('select * from users where email=:mail AND password=:password');
    $query->bindParam("mail", $_POST['mail'], PDO::PARAM_STR);
    $query->bindParam("password", $_POST['password'], PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user == false) {
      $error = "Invalid Email ID or Password!";
    }
    else {
      session_start();
      $_SESSION['userId'] = $user['id'];
      $id = $_SESSION['userId'];
      if ($user['userTypeId'] == 2) {
        header('location:admin/');
      }
      else {
        header('location:index.php');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="template_login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/css/util.css">
	<link rel="stylesheet" type="text/css" href="template_login/css/main.css">
<!--===============================================================================================-->

<!-- custom css -->
<?php include('style.php'); ?>

</head>
<body>

  <p>
	   <a style="position: absolute; z-index: 10; color: #b224ef; margin: 20px" href="javascript:history.go(-1)" title="Return to the previous page">
       &lt; Go back
     </a>
  </p>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('template_login/images/bg-01.jpg');">
			<div id="shakeit" class="wrap-login100">
				<form action="" method="post" class="login100-form validate-form">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-headset"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
          <?php if (isset($error)) { ?>
            <div align="center" style="margin: 20px; color: black">
              Invalid Email ID or Password!
            </div>
          <?php } ?>

					<div class="wrap-input100 validate-input" data-validate = "A valid email is required">
						<input class="input100" type="email" name="mail" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<!-- <div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div> -->

					<div class="container-login100-form-btn">
						<button name="loginBtn" type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

          <div class="text-center p-t-50">
            Not a member?
						<a class="txt1" href="register.php">
							Register now!
						</a>
					</div>

					<div class="text-center p-t-30">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="template_login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="template_login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="template_login/vendor/bootstrap/js/popper.js"></script>
	<script src="template_login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="template_login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="template_login/vendor/daterangepicker/moment.min.js"></script>
	<script src="template_login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="template_login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="template_login/js/main.js"></script>

</body>
</html>

<?php if (isset($error)) { ?>
  <script>
    document.getElementById('shakeit').classList.add('shakeit');
  </script>
<?php } ?>
