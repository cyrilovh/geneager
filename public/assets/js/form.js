// check file size before upload (works with single file per input)
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