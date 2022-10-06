function showSuggestions(text, action) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState == 4 && xhttp.status == 200)
      document.getElementById(action + "_suggestions").innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/suggestions.php?action=" + action + "&text=" + text, true);
  xhttp.send();
}

function clearSuggestions(id) {
  var div = document.getElementById(id + "_suggestions");
  if(div)
    div.innerHTML = "";
}

function suggestionClick(value, id) {
  let result_ids = "";
  if(id === "category"){
    document.getElementById("packing").value = value;
    result_ids = "pack_error";
  }
  else{
    document.getElementById(id + "s_name").value = value;
    result_ids = id + '_name_error';
  }
  clearSuggestions(id);
  notNull(value, result_ids); 
}

// function fillCustomerDetails(name) {
//   console.log(name);
//   getCustomerDetail("customers_address", name);
//   getCustomerDetail("customers_contact_number", name);
// }

//getcustomerdetail funtion

document.addEventListener("click", (evt) => {
    const dn1 = document.getElementById("supplier_suggestions");
    const dn2 = document.getElementById("suppliers_name");
    const dn3 = document.getElementById("category_suggestions");
    const dn4 = document.getElementById("packing");
    let te = evt.target;
    do {
        if (te == dn1 || te == dn2 || te == dn3 || te == dn4)
          return;
        te = te.parentNode;
    } while(te);
    clearSuggestions("supplier");
    clearSuggestions("category");
});
