<?php
  require "db_connection.php";
  require "add_new_category.php";

  if($con) {
    $name = ucwords($_GET["name"]);
    $packing = ucwords($_GET["packing"]);
    $generic_name = ucwords($_GET["generic_name"]);
    $suppliers_name = $_GET["suppliers_name"];
    $description = isset($_GET["description"]) ? $_GET["description"] : "";

    $query = "SELECT * FROM medicines WHERE UPPER(NAME) = '".strtoupper($name)."' AND UPPER(PACKING) = '".strtoupper($packing)."' AND UPPER(SUPPLIER_NAME) = '".strtoupper($suppliers_name)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Medicine $name with type $packing already exists by supplier $suppliers_name!";
    else {
      if (isCategoryExists($packing) == "false"){
        $query1 = "INSERT INTO category (Category_Type, Description) VALUES('$packing', '$description')";
        $result1 = mysqli_query($con, $query1);
        if(!empty($result1))
          echo "$packing added...";
      }
      $query = "INSERT INTO medicines (NAME, PACKING, GENERIC_NAME, SUPPLIER_NAME) VALUES('$name', '$packing', '$generic_name', '$suppliers_name')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
        echo "$name added...";
      else
        echo "Failed to add $name!";
      }
      // else {
      //   echo "Failed to add $packing!";
      // }
  }
?>
