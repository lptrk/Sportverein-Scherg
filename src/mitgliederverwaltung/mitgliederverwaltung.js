function showModal() {
  document.getElementById("edit-div").style.display = "block";
  document.getElementsByClassName("container-div").style.webkitFilter =
    "blur(1px)";
}

function closeModal() {
  document.getElementById("edit-div").style.display = "none";
  document.getElementById("body").style.webkitFilter = "blur(0px)";
}

function openAddModal() {
  document.getElementById("add-div").style.display = "block";
}

function closeAddModal() {
  document.getElementById("add-div").style.display = "none";
}

function lookForEntry() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("Freitextsuche");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0]; // for column one
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    td4 = tr[i].getElementsByTagName("td")[4];
    td5 = tr[i].getElementsByTagName("td")[5];

    /* ADD columns here that you want you to filter to be used on */
    if (td) {
      if (
        td.innerHTML.toUpperCase().indexOf(filter) > -1 ||
        td1.innerHTML.toUpperCase().indexOf(filter) > -1 ||
        td2.innerHTML.toUpperCase().indexOf(filter) > -1 ||
        td3.innerHTML.toUpperCase().indexOf(filter) > -1 ||
        td4.innerHTML.toUpperCase().indexOf(filter) > -1 ||
        td5.innerHTML.toUpperCase().indexOf(filter) > -1
      ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
