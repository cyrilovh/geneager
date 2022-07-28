/*
  _   _     __      ______          _____       _____  ______  _____ _____   ____  _   _  _____ _______      ________ 
 | \ | |   /\ \    / /  _ \   /\   |  __ \     |  __ \|  ____|/ ____|  __ \ / __ \| \ | |/ ____|_   _\ \    / /  ____|
 |  \| |  /  \ \  / /| |_) | /  \  | |__) |    | |__) | |__  | (___ | |__) | |  | |  \| | (___   | |  \ \  / /| |__   
 | . ` | / /\ \ \/ / |  _ < / /\ \ |  _  /     |  _  /|  __|  \___ \|  ___/| |  | | . ` |\___ \  | |   \ \/ / |  __|  
 | |\  |/ ____ \  /  | |_) / ____ \| | \ \     | | \ \| |____ ____) | |    | |__| | |\  |____) |_| |_   \  /  | |____ 
 |_| \_/_/    \_\/   |____/_/    \_\_|  \_\    |_|  \_\______|_____/|_|     \____/|_| \_|_____/|_____|   \/   |______|
                                                                                                                      
                                                                                                                      
*/
/* show/hide if small screen */
const navbar = document.querySelector("nav");
if (typeof(navbar) != 'undefined' && navbar != null) {
    document.querySelector("nav .fa-bars").addEventListener("click", function() {
        if (navbar.className == "topnav") {
            navbar.className += " responsive";
            document.body.style.overflow = 'hidden';
        } else {
            navbar.className = "topnav";
            document.body.style.overflow = 'auto';
        }
    });
}

/* CLOSE BTN SIDE NAVBAR */
const btnCircle = document.querySelector("nav .fa-times-circle");
if (typeof(btnCircle) != 'undefined' && btnCircle != null) {
    btnCircle.addEventListener("click", function() {
        navbar.className = "topnav";
    });
}

/*
  _____          _____  _  ____  __  ____  _____  ______ 
 |  __ \   /\   |  __ \| |/ /  \/  |/ __ \|  __ \|  ____|
 | |  | | /  \  | |__) | ' /| \  / | |  | | |  | | |__   
 | |  | |/ /\ \ |  _  /|  < | |\/| | |  | | |  | |  __|  
 | |__| / ____ \| | \ \| . \| |  | | |__| | |__| | |____ 
 |_____/_/    \_\_|  \_\_|\_\_|  |_|\____/|_____/|______|
                                                                                                                 
*/
/* ACTION ON BTN TOGGLE */
var commut = document.querySelector(".darkmodeToggle input[type=checkbox]");
if (typeof(commut) != 'undefined' && commut != null) {
    if (typeof(commut) != 'undefined' && commut != null) {
        commut.addEventListener('click', function() {
            (document.querySelector("body").className == "dark") ? document.querySelector("body").className = "": document.querySelector("body").className = "dark";
            (localStorage.getItem("darktheme") == "1") ? localStorage.setItem("darktheme", "0"): localStorage.setItem("darktheme", "1");
        });
    }
    /* ONLOAD */
    if (localStorage.getItem("darktheme")) {
        if (localStorage.getItem("darktheme") == "1") {
            document.querySelector("body").className = "dark";
            commut.checked = true;
        }
    }
}
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
    links.forEach(function(link) {
        link.onclick = function() {
            if (this.hasAttribute("data-target") == true) {
                if (this.getAttribute("data-target") == "blank") {
                    window.open(this.getAttribute("data-href"), '_blank');
                } else {
                    window.location.href = this.getAttribute("data-href");
                }
            } else {
                window.location.href = this.getAttribute("data-href");
            }
        }
    });
})();