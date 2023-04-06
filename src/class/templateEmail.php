<?php

namespace class;

/**
 * Class template
 * @package class
 */
class templateEmail
{
    /**
     * Get the template by name into the template folder
     * The templates are in html and are into the template folder
     * The template system permitt to use the same template for all the pages
     * In general you can include a variable in the template by using {variableName}: the variable will be replaced by the value with str_replace function for example
     * @param string $templateName
     * @return string
     */
    private static function get(string $templateName): string
    {
        $file = SRC_DIR . "templateEmail/" . $templateName . ".html";
        if (file_exists($file)) {
            $template = file_get_contents($file);
            return $template;
        } else {
            return "Erreur interne du site";
        }
    }

    public static function autoReplace(string $templateName, array $data): string
    {
        global $gng_paramList;

        $template = self::get($templateName);

        $data["websiteName"] = $gng_paramList->get("websiteName");
        $data["domain"] = $_SERVER['HTTP_HOST'];
        $data["forgetPasswordTokenLifetime"] = $gng_paramList->get("forgetPasswordTokenLifetime");

        foreach ($data as $key => $value) {
            $template = str_replace("{" . $key . "}", $value, $template);
        }
        return $template;
    }

}

?>