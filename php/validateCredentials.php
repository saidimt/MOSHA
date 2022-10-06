<?php
  session_start();

  if(isset($_GET['action']) && $_GET['action'] == 'is_setup_done')
    isSetupDone();

  function isSetupDone() {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM admin_credentials";
      $result = mysqli_query($con, $query); 
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'is_admin')
    isAdmin();

  function isAdmin() {
    require "db_connection.php";
    if($con) {
      $username = $_GET["uname"];
      $password = $_GET["pswd"]; 

      $query = "SELECT * FROM admin_credentials,users WHERE admin_credentials.USERNAME = users.firstname AND  admin_credentials.USERNAME = '$username' AND admin_credentials.PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      if($row)  {
        $query = "UPDATE admin_credentials SET IS_LOGGED_IN = 'true' WHERE USERNAME = '$username'";
        $result = mysqli_query($con, $query);
        $_SESSION['user_role'] = $row['role'];
        $_SESSION['user'] = $row['USERNAME'];
        $role = $_SESSION['user_role'];
        $fullsessionkey = $_SESSION['user_role'].$_SESSION['user']; 
        $fullRolesKey = $_SESSION['user_role']."roles";
        $_SESSION[$fullsessionkey] = $fullsessionkey;

        //Assign Roles to Current Logged in User.
        switch ($_SESSION['user_role']){
          case "Admin":
            $_SESSION[$role] = $role;
            $_SESSION[$fullRolesKey] = array("Users", "Receipt", "Medicine", "Supplier", "Purchase", "Report");
            break;
          case "Pharmacist":
            $_SESSION[$role] = $role;
            $_SESSION[$fullRolesKey] = array("Medicine", "Supplier", "Purchase");
            break;
          case "Cashier":
            $_SESSION[$role] = $role;
            $_SESSION[$fullRolesKey] = array("Receipt", "Report");
            break;
          default:
            $_SESSION[$role] = $role;
            $_SESSION[$fullRolesKey] = array("Users", "Medicine", "Supplier", "Purchase", "Report");
        }
        echo "true";
      }
      else
        echo "false";
    }
  }

  // if(isset($_GET['action']) && $_GET['action'] == 'store_admin_info')
  //   storeAdminData();

  // function storeAdminData() {
  //   require "db_connection.php";
  //   if($con) {
  //     $pharmacy_name = $_GET["pharmacy_name"];
  //     $address = $_GET["address"];
  //     $email = $_GET["email"];
  //     $contact_number = $_GET["contact_number"];
  //     $username = $_GET["username"];
  //     $password = $_GET["password"];

  //     $query = "INSERT INTO admin_credentials (PHARMACY_NAME, ADDRESS, EMAIL, CONTACT_NUMBER, USERNAME, PASSWORD, IS_LOGGED_IN) VALUES('$pharmacy_name', '$address', '$email', '$contact_number', '$username', '$password', 'false')";
  //     $result = mysqli_query($con, $query);
  //     echo ($result) ? "true" : "false";
  //   }
  // }

  if(isset($_GET['action']) && $_GET['action'] == 'verify_email_number')
    verifyEmailNumber();

  function verifyEmailNumber() {
    require "db_connection.php";
    if($con) {
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];

      $query = "SELECT * FROM pharmacy_info WHERE EMAIL = '$email' AND CONTACT_NUMBER = '$contact_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'update_username_password')
    updateUsernamePassword();

  function updateUsernamePassword() {
    require "db_connection.php";
    if($con) {
      $username = $_GET["username"];
      $password = $_GET["password"];
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];

      $query = "UPDATE admin_credentials SET USERNAME = '$username', PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'validate_password')
    validatePassword();

  function validatePassword() {
    require "db_connection.php";
    if($con) {
      $password = $_GET["password"];

      $query = "SELECT * FROM admin_credentials WHERE PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'update_admin_info')
    updatePharmacyInfo();

  function updatePharmacyInfo() {
    require "db_connection.php";
    if($con) {
      $pharmacy_name = $_GET["pharmacy_name"];
      $address = $_GET["address"];
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];

      $query = "UPDATE pharmacy_info SET PHARMACY_NAME = '$pharmacy_name', ADDRESS = '$address', EMAIL = '$email', CONTACT_NUMBER = '$contact_number'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "Details updated..." : "Oops! Somthing wrong happend...";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'change_password')
    changePassword();

  function changePassword() {
    require "db_connection.php";
    if($con) {
      $password = $_GET["password"];

      $query = "UPDATE admin_credentials SET PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "Password changed..." : "Oops! Somthing wrong happend...";
    }
  }

 ?>
