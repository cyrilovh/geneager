<?php
/*     

custom header, navbar, footer
                                              
Basic function if user want change the default header, navbar or footer in the page

*/
namespace class;
class HNF{
    private ?string $header;
    private ?string $navbar;
    private ?string $footer;

    public function __construct(?string $header, ?string $navbar, ?string $footer){
        $this->header = $header;
        $this->navbar = $navbar;
        $this->footer = $footer;
    }

    public function setHeader(?string $header):void{
        $this->header = $header;
    }

    public function setNavbar(?string $navbar):void{
        $this->navbar = $navbar;
    }

    public function setFooter(?string $footer):void{
        $this->footer = $footer;
    }

    public function getHeader():?string{
        return self::get($this->header);
    }

    public function getNavbar():?string{
        return self::get($this->navbar);
    }

    public function getFooter():?string{
        return self::get($this->footer);
    }
    
    /**
     * Get data from object (header/navbar/footer)
     *
     * @param string $data
     * @return string
     */
    private function get(?string $file):?string{

        if(trim($file)!=""){
            $file = MVC."inc/$file.inc.php";
            if(file_exists($file)){
                return $file;
            }
        }
        return MVC."inc/blank.inc.php";

    }
}
?>