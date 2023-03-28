// CHECK FILE SIZE BEFORE UPLOAD
var uploadField = document.querySelectorAll("input[type='file']");
for (var i = 0; i < uploadField.length; i++) {
    uploadField[i].addEventListener("change", function() {
        if (this.hasAttribute('maxsize')) {
            if (this.files[0].size > this.getAttribute('maxsize')) { // check if file size is bigger than maxsize
                alert(`Le fichier ${this.files[0].name} est trop volumineux.\nLa taille maximale autorisée est de ${this.getAttribute('maxsize')} octets.`);
                this.value = "";
            } else {
                console.log("File size OK: " + this.files[0].name);
            }
        } else {
            console.log('no maxsize for ' + uploadField[i].name);
        }
    });
}


// CHECK CONFIRM FIELDS
let confirmField = document.querySelectorAll("input[name$='Confirm']"); // get all fields ending with "Confirm"
let sourceFieldListName = []; // list of source fields name to check
let fieldListNameListened = []; // list of fields to listened (event)

for (i = 0; i < confirmField.length; i++) {
    let suffixe = confirmField[i].name.replace("Confirm", ""); // get source field name (without "Confirm")
    if (document.querySelector("input[name='" + suffixe + "']")) { // i check if the source field exists
        sourceFieldListName.push(suffixe); // add source field name to the list
        fieldListNameListened.push(suffixe); // add source field name to the list
        fieldListNameListened.push(confirmField[i].name); // add confirm field name to the list
    }
}

for (i = 0; i < fieldListNameListened.length; i++) { // for each field to listened
    document.querySelector("input[name='" + fieldListNameListened[i] + "']").addEventListener("keyup", function() {
        for (j = 0; j < sourceFieldListName.length; j++) {
            $field1 = document.querySelector("input[name='" + sourceFieldListName[j] + "']");
            $field2 = document.querySelector("input[name='" + sourceFieldListName[j] + "Confirm']");
            if ($field1.value != $field2.value) {
                console.log("Les champs " + $field1.name + " et " + $field2.name + " ne correspondent pas.");
                $field2.classList.add("is-invalid");
                document.querySelector("input[type='submit']").setAttribute("disabled", "disabled");
            } else {
                console.log("Les champs " + $field1.name + " et " + $field2.name + " correspondent.");
                $field2.classList.remove("is-invalid");
                document.querySelector("input[type='submit']").removeAttribute("disabled");
            }
        }
    });
}