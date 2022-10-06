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
    <title>Purchase Report</title> 
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/report.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- including side navigations -->
    <?php include("php/sidenav.php"); ?>

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('book', 'Purchases Report', 'Showing Purchase Report');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Start Date :&emsp;</label>
            <input type="date" class="form-control" id="start_date" onchange="showReport('purchase');">
            &emsp;
            <label class="font-weight-bold" for="">End Date :&emsp;</label>
            <input type="date" class="form-control" id="end_date" onchange="showReport('purchase');">
            &emsp;
            <button class="btn btn-success" onclick="location.reload();"><i class="fa fa-refresh"></i></button>
          </div>

        <!-- <div class="row text-center">
          <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
        </div> -->
        <?php
          require "./php/db_connection.php";
          $query = "SELECT * FROM pharmacy_info";
          $result = mysqli_query($con, $query);
          $row = mysqli_fetch_array($result);
          $p_name = $row['PHARMACY_NAME'];
          $p_address = $row['ADDRESS'];
          $p_email = $row['EMAIL'];
          $p_contact_number = $row['CONTACT_NUMBER'];
          ?>
          <div class="col-md-4" id="pharmacy_details" hidden>
            <span class="h4">Shop Details : </span><br><br>
            <span class="img"><img src="images/logo-pharmacy.jpg"></span><br><br>
            <span class="font-weight-bold"><?php echo $p_name; ?></span><br>
            <span class="font-weight-bold"><?php echo $p_address; ?></span><br>
            <span class="font-weight-bold"><?php echo $p_email; ?></span><br>
            <span class="font-weight-bold">Mob. No.: <?php echo $p_contact_number; ?></span>
          </div>
          <div class="col-md-1"></div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div id="print_content" class="table-responsive">
            	<table class="table table-bordered table-striped table-hover" id="purchase_report_div">
                <?php
                require "php/report.php";
                showPurchases("", "");
                ?>
            	</table>
            </div>
          </div>

          <div class="col-md-12 text-center">
            <button class="btn btn-primary" onclick="printReport('Purchase');">Print</button>
          </div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
