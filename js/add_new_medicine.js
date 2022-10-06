function showCategoryList(text) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if(xhttp.readyState = 4 && xhttp.status == 200)
          document.getElementById('category_list').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/add_new_category.php?action=category_list&text=" + text.trim(), true); 
    xhttp.send();
}

function categoryOptions(text, id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState = 4 && xhttp.status == 200)
          document.getElementById(id).innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/add_new_category.php?action=category_list&text=" + text.trim(), true); 
    xhttp.send();
}
