<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM users WHERE ID = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
        showUsers(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showUsers($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $fname = ucwords($_GET["fname"]);
      $lname = ucwords($_GET["lname"]);
      $email = ucwords($_GET["email"]);
      $contact_number = $_GET["contact_number"];
      $role = ucwords($_GET["role"]);
      updateUser($id, $fname, $lname, $email, $contact_number, $role);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showUsers(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchUser(strtoupper($_GET["text"]));
    
    if (isset($_GET["action"]) && $_GET["action"] == "make_admin")
      makeUserAdmin($_GET["id"]);
  }

  function showUsers($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM users";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['ID'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showUserRow($seq_no, $row);
      }
    }
  }

  function showUserRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['lastname']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['contact_number']; ?></td>
      <td><?php echo $row['role']; ?></td>
      <td>
        <button href="" class="btn btn-info btn-sm" onclick="editUser(<?php echo $row['ID']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $row['ID']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
        <!-- <div id="make_admin_popup" style="width: 45px; height: 50px; background" hidden>

        </div> -->
        <button class="btn btn-success btn-sm" onclick="makeUserAdmin(<?php echo $row['ID']; ?>);">
          <i class="fa fa-user"></i>
        </button>
      </td>
    </tr>
    <?php
  }

function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['firstname']; ?>" placeholder="First Name" id="user_fname" onkeyup="validateName(this.value, 'name_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['lastname']; ?>" placeholder="Last Name" id="user_lname" onkeyup="validateName(this.value, 'lname_error');">
      <code class="text-danger small font-weight-bold float-right" id="lname_error" style="display: none;"></code>
    </td>
    <td>
      <input type="email" class="form-control" value="<?php echo $row['email']; ?>" placeholder="Email" id="email" onkeyup="notNull(this.value, 'email_error');">
      <code class="text-danger small font-weight-bold float-right" id="email_error" style="display: none;"></code>
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['contact_number']; ?>" placeholder="Contact Number" id="customer_contact_number" onblur="validateContactNumber(this.value, 'contact_number_error');">
      <code class="text-danger small font-weight-bold float-right" id="contact_number_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" placeholder="Role" id="user_role" value="<?php echo $row['role']; ?>" onblur="validateRole(this.value, 'role_error');">
      <code class="text-danger small font-weight-bold float-right" id="role_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateUser(<?php echo $row['ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateUser($id, $fname, $lname, $email, $contact_number, $role) {
  require "db_connection.php";
  $query = "UPDATE users SET firstname = '$fname', lastname = '$lname', email = '$email', contact_number = '$contact_number', role = '$role' WHERE ID = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showUsers(0);
}

function searchUser($text) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM users WHERE UPPER(firstname) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showUserRow($seq_no, $row);
    }
  }
}

function makeUserAdmin($id){
  require "db_connection.php";
  if($con) {
    $qry = "UPDATE users SET role = 'Admin' WHERE ID = $id";
    
    $result = mysqli_query($con, $qry);
    if($result) {
      showUsers(0);
    }
  }
}

?>
