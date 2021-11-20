/* 
    Function applyMaxH
    Apply the max height all the elements from the taller element
    @query: CSS selector of the elements to check
            ex: div.label div.subLabel.detail
*/
function applyMaxH(query){
    var pictureListMaxH = 0; // init - the taller div of the picture details
    document.querySelectorAll(query).forEach(function(el){
        if(el.clientHeight>pictureListMaxH){ // if the div is taller than the previous : i update the value
            pictureListMaxH = el.clientHeight;
        }
    });
    document.querySelectorAll(query).forEach(function(el){
        el.style.height= pictureListMaxH+"px";
    });
    return pictureListMaxH;
}

window.addEventListener("load", function(){
    applyMaxH("div.label div.subLabel.detail");
});