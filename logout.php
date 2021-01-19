<?php
    if (isset($_GET['action']) && $_GET['action'] == 'logout'){
        session_start();
        unset($_SESSION['userId']);
        header('location: index.php');
    }
?>