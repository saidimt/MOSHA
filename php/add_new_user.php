<?php
  require "db_connection.php";
  if($con) {
    $fname = ucwords($_GET["fname"]);
    $lname = ucwords($_GET["lname"]);
    $email = ucwords($_GET["email"]);
    $contact_number = $_GET["contact_number"];
    $role = ucwords($_GET["role"]);

    $query = "SELECT * FROM users WHERE email = '$email' AND contact_number = '$contact_number'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "User ".$row['firstname']." with email $email and contact number $contact_number already exists!";
    else {
      $query = "INSERT INTO users (firstname, lastname, email, contact_number, role) VALUES('$fname', '$lname', '$email', '$contact_number', '$role')";
      $result = mysqli_query($con, $query);
      if(!empty($result)){
        $id = mysqli_insert_id($con);
        $password = strtolower($fname)."123";
        $sql_qry = "INSERT INTO admin_credentials (user_id, USERNAME, PASSWORD, IS_LOGGED_IN) VALUES ($id, '$fname', '$password', 'false')";
        $result1 = mysqli_query($con, $sql_qry);
        if(!empty($result1))
  			 echo "$fname $lname added...";
      }
  		else
  			echo "Failed to add $fname $lname!";
    }
  }
?>
