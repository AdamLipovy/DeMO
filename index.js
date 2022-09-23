function sort(element, filterName) {
  // Declare variables
  var filter, table, tr, td, i, txtValue;
  filter = element.value.toUpperCase();
  console.log(filter);
  table = document.querySelector('table#myTable tbody');
  tr = table.getElementsByTagName("tr");
  const rowNames= ["number","name","subject","class"];
  let index = rowNames.indexOf(filterName);
  console.log(tr);
  
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[index];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}