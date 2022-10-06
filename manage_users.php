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
    <title>Manage Users</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_user.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body style="max-height: 100%;">
    <!-- <div id="add_new_admin_modal">
      <div class="modal-dialog">
      	<div class="modal-content">
      		<div class="modal-header" style="background-color: #ff5252; color: white">
            <div class="font-weight-bold">Add Admin</div>
      			<button class="close" style="outline: none;" onclick="document.getElementById('add_new_admin_modal').style.display = 'none';"><i class="fa fa-close"></i></button>
      		</div>
      		<div class="modal-body">
            <?php
              //include('sections/add_admin.html');
            ?>
      		</div>
      	</div>
      </div>
    </div> -->
    <!-- including side navigations -->
    <?php include("php/sidenav.php"); ?>

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('handshake', 'Manage User', 'Manage Existing User');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" id="" placeholder="Search User" onkeyup="searchUser(this.value);">
          </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
            		<thead>
            			<tr>
            				<th style="width: 2%;">S/N</th>
            				<th style="width: 13%;">FirstName</th>
                    <th style="width: 13%;">LastName</th>
                    <th style="width: 16%;">Email</th>
                    <th style="width: 13%;">Contact No.</th>
                    <th style="width: 13%;">Role</th>
                    <th style="width: 15%;">Action</th>
            			</tr>
            		</thead>
            		<tbody id="customers_div">
                  <?php
                    require 'php/manage_users.php';
                    showUsers(0);
                  ?>
            		</tbody>
            	</table>
            </div>
          </div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
