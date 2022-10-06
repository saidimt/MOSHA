<div class="row col col-md-12">
  <div class="col col-md-8 form-group">
    <label class="font-weight-bold" for="medicine_name">Medicine Name :</label>
    <input type="text" class="form-control" id="medicine_name" placeholder="Medicine Name" onblur="notNull(this.value, 'medicine_name_error');">
    <code class="text-danger small font-weight-bold float-right" id="medicine_name_error" style="display: none;"></code>
  </div>
  <div class="col col-md-4 form-group">
    <label class="font-weight-bold" for="packing">Category :</label>
    <input type="text" class="form-control" id="packing" placeholder="Category e.g Tablets/Syrup" onblur="notNull(this.value, 'pack_error');" onkeydown="categoryOptions(this.value, 'category_list');" onfocus="categoryOptions(this.value, 'category_list');">
    <code class="text-danger small font-weight-bold float-right" id="pack_error" style="display: none;"></code>
    <datalist id="category_list" style="display: none; max-height: 200px; overflow: auto;">
      <!-- <script>showCategoryList("");</script> -->
      <?php
        require "../php/add_new_category.php";
        showCategoryList("");
      ?>
    </datalist>
  </div>
</div>

<div class="row col col-md-12">
  <div class="col col-md-12 form-group">
    <label class="font-weight-bold" for="generic_name">Generic Name :</label>
    <input type="text" class="form-control" id="generic_name" placeholder="Generic Name" onblur="notNull(this.value, 'generic_name_error');">
    <code class="text-danger small font-weight-bold float-right" id="generic_name_error" style="display: none;"></code>
  </div>
</div>

<div class="row col col-md-12">
  <div class="col col-md-12 form-group">
    <label class="font-weight-bold" for="suppliers_name">Supplier :</label>
    <input id="suppliers_name" type="text" class="form-control" id="suppliers_name" placeholder="Supplier Name" name="suppliers_name" onkeyup="showSuggestions(this.value, 'supplier');">
    <code class="text-danger small font-weight-bold float-right" id="supplier_name_error" style="display: none;"></code>
    <div id="supplier_suggestions" class="list-group position-fixed" style="z-index: 1; width: 35.80%; overflow: auto; max-height: 200px;"></div>
  </div>
</div>

<div class="row col col-md-12">
  <div class="col col-md-5 font-weight-bold" style="color: green;cursor:pointer" onclick="document.getElementById('add_new_supplier_model').style.display = 'block';" onblur="document.getElementById('add_new_supplier_model').style.display = 'none';">
    <i class="fa fa-plus"></i>Add New Supplier
  </div>
  <div class="col col-md-5 font-weight-bold" style="color: green;cursor:pointer" onclick="document.getElementById('add_new_category_model').style.display = 'block';" onblur="document.getElementById('add_new_category_model').style.display = 'none';">
    <i class="fa fa-plus"></i>New Category
  </div>
</div>
<hr>

<div class="col col-md-12">
  <hr class="col-md-12 float-left" style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
</div>

<!-- new user button -->
<div class="row col col-md-12">
  &emsp;
  <div class="form-group m-auto">
    <button class="btn btn-primary form-control" onclick="addMedicine();">ADD</button>
  </div>
  <!--
  &emsp;
  <div class="form-group">
    <button class="btn btn-success form-control">Save and Add Another</button>
  </div>
-->
</div>
<!-- customer details content end -->
<!-- result message -->
<div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>