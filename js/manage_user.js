function deleteUser(id) {
  var confirmation = confirm("ARE you sure you want to delete this user?");
  if(confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState == 4 && xhttp.status == 200)
        document.getElementById('customers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_users.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}

function editUser(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState == 4 && xhttp.status == 200)
      document.getElementById('customers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_users.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateUser(id) {
  var user_fname = document.getElementById("user_fname");
  var user_lname = document.getElementById("user_lname");
  var user_number = document.getElementById("customer_contact_number");
  var user_email = document.getElementById("email");
  var role = document.getElementById("user_role");
  if(!validateName(user_fname.value, "name_error"))
    user_fname.focus();
  else if(!validateName(user_lname.value, "lname_error"))
    user_lname.focus();
  else if(!notNull(user_email.value, "email_error"))
    user_email.focus();
  else if(!validateContactNumber(user_number.value, "contact_number_error"))
    user_number.focus();
  else if(!validateRole(role.value, 'role_error'))
    role.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState == 4 && xhttp.status == 200)
        document.getElementById('customers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_users.php?action=update&id=" + id + "&fname=" + user_fname.value + "&lname=" + user_lname.value + "&email=" + user_email.value + "&contact_number=" + user_number.value + "&role=" + role.value, true);
    xhttp.send();
  }
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState == 4 && xhttp.status == 200)
      document.getElementById('customers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_users.php?action=cancel", true);
  xhttp.send();
}

function searchUser(text) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState == 4 && xhttp.status == 200)
      document.getElementById('customers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_users.php?action=search&text=" + text, true);
  xhttp.send();
}

function makeUserAdmin(id) {
  let adminConfirmation = confirm("Are you sure you want to make this user an Admin?");
  if (adminConfirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200)
      document.getElementById('customers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_users.php?action=make_admin&id=" + id, true);
    xhttp.send();
  }
}
