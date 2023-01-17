<?php
/*
  ______ ____  _____  __  __  _____ 
 |  ____/ __ \|  __ \|  \/  |/ ____|
 | |__ | |  | | |__) | \  / | (___  
 |  __|| |  | |  _  /| |\/| |\___ \ 
 | |   | |__| | | \ \| |  | |____) |
 |_|    \____/|_|  \_\_|  |_|_____/ 
                                    
                                    
*/
namespace class;
class form{
    public $attr;
    public $element;
    /**
     * Constructor
     * object = <form ...>...</form>
     *
     * @param array $attr MUST contain the attr "method" and "action". Can contain the attribute class.
     * @param array $element Elements of the form (input, texarea, ...).
     * @param boolean $token CRSF token
     */

    public function __construct(array $attr, array $element = array(), bool $token = true){
        $this->method = (array_key_exists('method', $attr)) ? $attr["method"] : "";
        $this->action = (array_key_exists('action', $attr)) ? $attr["action"] : "";
        $this->class = (array_key_exists('class', $attr)) ? $attr["class"] : "";
        $this->enctype = (array_key_exists('enctype', $attr)) ? $attr["enctype"] : "";

        $this->element = $element;

        $this->token = $token;
        
        // i add a hidden input in the form with the token if enabled
        if($token){
            $this->setElement("input", array(
                "type" => "hidden",
                "name" => "token",
                "value" => \class\token::gen(),
                "class" => "form-control"
            ));
        }

    }
    /**
     * Add element into a form
     *
     * @param string $tag
     * @param array $attribut
     * @param array $html (can contain the key "before" and "after" for add HTML or text before or after the element)
     * @return void
     */
    public function setElement(string $tag, array $attribut, array $html=array()):void{
        $element = array();
        // input, button
        $tag = trim(strtolower($tag));
        if($tag=="input" || $tag=="button" || $tag=="textarea" || "select"){
            $element["tag"] = $tag;
            $element["attributList"] = $attribut; 
            $element["html"] = $html;
            $this->element[] = $element;
        }else{
            if(PROD==false){
                trigger_error("<p class='dev_critical'>Error &laquo; $tag &raquo; : is not yet compatible...</p>", E_USER_ERROR);
            }
        }
    }

    /**
     * Display form as HTML format
     *
     * @return string
     */
    public function display():string{
 
        $return = "<form action='{$this->action}' method='{$this->method}' class='{$this->class}' enctype='{$this->enctype}'>"; // start of the string

        foreach($this->element as $k => $arrayElement){
            if(array_key_exists('tag', $arrayElement)){
                if(array_key_exists('attributList', $arrayElement)){
                    if(array_key_exists('name', $arrayElement["attributList"])){

                        // add HTML after or before an element
                        if(gettype($arrayElement["html"])=="array"){
                            $htmlBefore = (array_key_exists('before', $arrayElement["html"])) ? $arrayElement["html"]["before"] : "";
                            $htmlAfter = (array_key_exists('after', $arrayElement["html"])) ? $arrayElement["html"]["after"] : "";
                        }else{
                            if(PROD==true){
                                trigger_error("<p class='dev_critical txt-center'>The third element in the method setElement must be an array. This array can contain the keys 'before' and 'after'.</p>", E_USER_ERROR);
                            }
                        }

                        $tag = format::normalize($arrayElement["tag"]);
                        $attr = "";
                        if($tag=="input"){
                            foreach($arrayElement["attributList"] as $attribute => $attrValue){
                                if($attribute!="html"){
                                    $attr .= " {$attribute}='{$attrValue}'";
                                }
                            }
                            $return .= "$htmlBefore<$tag $attr />$htmlAfter";
                        }elseif($tag=="textarea" || $tag=="button"){
                            foreach($arrayElement["attributList"] as $attribute => $attrValue){
                                if(trim(strtolower($attribute))!="value"){
                                    if($attribute!="html"){
                                        $attr .= " {$attribute}='{$attrValue}'";
                                    }
                                }
                            }
                            $value = array_key_exists('value', $arrayElement["attributList"]) ? $arrayElement["attributList"]["value"]: "nothing...";
                            $return .= "$htmlBefore<$tag $attr >$value</textarea>$htmlAfter"; 
                        }elseif($tag=="select"){
                            // multiple select debug (1/2)
                            if(in_array(format::normalize("multiple"), $arrayElement["attributList"])){
                                if(!in_array(format::normalize("required"), $arrayElement["attributList"])){
                                    $arrayElement["attributList"]["required"] = NULL;
                                }
                            }

                            // i continue (multiple or single)
                            foreach($arrayElement["attributList"] as $attribute => $attrValue){
                                if(trim(strtolower($attribute))!="option"){
                                    if($attribute!="html"){
                                        $attr .= " {$attribute}='{$attrValue}'";
                                    }
                                }
                            }
                            $optionList = "";
                            if(array_key_exists('option', $arrayElement["attributList"])){
                                if(gettype($arrayElement["attributList"]["option"])=="array"){
                                    // multiple select debug (1/2)
                                    if(in_array(format::normalize("multiple"), $arrayElement["attributList"])){
                                        $arrayElement["attributList"]["option"][NULL]="";
                                    }

                                    foreach($arrayElement["attributList"]["option"] as $kOption => $vOption){
                                        $selected = (array_key_exists("value", $arrayElement["attributList"])) ? (($kOption == $arrayElement["attributList"]["value"]) ? "selected" : "") : "" ;
                                        $optionList .= "<option value='$kOption' $selected>$vOption</option>";
                                    }
                                }else{
                                    http_response_code(500);
                                    if(PROD==false){
                                        trigger_error("<p class='dev_critical txt-center'>Internal error: the key &quot; option &quot; for the &quot; select &quot; must be an array.</p>", E_USER_ERROR);
                                    }else{
                                        die("<p class='dev_critical txt-center'>Erreur 500: activez le mode &laquo; dev &raquo; si vous êtes l'administrateur du site pour plus d'informations.</p>");
                                    }  
                                }
                            }else{
                                if(PROD==false){
                                    trigger_error("<p class='dev_critical txt-center'>Internal error: the key &quot; option &quot; for the &quot; select &quot; is missing.</p>", E_USER_ERROR);
                                } 
                            }
                            $return .= "$htmlBefore<$tag $attr>$optionList</$tag>$htmlAfter";
                        }else{
                            http_response_code(500);
                            if(PROD==false){
                                trigger_error("<p class='dev_critical txt-center'>Internal error: type of element unknown</p>", E_USER_ERROR);
                            }else{
                                die("<p class='dev_critical txt-center'>Erreur 500: activez le mode &laquo; dev &raquo; si vous êtes l'administrateur du site pour plus d'informations.</p>");
                            }
                        }
                    }else{
                        http_response_code(500);
                        if(PROD==false){
                            trigger_error("<p class='dev_critical txt-center'>Internal error: one or severals element(s) of the form has not name.</p>", E_USER_ERROR);
                        }else{
                            die("<p class='dev_critical txt-center'>Erreur 500: activez le mode &laquo; dev &raquo; si vous êtes l'administrateur du site pour plus d'informations.</p>");
                        }    
                    }
                }else{
                    http_response_code(500);
                    if(PROD==false){
                        trigger_error("<p class='dev_critical txt-center'>Internal error: any HTML attribute found for on more more elements</p>", E_USER_ERROR);
                    }else{
                        die("<p class='dev_critical txt-center'>Erreur 500: activez le mode &laquo; dev &raquo; si vous êtes l'administrateur du site pour plus d'informations.</p>");
                    }    
                }
            }else{
                http_response_code(500);
                if(PROD==false){
                    trigger_error("<p class='dev_critical txt-center'>Internal error: tag unknown</p>", E_USER_ERROR);
                }else{
                    die("<p class='dev_critical txt-center'>Erreur 500: activez le mode &laquo; dev &raquo; si vous êtes l'administrateur du site pour plus d'informations.</p>");
                }    
            }
        }
        return $return."</form>"; // end of the string
    }    

    /**
     * Return the number of elements expected in the form (all except with the HTML attribute "disabled")
     * @param array $array
     * @return string
     */
    private function trueCount(array $elementList):int{
        $count = count($elementList);
        foreach($elementList as $element){
            if(array_key_exists("attributList", $element)){
                if(array_key_exists("disabled", $element["attributList"])){
                    if($element["attributList"]["disabled"]=="disabled" || $element["attributList"]["disabled"]=="true"){
                        $count--;
                    }
                }
            }
        }
        return $count;
    }

    /**
     * Check if all fields of the form are corrects
     *
     * @return array
     * @return $returnBool If the option is on "true": Return if the form is correct or not (return true if the form is correct else false). If the option is off "false": Return an array of the errors.  
     * 
     */
    public function check(bool $returnBool = true):string|bool{
        $err =  array(
            "date" => "Format de la date incorrect",
            "ie" => "Internal error.",
            "require" => "Tous les champs sont requis ne sont pas complétés.",
            "nodata" => "Pas de données envoyées.",
            "minlength" => "Un ou des champs ne respecte pas la longueur minimum requise.",
            "maxlength" => "Un ou des champs dépasse la longueur maximum.",
            "email" => "Un ou des champs e-mail invalide(s): vérifiez le format.",
            "number" => "Un ou des champs incorrect(s): une valeur numérique est attendue.",
            "min" => "Un ou des champs incorrect(s): une valeur numérique est inférieur à celle attendue.",
            "max" => "Un ou des champs incorrect(s): une valeur numérique est supérieure à celle attendue.",
            "hex" => "Un ou plusieur(s) champ(s) couleur HEX invalides.",
            "unexpectedVal" => "Erreur: valeur(s) non-attendu(s) d'un ou plusieurs menu déroulants.",
            "unexpectedVal2" => "Erreur: une seule valeur attendue pour un ou plusieurs menu déroulant.",
            "misElmt" => "Element(s) de formulaire en trop ou manquant.",
            "token" => "Token invalide ou expiré.",
            "url" => "Format d'URL invalide."
        );
        $errorList = array();
        $methodUsed = (format::normalize($this->method)=="post") ? "POST" : "GET";
        $dataSubmit = (format::normalize($this->method)=="post") ? array_merge($_POST, $_FILES) : array_merge($_GET, $_FILES);

        //var_dump($this->element);

        if(count($dataSubmit)>0){ // i check if i have data (if the form is submit)
            if(count($dataSubmit)==form::trueCount($this->element)){ // check if number of parameters get/post

                // TOKEN CHECK
                if($this->token){
                    if(isset($dataSubmit["token"])){
                        if(token::check($dataSubmit["token"])){
                            $tokenIsValid = true;
                        }else{
                            $tokenIsValid = false;
                            $errorList[] = $err["token"];
                        }
                    }else{
                        $tokenIsValid = false;
                        $errorList[] = $err["misElmt"];
                    }

                }else{
                    $tokenIsValid = true; // if token is disabled for the form
                }

                if($tokenIsValid){
                    // FIRST ARRAY
                    $elementListNameFromObj = array(); // i create a new array for add the name of all elements form object 
                    foreach($this->element as $k => $arrayElement){ // for each element
                        $elementListNameFromObj[] = $arrayElement["attributList"]["name"]; // i add in array the name of all elements from object
                    }

                    // SECOND ARRAY
                    $elementListNameFromSubmit = array(); // array for retrieve all names for elements from submit (i don't will use array_reverse for security reasons and possible conflicts)
                    foreach($dataSubmit as $kDataSubmit => $vDataSubmit){
                        $elementListNameFromSubmit[] = security::cleanStr($kDataSubmit); 
                    }

                    // COMPARE ARRAYS
                    if(sort($elementListNameFromObj) == sort($elementListNameFromSubmit)){ // all names of the form aren't wrong (all input field names from form are expected)
                        foreach($this->element as $k => $arrayElement){
                            $tag = format::normalize($arrayElement["tag"]);
                            if($tag == "textarea" || $tag == "input" || $tag == "select"){
                                // CHECK IF FIELD IS REQUIRED
                                $bypassCheckLength = false;
                                if(array_key_exists('required', $arrayElement["attributList"])){ // i check if there the attr required in object
                                    //  IN THIS FOLLOWING CONDITION WILL CHECK IF I'VE A VALUE IN THE FIELD OR NOT (of my required field)
                                    if(gettype($dataSubmit[$arrayElement["attributList"]["name"]]) == "array"){ // for file input 
                                        $valueField = security::cleanStr($dataSubmit[$arrayElement["attributList"]["name"]]["name"]);
                                    }else{ // for all fields except file input
                                        $valueField = security::cleanStr($dataSubmit[$arrayElement["attributList"]["name"]]);
                                    }

                                    if($valueField==""){
                                        $errorList[] = $err["require"];
                                        $bypassCheckLength = true;
                                        if(PROD==false){
                                            trigger_error("<p class='dev_critical'>One or more element required bypassed.</p>", E_USER_ERROR);
                                        }  
                                    }
                                }
                                // IT'S NOT NECESSARY TO CHECK MAX/MINLENGTH IF THE REQUIRED FIELD IS EMPTY
                                if($bypassCheckLength == false){
                                    // CHECK IF MAXLENGTH/MINLENGTH
                                    $minORmaxLength = array("minlength", "maxlength");
                                    foreach($minORmaxLength as $vMinMax){
                                        
                                        if(array_key_exists($vMinMax, $arrayElement["attributList"])){
                                            if(is_numeric(format::normalize($arrayElement["attributList"][$vMinMax]))){ // check if it's an integer
                                                
                                                    if($vMinMax=="minlength"){
                                                        if(strlen(format::normalize($dataSubmit[$arrayElement["attributList"]["name"]])) < $arrayElement["attributList"][$vMinMax]){ // if data form form > maxlength
                                                            $errorList[] = $err["minlength"];
                                                        }
                                                    }else{
                                                        if(strlen(format::normalize($dataSubmit[$arrayElement["attributList"]["name"]])) > $arrayElement["attributList"][$vMinMax]){ // if data form form > maxlength
                                                            $errorList[] = $err["maxlength"];
                                                        }
                                                    }
                                            }else{
                                                $errorList[] = $err["ie"];
                                                if(PROD==false){
                                                    trigger_error("<p class='dev_critical'>$vMinMax MUST BE an integer.</p>", E_USER_ERROR);
                                                }  
                                            }
                                        }
                                    }
                                }

                                // CHECK OUT IF INPUT TYPE IS NOT WRONG
                                if($tag == "input"){
                                    if(array_key_exists('type', $arrayElement["attributList"])){
                                        if(format::normalize($arrayElement["attributList"]["type"])=="email"){
                                            if (!filter_var($dataSubmit[$arrayElement["attributList"]["name"]], FILTER_VALIDATE_EMAIL)) {
                                                $errorList[] = $err["email"];
                                            }
                                        }else if(format::normalize($arrayElement["attributList"]["type"])=="url"){
                                            if(array_key_exists("required", $arrayElement["attributList"])){ // IF URL IS REQUIRED
                                                if (!filter_var($dataSubmit[$arrayElement["attributList"]["name"]], FILTER_VALIDATE_URL)) {
                                                    $errorList[] = $err["url"];
                                                }
                                            }else{
                                                if(strlen(format::normalize($dataSubmit[$arrayElement["attributList"]["name"]]))>0){
                                                    if (!filter_var($dataSubmit[$arrayElement["attributList"]["name"]], FILTER_VALIDATE_URL)) { // if url is not required BUT provided by user
                                                        $errorList[] = $err["url"];
                                                    }
                                                }
                                            }
                                        }else if(format::normalize($arrayElement["attributList"]["type"])=="date"){
                                            if(array_key_exists("required", $arrayElement["attributList"])){ // IF DATE IS REQUIRED
                                                if (!validator::isDateTime($dataSubmit[$arrayElement["attributList"]["name"]], "Y-m-d")) {
                                                    $errorList[] = $err["date"];
                                                }
                                            }else{
                                                if(strlen(format::normalize($dataSubmit[$arrayElement["attributList"]["name"]]))>0){ // if not required BUT provided by user
                                                    if (!validator::isDateTime($dataSubmit[$arrayElement["attributList"]["name"]], "Y-m-d")) { // check format date
                                                        $errorList[] = $err["date"];
                                                    }else{
                                                        if(!validator::isDate($dataSubmit[$arrayElement["attributList"]["name"]])){ // check if date exist
                                                            $errorList[] = $err["date"];
                                                        }
                                                    }
                                                }
                                            }
                                        }elseif(format::normalize($arrayElement["attributList"]["type"])=="number" || format::normalize($arrayElement["attributList"]["type"])=="range"){
                                            if(!is_numeric($dataSubmit[$arrayElement["attributList"]["name"]])){
                                                $errorList[] = $err["number"];
                                            }else{
                                                // IF IS THE VALUE IS NUMERIC
                                                // attr: min
                                                if(array_key_exists("min", $arrayElement["attributList"])){ // if the attribute "min" is init in object
                                                    if(is_numeric($arrayElement["attributList"]["min"])){
                                                        if(intval($dataSubmit[$arrayElement["attributList"]["name"]]) < intval($arrayElement["attributList"]["min"])){
                                                            $errorList[] = $err["min"];
                                                        }
                                                    }else{
                                                        $errorList[] = $err["ie"];
                                                        if(PROD==false){
                                                            trigger_error("<p class='dev_critical'>Check out if the attribute &quot, min &quot; is a numeric value.</p>", E_USER_ERROR);
                                                        }    
                                                    }
                                                }
                                                // attr: max
                                                if(array_key_exists("max", $arrayElement["attributList"])){ // if the attribute "min" is init in object
                                                    if(is_numeric($arrayElement["attributList"]["max"])){
                                                        if(intval($dataSubmit[$arrayElement["attributList"]["name"]]) > intval($arrayElement["attributList"]["max"])){
                                                            $errorList[] = $err["max"];
                                                        }
                                                    }else{
                                                        $errorList[] = $err["ie"];
                                                        if(PROD==false){
                                                            trigger_error("<p class='dev_critical'>Check out if the attribute &quot, min &quot; is a numeric value.</p>", E_USER_ERROR);
                                                        }    
                                                    }
                                                }     
                                            }
                                        }elseif($arrayElement["attributList"]["type"]=="color"){
                                            if(!preg_match('/^#[a-f0-9]{6}$/i', $dataSubmit[$arrayElement["attributList"]["name"]])){
                                                $errorList[] = $err["hex"];
                                                if(PROD==false){
                                                    trigger_error("<p class='dev_critical'>One ore more attribute(s) &quot; type &quot; missing in the tag &quot; input &quot;.</p>", E_USER_ERROR);
                                                }         
                                            }
                                        }
                                    }else{
                                        $errorList[] = $err["ie"];
                                        if(PROD==false){
                                            trigger_error("<p class='dev_critical'>One ore more attribute(s) &quot; type &quot; missing in the tag &quot; input &quot;.</p>", E_USER_ERROR);
                                        }     
                                    }
                                }

                                // IF SELECT
                                if($tag=="select"){
                                    if(array_key_exists('option', $arrayElement["attributList"])){
                                        if(gettype($arrayElement["attributList"]["option"])=="array"){ // i check if the option value provided is of type "array"
                                            if(array_key_exists("multiple", $arrayElement["attributList"])){ // IF SELECT MULTIPLE EXPECTED
                                                // MULTIPLE VALUES RETURNED
                                                if(gettype($dataSubmit[$arrayElement["attributList"]["name"]])=="array"){
                                                    $cleanArr = format::cleanArr($dataSubmit[$arrayElement["attributList"]["name"]]);
                                                    if(count($cleanArr)>0){
                                                        foreach($cleanArr as $value){
                                                            if(!array_key_exists($value, $arrayElement["attributList"]["option"])){
                                                                $errorList[] = $err["unexpectedVal"];
                                                                if(PROD==false){
                                                                    trigger_error("<p class='dev_critical'>Security: the value sended form &quot; select &quot; dont't feel be in the object.</p>", E_USER_ERROR);
                                                                }   
                                                            }
                                                        }
                                                    }else{
                                                        $errorList[] = $err["unexpectedVal"];
                                                    }
                                                }else{
                                                    // IF ALONE VALUE RETURNED
                                                    if(!array_key_exists($dataSubmit[$arrayElement["attributList"]["name"]], $arrayElement["attributList"]["option"])){ // i check if the value sended is in array (object)
                                                        if(array_key_exists("required", $arrayElement["attributList"])){
                                                            $errorList[] = $err["unexpectedVal"];
                                                            if(PROD==false){
                                                                trigger_error("<p class='dev_critical'>Security: the value sended form &quot; select &quot; dont't feel be in the object.</p>", E_USER_ERROR);
                                                            }   
                                                        }
                                                    }
                                                }
                                            }else{
                                                // IF ALONE VALUE EXPECTED
                                                if(gettype($dataSubmit[$arrayElement["attributList"]["name"]])=="string"){
                                                    if(!array_key_exists($dataSubmit[$arrayElement["attributList"]["name"]], $arrayElement["attributList"]["option"])){ // i check if the value sended is in array (object)
                                                        $errorList[] = $err["unexpectedVal"];
                                                        if(PROD==false){
                                                            trigger_error("<p class='dev_critical'>Security: the value sended form &quot; select &quot; dont't feel be in the object.</p>", E_USER_ERROR);
                                                        }   
                                                    }
                                                }else{
                                                    $errorList[] = $err["unexpectedVal2"];
                                                    if(PROD==false){
                                                        trigger_error("<p class='dev_critical'>Security: string expected for &quot; select &quot; field.</p>", E_USER_ERROR);
                                                    }   
                                                }
                                            }
                                        }else{
                                            $errorList[] = $err["ie"];
                                            if(PROD==false){
                                                trigger_error("<p class='dev_critical'>Check out the element(s) &quot; select &quot;: value of type array expected.</p>", E_USER_ERROR);
                                            }   
                                        }
                                    }else{
                                        $errorList[] = $err["ie"];
                                        if(PROD==false){
                                            trigger_error("<p class='dev_critical'>Check out the element(s) &quot; select &quot;: a dropdown must contain an array with value(s).</p>", E_USER_ERROR);
                                        }   
                                    }
                                }
                            }else{
                                $errorList[] = $err["ie"];
                                if(PROD==false){
                                    trigger_error("<p class='dev_critical'>Unrecognized form element (tag).</p>", E_USER_ERROR);
                                }  
                            }
                        }
                    }else{
                        $errorList[] = $err["misElmt"];
                        if(PROD==false){
                            trigger_error("<p class='dev_critical'>Check if all submitted data $methodUsed is expected (that there is no more data sent).</p>", E_USER_ERROR);
                        }  
                    }
                }
            }else{
                $errorList[] = $err["misElmt"];
                if(PROD==false){
                    echo "<p>Send:".count($dataSubmit)." elements. Expected: ".form::trueCount($this->element)." elements</p>";
                    trigger_error("<p class='dev_critical'>Check if each all elements of the form have an attribute &laquo; name &raquo;</p>", E_USER_ERROR);
                }
            }
        }else{
            $errorList[] = $err["nodata"]; 
        }

        // return data
        if($returnBool == true){
            if(count($errorList) == 0){
                return true;
            }else{
                return false;
            }
        }else{
            return implode("<br>",$errorList);
        }
        
    }

    /**
     * EXPERIMENTAL METHOD 1 - FOR GETTING ALL FIELDS OF THE FORM (used into updateData from class db)
     * GET ALL FIELDS NAMES OF THE FORM EXCEPT THE HIDDEN FIELDS AND DISABLED FIELDS
     * @param string $methodUsed
     * @return array
     */
    public function getFieldList():array{
        $fields = array();
        foreach($this->element as $element){
            if(!array_key_exists("disabled", $element["attributList"])){ // IF THE FIELD IS DISABLED

                if($element["tag"]=="input"){
                    if(array_key_exists("type", $element["attributList"])){ // IF THE FIELD IS HIDDEN
                        if($element["attributList"]["type"] != "hidden" && $element["attributList"]["type"] != "submit"  && $element["attributList"]["type"] != "button"){
                            $fields[] = $element["attributList"]["name"];
                        }
                    }
                }else if($element["tag"] || $element["tag"]){
                    $fields[] = $element["attributList"]["name"];
                }

                


            }
        }
        return $fields;
    }

    /**
     * EXPERIMENTAL METHOD 1 - FOR GETTING ALL FIELDS DATA (used into updateData from class db)
     * @return array Return array: fieldname => value
     */
    public function getData():array{
        $method = (\strtoupper($this->method) == "POST") ? $_POST : $_GET;
        $fieldList = $this->getFieldList();

        $output = array();
        echo "<br>count: ".count($fieldList)." fields<br>";
        foreach($fieldList as $fieldName){
            $ouput[$fieldName] = $method[$fieldName];
            echo $fieldName." => ".$method[$fieldName]."<br>";
        }
        echo count($output);
        return $output;
    }
}

?>