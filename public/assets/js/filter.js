/**
 * Javascript for auto redirecting the page with URL parameters updated
 * example: if user changes the filter "sort by", the page will be redirected with the new URL.
 * /identityList/?page=1 -> /identityList/?page=1&sort=create
 * Call this file
 * Add the class name "filter" to the filter fields
 * Then set an attribute name to the filter fields
 */

// URL Parameters
let urlString = window.location.href; // current url
let paramString = urlString.split('?')[1]; // get the parameters
let queryString = new URLSearchParams(paramString);


document.querySelectorAll('.filter').forEach(item => {

    // Blank option
    if (item.classList.contains("removable")) {
        var optEmpty = document.createElement("option");
        optEmpty.value = "";
        optEmpty.text = "";
        optEmpty.selected = true;
        item.add(optEmpty, 0);
    }


    // update elements values on load
    for (let pair of queryString.entries()) {
        if (item.name === pair[0]) {
            item.value = pair[1];
        }
    }

    // Update URL Parameters
    item.addEventListener('change', function() {
        let newParameters = []; // Array (will) contain original parameters
        let newURL = window.location.pathname; // String (will) contain new URL
        newURL += (newURL.charAt(newURL.length - 1) !== '/') ? "/?" : "?"; // Add slash if necessary

        // i update value of the parameters in array if the key exists
        for (let pair of queryString.entries()) {
            if (pair[0] != this.name) {
                newParameters.push(pair[0] + '=' + pair[1]);
            } else {
                pair[0] = this.value;
            }
        }

        // i add key and value to the array if the key is not in URL parameters
        if (newParameters[this.name] === undefined) {
            newParameters.push(this.name + '=' + this.value);
        }

        // Create new URL
        for (let i = 0; i < newParameters.length; i++) {
            newURL += newParameters[i];
            if (i < newParameters.length - 1) {
                newURL += '&';
            }
        }

        // Redirect to new URL
        window.location.href = newURL;
    });
});