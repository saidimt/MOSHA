<?php
  $SERVER = 'localhost';
  $USERNAME = 'root';
  $PASSWORD = '';
  $DB = 'pharmacy';
  $curr_user = "";

  @$con = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB)
  or
  die("<div class='text-danger text-center h5'>Oops, Unable to connect with database!</div>");
  
  if (isset($_SESSION['user']))
    $curr_user = $_SESSION['user'];
  if(isset($_GET['action']) && $_GET['action'] == 'is_logged_in') {
    // $query = "SELECT IS_LOGGED_IN FROM admin_credentials WHERE IS_LOGGED_IN = 'true'";
    $query = "SELECT IS_LOGGED_IN FROM admin_credentials WHERE USERNAME = '$curr_user'";
    $result = mysqli_query($con, $query);
    if($result) {
      $row = mysqli_fetch_array($result);
      echo $row['IS_LOGGED_IN'];
    }
    else
      echo "setup";
  }
?>
