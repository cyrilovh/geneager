<?php
namespace class;

/**
 * Class template
 * @package class
 */
class template{
    /**
     * Get the template by name into the template folder
     * The templates are in html and are into the template folder
     * The template system permitt to use the same template for all the pages
     * In general you can include a variable in the template by using {variableName}: the variable will be replaced by the value with str_replace function for example
     * @param string $templateName
     * @return string
     */
    public static function get(string $templateName): string{
        $file = SRC_DIR."template/".$templateName.".html";
        if(file_exists($file)){
            $template = file_get_contents($file);
            return $template;
        }else{
            return "<!-- Template $templateName not found -->";
        }
        
    }
}