function getPictureWidth(img) {
    return img.naturalWidth;
}

function getPictureHeight(img) {
    return img.naturalHeight;
}

function resizePicture() {
    const img = document.getElementById("picture");
    const screenWidth = window.innerWidth;
    const screenHeight = window.innerHeight;

    const pictureWidth = getPictureWidth(img);
    const pictureHeight = getPictureHeight(img);

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
    alert("updateCoordinates");
    const tagList = document.querySelectorAll(".tag");
    console.log(tagList);
    for(let i = 0; i < tagList.length; i++) {
        tagList[i].style.left = parseInt(tagList[i].style.left) * ratio + "px";
        tagList[i].style.top = parseInt(tagList[i].style.top) * ratio + "px";

        tagList[i].style.width = parseInt(tagList[i].style.width) * ratio + "px";
        tagList[i].style.height = parseInt(tagList[i].style.height) * ratio + "px";
    }
}

window.addEventListener("resize", resizePicture);

// Appeler resizePicture une première fois pour redimensionner l'image initiale
window.onload = function() {
    resizePicture();
};
