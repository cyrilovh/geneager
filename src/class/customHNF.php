<?php
/*     

custom header, navbar, footer
                                              
Basic function if user want change the default header, navbar or footer in the page

*/
namespace class;
class customHNF{
    private string $header;
    private string $navbar;
    private string $footer;

    public function __construct($include_header, $include_navbar, $include_footer){
        $this->header = $include_header;
        $this->navbar = $include_navbar;
        $this->footer = $include_footer;
    }     
    
    /**
     * Get data from object (header/navbar/footer)
     *
     * @param string $data
     * @return void
     */
    public function get(string $data){
        $v = $this->$data;
        if(trim($v)!=""){
            $f = MVC."inc/".$v.".inc.php";
            if(file_exists($f)){
                return $f;
            }elseif(trim($v)=="none"){
                return null;
            }else{
                return MVC."inc/".$data.".inc.php";
                if(PROD==false){
                    trigger_error("<p class='dev_critical'><b>$f</b> is missing.</p>", E_USER_WARNING);
                }
            }
        }else{
            return MVC."inc/".$data.".inc.php";
        }
    }
}
?>