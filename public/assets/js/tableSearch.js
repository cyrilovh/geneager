/**
 * This function is used to search in a HTML table
 * @param {*} input input element to search on (use "this", "document.getElementById('myInput')", ...)
 * @param {*} tableId The id attribute of the table to search in
 */
function tableSearch(input, tableId) {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    //input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById(tableId);
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            txtValue = td[j].textContent || td[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                break;
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}