<?php
/*****************************************************************************************************
  _    _ ______          _____  ______ _____  
 | |  | |  ____|   /\   |  __ \|  ____|  __ \ 
 | |__| | |__     /  \  | |  | | |__  | |__) |
 |  __  |  __|   / /\ \ | |  | |  __| |  _  / 
 | |  | | |____ / ____ \| |__| | |____| | \ \ 
 |_|  |_|______/_/  __\_\_____/|______|_|  \_\
 | \ | |   /\ \    / /  _ \   /\   |  __ \    
 |  \| |  /  \ \  / /| |_) | /  \  | |__) |   
 | . ` | / /\ \ \/ / |  _ < / /\ \ |  _  /    
 | |\  |/ ____ \  /  | |_) / ____ \| | \ \    
 |_|_\_/_/___ \_\/__ |____/_/____\_\_|__\_\   
 |  ____/ __ \ / __ \__   __|  ____|  __ \    
 | |__ | |  | | |  | | | |  | |__  | |__) |   
 |  __|| |  | | |  | | | |  |  __| |  _  /    
 | |   | |__| | |__| | | |  | |____| | \ \    
 |_|    \____/ \____/  |_|  |______|_|  \_\   
                                                                                     
                                              
Basic function if user want change the default header, navbar or footer in the page

*****************************************************************************************************/
namespace gng;
class customHNF{
    public function __construct($include_header, $include_navbar, $include_footer){
        $this->header = $include_header;
        $this->navbar = $include_navbar;
        $this->footer = $include_footer;
    }     
    
    // get data from object (header/navbar/footer)
    public function get(string $data){
        $v = $this->$data;
        if(trim($v)!=""){
            $f = MVC."inc/".$v.".inc.php";
            if(file_exists($f)){
                require_once $f;
            }elseif(trim($v)=="none"){
                return null;
            }else{
                require_once MVC."inc/".$data.".inc.php";
                if(PROD==false){
                    trigger_error("<p class='dev_critical'><b>$f</b> is missing.</p>", E_USER_WARNING);
                }
            }
        }else{
            require_once MVC."inc/".$data.".inc.php";
        }
    }
}
?>