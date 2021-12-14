/*
  _   _     __      ______          _____       _____  ______  _____ _____   ____  _   _  _____ _______      ________ 
 | \ | |   /\ \    / /  _ \   /\   |  __ \     |  __ \|  ____|/ ____|  __ \ / __ \| \ | |/ ____|_   _\ \    / /  ____|
 |  \| |  /  \ \  / /| |_) | /  \  | |__) |    | |__) | |__  | (___ | |__) | |  | |  \| | (___   | |  \ \  / /| |__   
 | . ` | / /\ \ \/ / |  _ < / /\ \ |  _  /     |  _  /|  __|  \___ \|  ___/| |  | | . ` |\___ \  | |   \ \/ / |  __|  
 | |\  |/ ____ \  /  | |_) / ____ \| | \ \     | | \ \| |____ ____) | |    | |__| | |\  |____) |_| |_   \  /  | |____ 
 |_| \_/_/    \_\/   |____/_/    \_\_|  \_\    |_|  \_\______|_____/|_|     \____/|_| \_|_____/|_____|   \/   |______|
                                                                                                                      
                                                                                                                      
*/
/* show/hide if small screen */
var navbar = document.querySelector("nav");
document.querySelector("nav .fa-bars").addEventListener("click",function(){
    if (navbar.className == "topnav") {
        navbar.className += " responsive";
        document.body.style.overflow = 'hidden';
    }else{
        navbar.className = "topnav";
        document.body.style.overflow = 'auto';
    }
});

/* CLOSE BTN SIDE NAVBAR */
document.querySelector("nav .fa-times-circle").addEventListener("click",function(){
    navbar.className = "topnav";
});

/* FIX NAVBAR ON TOP ON SCROLL */
window.addEventListener("scroll", function(event) {
    var top = this.scrollY,
        left = this.scrollX;

        var space = document.querySelector("header").offsetTop + document.querySelector("header").clientHeight; // space between top of menu2 and the top of the DOM
        //console.log(space+"/"+top);
        var menu2 = document.querySelector("nav");
        if(top>=space){ // fixe navbar on top
            navbar.className = "topnav";
            menu2.style.position="fixed";
            menu2.style.top="0px";
            menu2.style.left="0px";
            menu2.style.width="100%";
            menu2.style.zIndex="98";
        }else{
            menu2.style.position="";
            menu2.style.top="";
            menu2.style.left="";
            menu2.style.width="";
        }
        document.querySelectorAll("nav .dropdownMenu").forEach(function(element){
            if(!element.parentElement.parentElement.parentElement.classList.contains("responsive")){ // if dropdown is in navbar responsive
                let dropdownName = element.getAttribute("data-dropdown"); // a retrieve the name of dropdown to open
                let dropdownMenu = document.querySelector(`div.dropdownList[data-dropdown=${dropdownName}]`).classList.remove("open");
            }
        });
}, false);


/*
  _      _____ _   _ _  __ _____          _    __      __      _____  _____ _____  _____ _____ _______ 
 | |    |_   _| \ | | |/ // ____|        | |  /\ \    / /\    / ____|/ ____|  __ \|_   _|  __ \__   __|
 | |      | | |  \| | ' /| (___          | | /  \ \  / /  \  | (___ | |    | |__) | | | | |__) | | |   
 | |      | | | . ` |  <  \___ \     _   | |/ /\ \ \/ / /\ \  \___ \| |    |  _  /  | | |  ___/  | |   
 | |____ _| |_| |\  | . \ ____) |   | |__| / ____ \  / ____ \ ____) | |____| | \ \ _| |_| |      | |   
 |______|_____|_| \_|_|\_\_____/     \____/_/    \_\/_/    \_\_____/ \_____|_|  \_\_____|_|      |_|   
                                                                                                                                                                                                            
*/
/* 
USE attribute "data-href" for transform an element to a link
USE attribure "data-target" with the value "blank" for open the link in new tab
*/
(function() {
    var links = document.querySelectorAll("[data-href]");
    links.forEach(function(link){
        link.onclick = function(){
            if(this.hasAttribute("data-target")==true){
                if(this.getAttribute("data-target")=="blank"){
                    window.open( this.getAttribute("data-href"), '_blank');
                }else{
                    window.location.href = this.getAttribute("data-href");
                }
            }else{
                window.location.href = this.getAttribute("data-href");
            }
        }
    });
})();