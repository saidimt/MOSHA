<?php
  
  if(isset($_GET["action"]) && $_GET["action"] == "delete") {
    require "db_connection.php";
    $invoice_number = $_GET["invoice_number"];
    $query = "DELETE FROM invoices WHERE INVOICE_ID = $invoice_number";
    $result = mysqli_query($con, $query);
    if(!empty($result))
  		showInvoices();
  }

  // if(isset($_GET["get_page"]))
  //   showInvoices();

  if(isset($_GET["action"]) && $_GET["action"] == "refresh")
    showInvoices();

  if(isset($_GET["action"]) && $_GET["action"] == "search")
    searchInvoice(strtoupper($_GET["text"]), $_GET["tag"]);

  if(isset($_GET["action"]) && $_GET["action"] == "print_invoice")
    printInvoice($_GET["invoice_number"]);

  function showInvoices() { 
    require "db_connection.php";
    if($con) {
      $seq_no = 0;

      //Get number of entries from Databases.
      $number_of_rows = 0;
      $sql_qry = "SELECT count(INVOICE_ID) FROM invoices i left outer join sales s on i.INVOICE_DATE=s.DATE";
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

      //Query to set the results using limits.
      $query = "SELECT i.INVOICE_ID, i.INVOICE_DATE, s.MEDICINE_NAME, i.NET_TOTAL, i.TOTAL_AMOUNT, i.TOTAL_DISCOUNT FROM invoices i left outer join sales s on i.INVOICE_DATE=s.DATE limit $start, $limit";
      $result = mysqli_query($con, $query);
      showPagination($pages, $next, $previous);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }

  function showPagination($pages, $next, $previous){ ?>
    <div class="row">
      <div class="col-md-10">
        <nav aria-label="Page navigation">
          <ul class="pagination pagination-sm">
            <li>
              <a href="./manage_invoice.php?page=<?= $previous; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo; Previous</span>
              </a>
            </li>
            <?php for ($i=1; $i <= $pages; $i++) : ?>
              <li><a href="./manage_invoice.php?page=<?= $i; ?>" ><?= $i; ?></a></li>
            <?php endfor; ?>
            <li>
              <a href="./manage_invoice.php?page=<?= $next; ?>" aria-label="Next">
                <span aria-hidden="true">Next &raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  <?php }

  function showInvoiceRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['INVOICE_ID']; ?></td>
      <td><?php echo $row['INVOICE_DATE']; ?></td>
      <td><?php echo $row['MEDICINE_NAME']; ?></td>
      <td><?php echo $row['TOTAL_AMOUNT']; ?></td>
      <td><?php echo $row['TOTAL_DISCOUNT']; ?></td>
      <td><?php echo $row['NET_TOTAL']; ?></td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="printInvoice(<?php echo $row['INVOICE_ID']; ?>);">
          <i class="fa fa-fax"></i>
        </button>
        <?php 
        if( isset($_SESSION['user_role']) && $_SESSION['user_role']=="Admin"){?>
        <button class="btn btn-danger btn-sm" onclick="deleteInvoice(<?php echo $row['INVOICE_ID']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
        <?php
        }
        ?>
        
      </td>
    </tr>
    <?php
  }

  function searchInvoice($text, $column) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      if($column == 'INVOICE_ID')
        $query = "SELECT i.INVOICE_ID, i.INVOICE_DATE, s.MEDICINE_NAME, i.NET_TOTAL, i.TOTAL_AMOUNT, i.TOTAL_DISCOUNT FROM invoices i, sales s WHERE i.INVOICE_DATE=s.DATE and CAST(i.$column AS VARCHAR(9)) LIKE '%$text%'";
      else if($column == "INVOICE_DATE")
        $query = "SELECT i.INVOICE_ID, i.INVOICE_DATE, s.MEDICINE_NAME, i.NET_TOTAL, i.TOTAL_AMOUNT, i.TOTAL_DISCOUNT FROM invoices i, sales s WHERE i.INVOICE_DATE=s.DATE and i.$column = '$text'";
      else if($column == "MEDICINE_NAME")
        $query = "SELECT i.INVOICE_ID, i.INVOICE_DATE, s.MEDICINE_NAME, i.NET_TOTAL, i.TOTAL_AMOUNT, i.TOTAL_DISCOUNT from invoices i, sales s where i.INVOICE_DATE=s.DATE and s.MEDICINE_NAME like '%$text%'";

      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }

  function printInvoice($invoice_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM invoices WHERE INVOICE_ID = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $invoice_date = $row['INVOICE_DATE'];
      $total_amount = $row['TOTAL_AMOUNT'];
      $total_discount = $row['TOTAL_DISCOUNT'];
      $net_total = $row['NET_TOTAL'];
    }

    ?>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <div class="row">
      <div class="col-md-1"></div>
    </div>
    <div class="row font-weight-bold">
      <div class="col-md-1"></div>
      <div class="col-md-10"><span class="h4 float-right">Invoice Date. : <?php echo $invoice_date; ?></span></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-3"></div>

      <?php

      $query = "SELECT * FROM pharmacy_info";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $p_name = $row['PHARMACY_NAME'];
      $p_address = $row['ADDRESS'];
      $p_email = $row['EMAIL'];
      $p_contact_number = $row['CONTACT_NUMBER'];
      ?>
      <div class="col-md-4">
        <span class="h4">Shop Details : </span><br><br>
        <span class="img"><img src="images/logo-pharmacy.jpg"></span><br><br>
        <span class="font-weight-bold"><?php echo $p_name; ?></span><br>
        <span class="font-weight-bold"><?php echo $p_address; ?></span><br>
        <span class="font-weight-bold"><?php echo $p_email; ?></span><br>
        <span class="font-weight-bold">Mob. No.: <?php echo $p_contact_number; ?></span>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="purchase_report_div">
          <thead>
            <tr>
              <th>SL</th>
              <th>Date</th>
              <th>Medicine Name</th>
              <th>Expiry Date</th>
              <th>Quantity</th>
              <th>MRP</th>
              <th>Discount</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $seq_no = 0;
              $total = 0;
              $query = "SELECT * FROM sales WHERE INVOICE_NUMBER = $invoice_number";
              $result = mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                $seq_no++;
                ?>
                <tr>
                  <td><?php echo $seq_no; ?></td>
                  <td><?php echo $row['DATE']; ?></td>
                  <td><?php echo $row['MEDICINE_NAME']; ?></td>
                  <td><?php echo $row['EXPIRY_DATE']; ?></td>
                  <td><?php echo $row['QUANTITY']; ?></td>
                  <td><?php echo $row['MRP']; ?></td>
                  <td><?php echo $row['DISCOUNT']."%"; ?></td>
                  <td><?php echo $row['TOTAL']; ?></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
          <tfoot class="font-weight-bold">
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="7">&nbsp;Total Amount</td>
              <td><?php echo $total_amount; ?></td>
            </tr>
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="7">&nbsp;Total Discount</td>
              <td><?php echo $total_discount; ?></td>
            </tr>
            <tr style="text-align: right; font-size: 22px;">
              <td colspan="7" style="color: green;">&nbsp;Net Amount</td>
              <td class="text-primary"><?php echo $net_total; ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <?php
  }

?>
