<?php

namespace class;
/**
 * Generate paging
 */
class paging{
    /**
     * @param int $nbPage Number of pages
     * @param int $currentPage Current page
     * @return string Return pagin as HTML format (return empty string if $nbPage is <1)
     */
    public static function gen(int $nbPage, int $currentPage):string{
        if($nbPage>1){
            $return = "<div class='paging'>Page(s):";
            for($i=1; $i<=$nbPage; $i++){
                $active = ($i==$currentPage) ? "active" : "";
                $url_components = parse_url($_SERVER["REQUEST_URI"]);
                $cleanParameters = url::removeParam($_SERVER["REQUEST_URI"], "page");
                $urlComplement = "&";
                if(array_key_exists("query", $url_components)){
                    if(strlen($url_components["query"])==0){
                        $urlComplement = "?";
                    }
                }else{
                    $urlComplement = "/?";
                }
                $url = preg_replace('#/+#','/', $cleanParameters.$urlComplement."page=".$i);
                $return .= " <a href='$url' class='$active'>".$i."</a>";
            }
            return $return."</div>";
        }else{
            return "";
        }

    }
}