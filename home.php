<?php
  session_start();
  if(!isset($_SESSION['user_role'])){
    header("location:index.php");
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <?php
      $roleskey = $_SESSION['user_role']."roles";
      $current_user_role = $_SESSION['user_role'];
      $role = $_SESSION[$current_user_role];
      $user_roles = $_SESSION[$roleskey];
    ?>
    <?php include "php/sidenav.php"; ?> 
    <div class="container-fluid">
      <div class="container">
        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('home', 'Dashboard', 'Home');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <div class="row col col-xs-8 col-sm-8 col-md-8 col-lg-8">

            <?php
              function createSection1($location, $title, $table) {
                require 'php/db_connection.php';

                $query = "SELECT * FROM $table";
                if($title == "Out of Stock")
                  $query = "SELECT * FROM $table WHERE QUANTITY = 0";

                $result = mysqli_query($con, $query);
                $count = mysqli_num_rows($result);


                if($title == "Expired") {
                  // logic
                  $count = 0;
                  while($row = mysqli_fetch_array($result)) {
                    $expiry_date = $row['EXPIRY_DATE'];
                    if(substr($expiry_date, 3) < date('y'))
                      $count++;
                    else if(substr($expiry_date, 3) == date('y')) {
                      if(substr($expiry_date, 0, 2) < date('m'))
                        $count++;
                    }
                  }
                }

                echo '
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                    <div class="dashboard-stats" onclick="location.href=\''.$location.'\'">
                      <a class="text-dark text-decoration-none" href="'.$location.'">
                        <span class="h4">'.$count.'</span>
                        <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                        <div class="small font-weight-bold">'.$title.'</div>
                      </a>
                    </div>
                  </div>
                ';
              }
              // createSection1('manage_customer.php', 'Total Customer', 'customers');
              if (in_array("Supplier", $user_roles))
                createSection1('manage_supplier.php', 'Total Supplier', 'suppliers');
              if (in_array("Medicine", $user_roles))
                createSection1('manage_medicine.php', 'Total Medicine', 'medicines');
              if ($role == "Pharmacist" || $role == "Admin")
                createSection1('manage_medicine_stock.php?out_of_stock', 'Out of Stock', 'medicines_stock');
              if ($role == "Pharmacist" || $role == "Admin")
                createSection1('manage_medicine_stock.php?expired', 'Expired', 'medicines_stock');
              if (in_array("Receipt", $user_roles))
                createSection1('manage_invoice.php', 'Total Receipts', 'invoices');
            ?>

          </div>

          <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 7px 0; margin-left: 15px;">
            <div class="todays-report">
              <div class="h5">Todays Report</div>
              <table class="table table-bordered table-striped table-hover">
                <tbody>
                  <?php
                    require 'php/db_connection.php';
                    if($con) {
                      $date = date('Y-m-d');
                  ?>
                  <tr>
                    <?php
                      $total = 0;
                      $query = "SELECT NET_TOTAL FROM invoices WHERE INVOICE_DATE = '$date'";
                      $result = mysqli_query($con, $query);

                      while($row = mysqli_fetch_array($result))
                        $total = $total + $row['NET_TOTAL'];
                    ?>
                    <th>Total Sales</th>
                    <th class="text-success">TZS. <?php echo $total; ?></th>
                  </tr>
                  <tr>
                    <?php
                      //echo $date;
                      $total = 0;
                      $query = "SELECT TOTAL_AMOUNT FROM purchases WHERE PURCHASE_DATE = '$date'";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result))
                        $total = $total + $row['TOTAL_AMOUNT'];
                    }
                    ?>
                    <th>Total Purchase</th>
                    <th class="text-danger">TZS. <?php echo $total; ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>

        <hr style="border-top: 2px solid #ff5252;">

        <div class="row">

          <?php
            function createSection2($icon, $location, $title) {
              echo '
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 10px;">
              		<div class="dashboard-stats" style="padding: 30px 15px;" onclick="location.href=\''.$location.'\'">
              			<div class="text-center">
                      <span class="h1"><i class="fa fa-'.$icon.' p-2"></i></span>
              				<div class="h5">'.$title.'</div>
              			</div>
              		</div>
                </div>
              ';
            }
            if (in_array("Users", $user_roles))
              createSection2('handshake', 'add_users.php', 'Add New User');
            if (in_array("Receipt", $user_roles))
              createSection2('address-card', 'new_invoice.php', 'Create New Receipt');
            if (in_array("Medicine", $user_roles))
              createSection2('shopping-bag', 'add_medicine.php', 'Add New Medicine');
            if (in_array("Supplier", $user_roles))
              createSection2('group', 'add_supplier.php', 'Add New Supplier');
            if (in_array("Purchase", $user_roles))
              createSection2('bar-chart', 'add_purchase.php', 'Add New Purchase');
            if (in_array("Report", $user_roles))
              createSection2('book', 'sales_report.php', 'Sales Report');
            if (in_array("Report", $user_roles))
              createSection2('book', 'purchase_report.php', 'Purchase Report');
          ?>

        </div>
        <!-- form content end -->

        <hr style="border-top: 2px solid #ff5252;">

      </div>
      <p class="text-center" data-wow-delay=".5s" style="visibility: visible;">© 2022 E-Pharmacy Co. Ltd. All Rights Reserved </p>
    </div>
  </body>
</html>
