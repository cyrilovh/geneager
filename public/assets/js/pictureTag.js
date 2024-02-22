const img = document.getElementById("picture");
const btnSubmit = document.querySelector(".addTag button.submit");
const coordonneesEl = document.getElementById("coordonnees");
const searchEL = document.querySelector("input#search");
const dialboxEl = document.querySelector(".popup");
const errorEl = document.querySelector(".alert-danger");
const infoEl = document.querySelector(".alert-info");
var countClick = 0;

/**
 * Return the width of the picture
 * @returns int
 */
function getPictureWidth() {
    return img.naturalWidth;
}

/**
 * Return the height of the picture
 * @returns int
 */
function getPictureHeight() {
    return img.naturalHeight;
}

/**
 * Resize the picture to fit the screen
 */
function resizePicture() {
    const screenWidth = window.innerWidth;
    const screenHeight = window.innerHeight;

    const pictureWidth = getPictureWidth();
    const pictureHeight = getPictureHeight();

    let newWidth = pictureWidth;
    let newHeight = pictureHeight;

    if (pictureWidth > screenWidth || pictureHeight > screenHeight) {
        const widthRatio = screenWidth / pictureWidth;
        const heightRatio = screenHeight / pictureHeight;

        if (widthRatio < heightRatio) {
            newWidth = screenWidth;
            newHeight = pictureHeight * widthRatio;
            updateCoordinates(widthRatio);
        } else {
            newHeight = screenHeight;
            newWidth = pictureWidth * heightRatio;
            updateCoordinates(heightRatio);
        }
    }

    img.style.width = newWidth + "px";
    img.style.height = newHeight + "px";
}

/**
 * Met à jour les coordonnées des tags en fonction du ratio de redimensionnement
 * @param ratio
 * @returns {void}
 */
function updateCoordinates(ratio) {
    const tagList = document.querySelectorAll(".tag");
    console.log(tagList);

    for (let i = 0; i < tagList.length; i++) {
        tagList[i].style.left = parseInt(tagList[i].style.left) * ratio + "px";
        tagList[i].style.top = parseInt(tagList[i].style.top) * ratio + "px";

        tagList[i].style.width = parseInt(tagList[i].style.width) * ratio + "px";
        tagList[i].style.height = parseInt(tagList[i].style.height) * ratio + "px";
    }
}

/**+
 * Vérifie si les coordonnées saisies sont valides
 * @returns {boolean} Optionnel: retourne true si les coordonnées sont valides, false sinon.
 */
function checkCoordinates() {
    // Récupérer la valeur du champ coordonnées
    var coordonnees = coordonneesEl.value;
    let isValide = true;
    // Séparer les valeurs en un tableau en utilisant la virgule comme séparateur
    var valeurs = coordonnees.split(',');

    // Vérifier si 4 valeurs ont été saisies
    if (valeurs.length === 4) {
        // Convertir les valeurs en nombres entiers
        var x1 = parseInt(valeurs[0]);
        var y1 = parseInt(valeurs[1]);
        var x2 = parseInt(valeurs[2]);
        var y2 = parseInt(valeurs[3]);

        // Vérifier les conditions X1 > X2 et Y1 > Y2
        if (x2 > x1 && y2 > y1) {
            // coordonnées valides
            isValide = true;
        } else {
            alert('Les coordonnées ne respectent pas les conditions suivantes: \r- X1,Y1,X2,Y2\r- X1 > X2 et Y1 > Y2\r- X et Y sont des entiers.');
            isValide = false;
        }
    } else {
        alert('Veuillez saisir 4 valeurs séparées par des virgules (X1, Y1, X2, Y2).');
        isValide = false;
    }

    if (isValide) {
        btnSubmit.disabled = false;
        return true;
    } else {
        btnSubmit.disabled = true;
        return false;
    }
}

/**
 * MESSAGE BOX
 */
/**
 * set the message box
 * @param {*} titre 
 * @param {*} message 
 */
function setMessage(titre, message) {
    document.querySelector(".message .titre").innerHTML = titre;
    document.querySelector(".message .message").innerHTML = message;
    document.querySelector(".message").style.display = "block";
}

/**
 * close the message box
 */
function closeMessage() {
    document.querySelector(".popup").style.display = "none";
}

window.addEventListener("resize", function () {
    let confirm = window.confirm("La fenêtre à été redimensionnée.\rLa page va être rechargée pour adapter la photo à l'écran.");
    if (confirm) {
        window.location.reload();
    }
});

/**
 * Return the mouse position in the image
 */
function mousePos(event, axis) {

    var posimg = img.getBoundingClientRect();

    if (axis == "x") {
        return event.clientX - posimg.left;
    } else if (axis == "y") {
        return event.clientY - posimg.top;
    } else {
        return false;
    }
}

function suggestsXHR(url, callback) {

    var xhr;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
    } else {
        throw new Error("Ajax is not supported by this browser");
    }

    xhr.open("GET", url + '?q=' + searchEL.value, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            callback(xhr.responseText);
        }
    };
}

function addTag() {
    const coordonnees = coordonneesEl.value;
    const search = searchEL.value;
    const picture = img.src;

    const data = {
        coordonnees: coordonnees,
        search: search,
        picture: picture
    };

    const url = "/XHRaddTag";

    var xhr;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
    } else {
        throw new Error("Ajax is not supported by this browser");
    }

    xhr.open("POST", url);
    xhr.setRequestHeader("Content-type", "application/json;charset=UTF-8");
    xhr.send(JSON.stringify(data));
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status == "success") {
                setMessage("Information", response.message);
            } else {
                setMessage("Erreur", response.message);
            }
        }
    };
}

// Appeler resizePicture une première fois pour redimensionner l'image initiale
window.onload = function () {
    btnSubmit.disabled = true;
    resizePicture();

    /**
     * CLICK SUR L'IMAGE
     */

    var coin = 0;
    img.addEventListener("click", function (event) {

        coin += 1;
        if (coin > 1) {
            var separateur = ",";
        } else {
            var separateur = "";
            document.getElementById("coordonnees").value = "";
        }

        /**
         * get mouse position
         */
        var posx = mousePos(event, "x");
        var posy = mousePos(event, "y");

        document.getElementById("coordonnees").value += separateur + posx + "," + posy; // save coordinates in input

        // second click
        if (coin >= 2) {
            
            coin = 0;
            if(checkCoordinates()) {
                document.querySelector("div.addTag").style.display = "block";
            }
        }
    });

    /***
     * CHECK OUT IF COORDINATES ARE WRONG OR TRUE
     */
    coordonneesEl.addEventListener("focusout", function () { 
        checkCoordinates();
    });

    searchEL.addEventListener("keyup", function () {
        var search = searchEL.value;
        suggestsXHR("/XHRsuggestByIdentity/", function (data) {
            if(data){
                obj = JSON.parse(data);

                if(obj.status){
                    if(obj.status == "success"){
                        // SUCCESS: there suggestions so i display them
                        errorEl.style.display = "none";
                        infoEl.style.display = "block";
                        if(obj.message){
                            infoEl.innerHTML = obj.message;
                        }

                        const countResult  = Object.keys(obj.data).length;
                        var output = "";

                        // loop on each result
                        for (let i = 0; i < countResult; i++) {
                            output += `
                            <div class="item" data-data="${obj.data[i].id}">
                                <img src="${obj.data[i].picture}" class="thumbnail" />
                                <div class="label">
                                    <div class="identity text">${obj.data[i].identity}</div>
                                    <div class="dates">${obj.data[i].birthYear}-${obj.data[i].deathYear}</div>
                                </div>
                            </div>
                            `;
                        }

                        // display the result
                        document.querySelector(".suggestionList").innerHTML = output;

                    }else if(obj.status == "error"){
                        if(obj.message){
                            errorEl.style.display = "block";
                            infoEl.style.display = "none";
                            errorEl.innerHTML = obj.message;
                        }
                    }else if(obj.status == "info"){
                        if(obj.message){
                            errorEl.style.display = "none";
                            infoEl.style.display = "block";
                            infoEl.innerHTML = obj.message;
                        }
                    }else{
                        console.log(data);
                    }
                }else{
                    alert("oups");
                }
            }else{
                alert("Erreur lors de la récupération des données.")
            }
        });
    });
};
