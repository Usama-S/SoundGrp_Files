<?php 
include("dbcon.php");
//$user='';
session_start();

// if (isset($_SESSION['userId'])) {
//     $query_user = $pdo->prepare('SELECT * FROM users WHERE id=:id');
//     $query_user->bindParam('id', $_SESSION['userId'], PDO::PARAM_INT);
//     $query_user->execute();
//     $user=$query_user->fetch(PDO::FETCH_ASSOC);
//     // var_dump($user);
// }

//echo $user['name'];

?>

<?php function head(){

    include("dbcon.php");
    $query_genre = $pdo->query('SELECT * FROM genres');
    $genres = $query_genre->fetchAll(PDO::FETCH_ASSOC);
    
    $query_artists = $pdo->query('SELECT * FROM artists');
    $artists = $query_artists->fetchAll(PDO::FETCH_ASSOC);

    ?>


  <!DOCTYPE html>
  <html lang="zxx">

  <head>
      <meta charset="UTF-8">
      <meta name="description" content="DJoz Template">
      <meta name="keywords" content="DJoz, unica, creative, html">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>DJoz | Template</title>

      <!-- Google Font -->
      <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">

      <!-- Css Styles -->
      <link rel="stylesheet" href="template/css/bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="template/css/font-awesome.min.css" type="text/css">
      <link rel="stylesheet" href="template/css/barfiller.css" type="text/css">
      <link rel="stylesheet" href="template/css/nowfont.css" type="text/css">
      <link rel="stylesheet" href="template/css/rockville.css" type="text/css">
      <link rel="stylesheet" href="template/css/magnific-popup.css" type="text/css">
      <link rel="stylesheet" href="template/css/owl.carousel.min.css" type="text/css">
      <link rel="stylesheet" href="template/css/slicknav.min.css" type="text/css">
      <link rel="stylesheet" href="template/css/style.css" type="text/css">
  </head>

  <body>
      <!-- Page Preloder -->
      <div id="preloder">
          <div class="loader"></div>
      </div>


      <?php
        // echo $user['name'];
      ?>

      
      <!-- Header Section Begin -->
      <header id="header_nav" class="header header--normal">
          <div class="container">
              <div class="row">
                  <div class="col-lg-2 col-md-2">
                      <div class="header__logo">
                          <a href="index.php"><img src="template/img/logo.png" alt=""></a>
                      </div>
                  </div>
                  <div class="col-lg-10 col-md-10">
                      <div class="header__nav">
                          <nav class="header__menu mobile-menu">
                              <ul>
                                  <li id="nav_home"><a href="index.php">Home</a></li>
                                  <li id="nav_about"><a href="about.php">About</a></li>

                                  <li id="nav_categories"><a href="#">Categories</a>
                                      <ul class="dropdown">
                                      <?php foreach ($genres as $item) { ?>
                                        <li><a href="categories.php?id=<?php echo $item['id']; ?>"><?php echo $item['name']; ?></a></li>
                                      <?php } ?>  
                                      </ul>
                                  </li>

                                  <li id="nav_artists"><a href="#">Artists</a>
                                      <ul class="dropdown">
                                      <?php foreach ($artists as $item) { ?>
                                        <li><a href="artists.php?id=<?php echo $item['id']; ?>"><?php echo $item['name']; ?></a></li>
                                      <?php } ?>  
                                      </ul>
                                  </li>

                                  <li id="nav_tracks"><a href="tracks.php">Audios</a></li>
                                  <li id="nav_videos"><a href="videos.php">Videos</a></li>
                                  <!-- <li><a href="#">Pages</a>
                                      <ul class="dropdown">
                                          <li><a href="template/about.html">About</a></li>
                                          <li><a href="template/blog.html">Blog</a></li>
                                          <li><a href="template/blog-details.html">Blog Details</a></li>
                                      </ul>
                                  </li> -->

                                  <!-- user dropdown -->
                                  
                                  <?php 
                                    include("dbcon.php");
                                    $user='';

                                    if (isset($_SESSION['userId'])) {
                                        $query_user = $pdo->prepare('SELECT * FROM users WHERE id=:id');
                                        $query_user->bindParam('id', $_SESSION['userId'], PDO::PARAM_INT);
                                        $query_user->execute();
                                        $user=$query_user->fetch(PDO::FETCH_ASSOC);
                                        //var_dump($user);
                                    //}

                                    //echo $user['name'];
                                    //if (isset($user)) { ?>
                                    <li id="nav_about"><a href="search.php"><span class="fa fa-search"></span></a></li>
                                    <li style="border-left: 2px solid white; padding-left: 20px;" id="nav_user"><a href="#"><?php echo $user['name']; ?> &nbsp;<span class="fa fa-caret-down"></span></a>
                                        <ul class="dropdown">
                                            <li><a href="logout.php?action=logout">Logout</a></li>  
                                        </ul>
                                    </li>
                                  <?php } else { ?>
                                    <li><a href="login.php">Login</a></li>
                                    <li id="nav_register"><a href="register.php">Register</a></li>
                                    <li id="nav_about"><a href="search.php"><span class="fa fa-search"></span></a></li>
                                  <?php } ?>
                              </ul>
                          </nav>
                          <!-- <div class="header__right__social">
                              <a href="#"><i class="fa fa-facebook"></i></a>
                              <a href="#"><i class="fa fa-twitter"></i></a>
                              <a href="#"><i class="fa fa-instagram"></i></a>
                              <a href="#"><i class="fa fa-dribbble"></i></a>
                          </div> -->
                      </div>
                  </div>
              </div>
              <div id="mobile-menu-wrap"></div>
          </div>
      </header>
      <!-- Header Section End -->

<?php } ?>

<?php function footer(){ ?>

  <!-- Footer Section Begin -->
  <footer id="foot" class="footer footer--normal spad set-bg" data-setbg="template/img/footer-bg.png">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-6">
                  <div class="footer__address">
                      <ul>
                          <li>
                              <i class="fa fa-phone"></i>
                              <p>Phone</p>
                              <h6>1-677-124-44227</h6>
                          </li>
                          <li>
                              <i class="fa fa-envelope"></i>
                              <p>Email</p>
                              <h6>DJ.Music@gmail.com</h6>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-4 offset-lg-1 col-md-6">
                  <div class="footer__social">
                      <h2>DJoz</h2>
                      <div class="footer__social__links">
                          <a href="#"><i class="fa fa-facebook"></i></a>
                          <a href="#"><i class="fa fa-twitter"></i></a>
                          <a href="#"><i class="fa fa-instagram"></i></a>
                          <a href="#"><i class="fa fa-dribbble"></i></a>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 offset-lg-1 col-md-6">
                  <div class="footer__newslatter">
                      <h4>Stay With me</h4>
                      <form action="#">
                          <input type="text" placeholder="Email">
                          <button type="submit"><i class="fa fa-send-o"></i></button>
                      </form>
                  </div>
              </div>
          </div>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    <div class="footer__copyright__text">
      <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
    </div>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </div>
  </footer>
  <!-- Footer Section End -->

      <!-- Js Plugins -->
      <script src="template/js/jquery-3.3.1.min.js"></script>
      <script src="template/js/bootstrap.min.js"></script>
      <script src="template/js/jquery.magnific-popup.min.js"></script>
      <script src="template/js/jquery.nicescroll.min.js"></script>
      <script src="template/js/jquery.barfiller.js"></script>
      <script src="template/js/jquery.countdown.min.js"></script>
      <script src="template/js/jquery.slicknav.js"></script>
      <script src="template/js/owl.carousel.min.js"></script>
      <script src="template/js/main.js"></script>

      <!-- Music Plugin -->
      <script src="template/js/jquery.jplayer.min.js"></script>
      <script src="template/js/jplayerInit.js"></script>
  </body>

  </html>

<?php } ?>
