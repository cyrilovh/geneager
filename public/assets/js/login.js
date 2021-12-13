// add or allow to go back-1
btnBack = document.querySelector(".back");
btnHome = document.querySelector(".home");
if (document.referrer != "") {
    btnHome.style.display = "none";
    btnBack.addEventListener("click", function(e){
        window.history.back();
    });
}else{
    btnBack.style.display= "none";
    btnHome.addEventListener("click", function(e){
        window.location.href="/";
    });   
}