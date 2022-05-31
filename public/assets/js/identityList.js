// Definitions of the elements
let orderBy = document.querySelector('[name=orderBy]');

// URL Parameters
let urlString = window.location.href; // current url
let paramString = urlString.split('?')[1]; // get the parameters
let queryString = new URLSearchParams(paramString);


document.querySelectorAll('.filter').forEach(item => {
    // update elements values
    for (let pair of queryString.entries()) {
        if (item.name === pair[0]) {
            item.value = pair[1];
        }
    }

    // Update URL Parameters
    item.addEventListener('change', function() {
        let newParameters = []; // Array (will) contain original parameters
        let newUrl = '?'; // String (will) contain new URL

        // i update value of the parameters in array if the key exists
        for (let pair of queryString.entries()) {
            alert(`${pair[0]}, ${pair[1]}`);
            if (pair[0] != this.name) {
                newParameters.push(pair[0] + '=' + pair[1]);
            } else {
                pair[0] = this.value;
            }
        }

        // i add key and value to the array if the key is not in URL parameters
        if (newParameters[this.name] === undefined) {
            newParameters.push(this.name + '=' + this.value);
            alert("add:" + this.name);
        }

        // Create new URL
        for (let i = 0; i < newParameters.length; i++) {
            newUrl += newParameters[i];
            if (i < newParameters.length - 1) {
                newUrl += '&';
            }
        }

        // Redirect to new URL
        window.location.href = newUrl;
    });
});