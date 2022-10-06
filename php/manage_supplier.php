<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM suppliers WHERE ID = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showSuppliers(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showSuppliers($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $name = ucwords($_GET["name"]);
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];
      $address = ucwords($_GET["address"]);
      updateSupplier($id, $name, $email, $contact_number, $address);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showSuppliers(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchSupplier(strtoupper($_GET["text"]));
  }

  function showSuppliers($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;

      //Get number of entries from Databases.
      $number_of_rows = 0;

      $sql_qry = "SELECT count(ID) FROM suppliers";
      $result1 = mysqli_query($con, $sql_qry);
      if ($result1)
        $number_of_rows = mysqli_fetch_array($result1);
      $limit = 3;

      //Set number of pages to be seen on page
      $pages = ceil($number_of_rows[0] / $limit);
      $page = isset($_GET['page']) ? $_GET['page'] : 1;

      //Set previous and next parameters for pages
      $previous = ($page - 1) < 1 ? 1 : ($page - 1);
      $next = ($page + 1) > ($pages) ? $page : ($page + 1);
      $start = ($page - 1) * $limit;

      $query = "SELECT * FROM suppliers limit $start, $limit";
      $result = mysqli_query($con, $query);

      //Call Function to show Pagination.
      showPagination($pages, $next, $previous);

      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['ID'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showSupplierRow($seq_no, $row);
      }
    }
  }
  function showPagination($pages, $next, $previous){ ?>
    <div class="col-md-10">
        <nav aria-label="Page navigation">
          <ul class="pagination pagination-sm">
            <li>
              <a href="./manage_supplier.php?page=<?= $previous; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo; Previous</span>
              </a>
            </li>
            <?php for ($i=1; $i <= $pages; $i++) : ?>
              <li><a href="./manage_supplier.php?page=<?= $i; ?>" ><?= $i; ?></a></li>
            <?php endfor; ?>
            <li>
              <a href="./manage_supplier.php?page=<?= $next; ?>" aria-label="Next">
                <span aria-hidden="true">Next &raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  <?php }

  function showSupplierRow($seq_no, $row) {
    $current_user_role = $_SESSION['user_role'];
    $role = $_SESSION[$current_user_role];
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['ID'] ?></td>
      <td><?php echo $row['NAME']; ?></td>
      <td><?php echo $row['EMAIL']; ?></td>
      <td><?php echo $row['CONTACT_NUMBER']; ?></td>
      <td><?php echo $row['ADDRESS']; ?></td>
      <td>
      <?php 
      if (($role == "Admin") || ($role == "Owner")){
      ?>
        <button href="" class="btn btn-info btn-sm" onclick="editSupplier(<?php echo $row['ID']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteSupplier(<?php echo $row['ID']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      <?php } ?>
      </td>
    </tr>
    <?php
  }

function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['ID'] ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['NAME']; ?>" placeholder="Name" id="supplier_name" onkeyup="validateName(this.value, 'name_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="email" class="form-control" value="<?php echo $row['EMAIL']; ?>" placeholder="Email" id="supplier_email" onblur="validateContactNumber(this.value, 'email_error');">
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['CONTACT_NUMBER']; ?>" placeholder="Contact Number" id="supplier_contact_number" onblur="validateContactNumber(this.value, 'contact_number_error');">
      <code class="text-danger small font-weight-bold float-right" id="contact_number_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="Address" id="supplier_address" onblur="validateAddress(this.value, 'address_error');"><?php echo $row['ADDRESS']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="address_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateSupplier(<?php echo $row['ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateSupplier($id, $name, $email, $contact_number, $address) {
  require "db_connection.php";
  $query = "UPDATE suppliers SET NAME = '$name', EMAIL = '$email', CONTACT_NUMBER = '$contact_number', ADDRESS = '$address' WHERE ID = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showSuppliers(0);
}

function searchSupplier($text) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM suppliers WHERE UPPER(NAME) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showSupplierRow($seq_no, $row);
    }
  }
}

?>
