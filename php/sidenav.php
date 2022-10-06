
<script type="text/javascript">
  var pid = "none";
  function showhide(id) {
    var elements = document.getElementById(id).childNodes;
    var menu = elements[3];
    var arrow = ((elements[1].childNodes)[4].childNodes)[1]; 
    if(menu.style.display == 'block') {
      menu.style.display = "none";
      arrow.style.transform = "rotate(0deg)";
      elements[1].style.color = "#eeeeee";
    }
    else {
      menu.style.display = "block";
      arrow.style.transform = "rotate(270deg)";
      elements[1].style.color = "#ff5252"; 
    }
    if(pid == id)
      pid = "none";
    if(pid != "none") {
      elements = document.getElementById(pid).childNodes;
      menu = (document.getElementById(pid).childNodes)[3];
      arrow = ((elements[1].childNodes)[4].childNodes)[1];
      if(menu.style.display == 'block') {
        menu.style.display = "none";
        arrow.style.transform = "rotate(0deg)";
        elements[1].style.color = "#eeeeee";
      }
    }
    pid = id;
  }

  function showOptions() {
    var flag = document.getElementById('options');
    if(flag.style.display == 'block') {
      flag.style.display = "none";
      document.getElementById('mark').style.display = "none";
    }
    else {
      flag.style.display = "block";
      document.getElementById('mark').style.display = "block";
    }
  }
</script>

<?php
  $roleskey = $_SESSION['user_role']."roles";
  $current_user_role = $_SESSION['user_role'];
  $role = $_SESSION[$current_user_role];
  $user_roles = $_SESSION[$roleskey];
?>
<div class="sidenav" style="background-color: #111c42;">
  <div class="card">
    <div class="card-body">
      <div class="logo">
        <img src="images\logo-pharmacy.jpg" class="profile"/>
        <h2 class="logo-caption"><span class="tweak">E</span>-Pharmacy</h1>
        <!-- <?php //if(($current_user_role == "Admin") || ($current_user_role == "Owner")) {?><h3 class="logo-caption"><span class="tweakA">A</span>-dmin</h3> <?php //} else  { ?><h3 class="logo-caption"><span class="tweakA">C</span>-ashier</h3><?php //}; ?> -->
        <h3 class="logo-caption"><span class="tweakA"><?= substr($role, 0, 1); ?></span>-<?= substr($role, 1); ?></h3>
      </div> <!-- logo class -->

      <!-- dashboard start -->
      <div class="main-menu-item">
        <a href="home.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
      </div>
      <!-- dashboard end -->

      <!-- users start -->
      <?php
      if (in_array("Users", $user_roles)) {
      ?>
      <div id="second" class="main-menu-item" onclick="showhide(this.id);">
      	<a href="#">
      		<i class="fa fa-handshake"></i><span>Users</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-left pull-right"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="add_users.php">Add User</a></li>
      		<li class="treeview"><a href="manage_users.php">Manage User</a></li>
      	</ul>
      </div>
      <?php
      }
      ?>
      <!-- users end -->

      <!-- invoice strat -->
      <?php
      if (in_array("Receipt", $user_roles)) {
      ?>
      <div id="first" class="main-menu-item" onclick="showhide(this.id);">
      	<a  href="#">
      		<i class="fa fa-balance-scale"></i><span>Receipt</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-left pull-right"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="new_invoice.php">New Receipt</a></li>
      		<li class="treeview"><a href="manage_invoice.php">Manage Receipts</a></li>
      	</ul>
      </div>
      <?php
      }
      ?>
      <!-- invoice end -->

      <!-- medicine strat -->
      <?php
      if (in_array("Medicine", $user_roles)) {
      ?>
      <div id="third" class="main-menu-item" onclick="showhide(this.id);">
      	<a href="#">
      		<i class="fa fa-shopping-bag"></i><span>Medicine</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-left pull-right"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="add_medicine.php">Add Medicine</a></li>
      		<li class="treeview"><a href="manage_medicine.php">Manage Medicine</a></li>
          <li class="treeview"><a href="manage_medicine_stock.php">Manage Medicine Stock</a></li>
      	</ul>
      </div>
      <?php
      }
      ?>
      <!-- medicine end -->

      <!-- manufacturer start -->
      <?php
      if (in_array("Supplier", $user_roles)) {
      ?>
      <div id="fourth" class="main-menu-item" onclick="showhide(this.id);">
      	<a href="#">
      		<i class="fa fa-group"></i><span>Supplier</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-left pull-right"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="add_supplier.php">Add Supplier</a></li>
      		<li class="treeview"><a href="manage_supplier.php">Manage Supplier</a></li>
      	</ul>
      </div>
      <?php
      }
      ?>
      <!-- manufacturer end -->

      <!-- purchase start -->
      <?php
      if (in_array("Purchase", $user_roles)) {
      ?>
      <div id="fifth" class="main-menu-item" onclick="showhide(this.id);">
      	<a href="#">
      		<i class="fa fa-bar-chart"></i><span>Purchase</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-left pull-right"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="add_purchase.php">Add Purchase</a></li>
      		<li class="treeview"><a href="manage_purchase.php">Manage Purchase</a></li>
      	</ul>
      </div>
      <?php
      }
      ?>
      <!-- purchase end -->

      <!-- report start -->
      <?php
      if (in_array("Report", $user_roles)) {
      ?>
      <div id="sixth" class="main-menu-item" onclick="showhide(this.id);">
      	<a href="#">
      		<i class="fa fa-book"></i><span>Report</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-left pull-right"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
          <li class="treeview"><a href="sales_report.php">Sales Report</a></li>
      		<li class="treeview"><a href="purchase_report.php">Purchase Report</a></li>
      	</ul>
      </div>
      <?php
      }
      ?>
      <!-- report end -->

    </div> <!-- card-body class -->
  </div> <!-- card  -->
</div>