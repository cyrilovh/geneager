const img = document.getElementById("picture");
var countClick = 0;

function getPictureWidth() {
    return img.naturalWidth;
}

function getPictureHeight() {
    return img.naturalHeight;
}

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

/**
 * MESSAGE BOX
 */
function setMessage(titre, message) {
    document.querySelector(".message .titre").innerHTML = titre;
    document.querySelector(".message .message").innerHTML = message;
    document.querySelector(".message").style.display = "block";
}

function closeMessage() {
    document.querySelector(".message").style.display = "none";
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

    if(axis == "x"){
        return event.clientX - posimg.left;
    }else if(axis == "y"){
        return event.clientY - posimg.top;
    }else{
        return false;
    }
}

// Appeler resizePicture une première fois pour redimensionner l'image initiale
window.onload = function () {
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
            document.querySelector("div.addTag").style.display = "block";
        }
    });
};
