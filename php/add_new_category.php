<?php

if(isset($_GET['action']) && $_GET['action'] == "category_list")
    showCategoryList(strtoupper($_GET['text']));

if(isset($_GET['action']) && $_GET['action'] == "is_category")
    isCategory(strtoupper($_GET['category']));

if(isset($_GET['action']) && $_GET['action'] == "add_category")
    addCategory();


function showCategoryList($text) {
    require "db_connection.php";
    if($con) {
        if($text == "")
            $query = "SELECT * FROM category";
        else
            $query = "SELECT * FROM category WHERE UPPER(Category_Type) LIKE '%$text%'";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result))
            echo '<option value="'.$row['Category_Type'].'">'.$row['Category_Type'].'</option>';
    }
}

function isCategory($category){
    require "db_connection.php";
    if($con) {
        $query = "SELECT * FROM category WHERE UPPER(Category_Type) = '".strtoupper($category)."'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        echo ($row) ? "true" : "false";
    }
}

function isCategoryExists($category){
    require "db_connection.php";
    if($con) {
        $query = "SELECT * FROM category WHERE UPPER(Category_Type) = '".strtoupper($category)."'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        if($row)
          return "true";
        return "false";
    }
}

?>