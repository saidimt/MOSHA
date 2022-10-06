<?php
  session_start();
  $username = $_SESSION['user'];
  $user = $_SESSION['user_role'].$_SESSION['user'];
  $roles = $_SESSION['user_role']."roles";
  $rolee = $_SESSION['user_role'];
  require "php/db_connection.php";

  if($con) {
    $query = "UPDATE admin_credentials SET IS_LOGGED_IN = 'false' WHERE USERNAME = '$username';";
    $result = mysqli_query($con, $query);
    if($result){
      // destroy session
      unset($_SESSION['user_role']);
      unset($_SESSION[$user]);
      unset($_SESSION[$roles]);
      unset($_SESSION[$rolee]);
      header("location:index.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Logout</title>
    <script src="js/restrict.js"></script>
  </head>
  <body>

  </body>
</html>
