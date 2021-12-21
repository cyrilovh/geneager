<?php
/*
  ______ ____  _____  __  __  _____ 
 |  ____/ __ \|  __ \|  \/  |/ ____|
 | |__ | |  | | |__) | \  / | (___  
 |  __|| |  | |  _  /| |\/| |\___ \ 
 | |   | |__| | | \ \| |  | |____) |
 |_|    \____/|_|  \_\_|  |_|_____/ 
                                    
                                    
*/
namespace gng;
class form{
    public $attr;
    public $element;
    /*
        object = <form ...></form>
        $attr => array. MUST contain the attr "method" and "action". Can contain the attribute class.
        $element => array (in array) with the input, select, textarea 

        var_dump(obj): return HTML code   
    */
    public function __construct(array $attr, array $element = array()){
        $this->method = (array_key_exists('method', $attr)) ? $attr["method"] : "";
        $this->action = (array_key_exists('action', $attr)) ? $attr["action"] : "";
        $this->class = (array_key_exists('class', $attr)) ? $attr["class"] : "";
        $this->element = $element;
    }

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

    /*
        function for display form
    */
    public function display():string{
 
        $return = "<form action='{$this->action}' method='{$this->method}' class='{$this->class}'>"; // start of the string

        foreach($this->element as $k => $attributList){
            if(array_key_exists('tag', $attributList)){
                if(array_key_exists('attributList', $attributList)){
                    if(array_key_exists('name', $attributList["attributList"])){

                        // add HTML after or before an element
                        if(array_key_exists('html', $attributList)){
                            $htmlBefore = (array_key_exists('before', $attributList["html"]["before"])) ? $attributList["html"]["before"] : "";
                            $htmlAfter = (array_key_exists('after', $attributList["html"]["after"])) ? $attributList["html"]["after"] : "";
                        }

                        $tag = format::normalize($attributList["tag"]);
                        $attr = "";
                        if($tag=="input"){
                            foreach($attributList["attributList"] as $attribute => $attrValue){
                                $attr .= " $attribute='$attrValue'";
                            }
                            $return .= "$htmlBefore<$tag $attr />$htmlAfter";
                        }elseif($tag=="textara" || $tag=="button"){
                            foreach($attributList as $attribute => $attrValue){
                                if(trim(strtolower($attribute))!="value"){
                                    $attr .= " $attribute='$attrValue'";
                                }
                            }
                            $value = array_key_exists('value', $attributList) ? $attributList["value"]: "";
                            $return .= "$htmlBefore<$tag $attr >$value</textarea>$htmlAfter"; 
                        }elseif($tag=="select"){
                            // multiple select debug (1/2)
                            if(in_array(format::normalize("multiple"), $attributList["attributList"])){
                                if(!in_array(format::normalize("required"), $attributList["attributList"])){
                                    $attributList["attributList"]["required"] = NULL;
                                }
                            }

                            // i continue (multiple or single)
                            foreach($attributList["attributList"] as $attribute => $attrValue){
                                if(trim(strtolower($attribute))!="option"){
                                    $attr .= " $attribute='$attrValue'";
                                }
                            }
                            $optionList = "";
                            if(array_key_exists('option', $attributList["attributList"])){
                                if(gettype($attributList["attributList"]["option"])=="array"){
                                    // multiple select debug (1/2)
                                    if(in_array(format::normalize("multiple"), $attributList["attributList"])){
                                        $attributList["attributList"]["option"][NULL]="";
                                    }

                                    foreach($attributList["attributList"]["option"] as $kOption => $vOption){
                                        $optionList .= "<option value='$kOption'>$vOption</option>";
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

    public function check():array{
        $err =  array(
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
            "misElmt" => "Element(s) de formulaire en trop ou manquant"
        );
        $errorList = array();
        $methodUsed = (format::normalize($this->method)=="post") ? "POST" : "GET";
        $dataSubmit = (format::normalize($this->method)=="post") ? $_POST : $_GET;
        if(count($dataSubmit)>0){ // i check if i have data (if the form is submit)

            if(count($dataSubmit)==count($this->element)){ // check if number of parameters get/post

                // FIRST ARRAY
                $elementListNameFromObj = array(); // i create a new array for add the name of all elements form object 
                foreach($this->element as $k => $attributList){ // for each element
                    $elementListNameFromObj[] = $attributList["attributList"]["name"]; // i add in array the name of all elements from object
                }

                // SECOND ARRAY
                $elementListNameFromSubmit = array(); // array for retrieve all names for elements from submit (i don't will use array_reverse for security reasons and possible conflicts)
                foreach($dataSubmit as $kDataSubmit => $vDataSubmit){
                    $elementListNameFromSubmit[] = security::cleanStr($kDataSubmit); 
                }

                // COMPARE ARRAYS
                if(sort($elementListNameFromObj) == sort($elementListNameFromSubmit)){ // all names of the form aren't wrong (all input field names from form are expected)
                    $errorList[] = "OK";
                    foreach($this->element as $k => $attributList){
                        $tag = format::normalize($attributList["tag"]);
                        if($tag == "textarea" || $tag == "input" || $tag == "select"){
                            // CHECK IF FIELD IS REQUIRED
                            $bypassCheckLength = false;
                            if(array_key_exists('required', $attributList["attributList"])){ // i check if there the attr required in object
                                if(security::cleanStr($dataSubmit[$attributList["attributList"]["name"]])==""){
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
                                    
                                    if(array_key_exists($vMinMax, $attributList["attributList"])){
                                        if(is_numeric(format::normalize($attributList["attributList"][$vMinMax]))){ // check if it's an integer
                                            
                                                if($vMinMax=="minlength"){
                                                    if(strlen(format::normalize($dataSubmit[$attributList["attributList"]["name"]])) < $attributList["attributList"][$vMinMax]){ // if data form form > maxlength
                                                        $errorList[] = $err["minlength"];
                                                    }
                                                }else{
                                                    if(strlen(format::normalize($dataSubmit[$attributList["attributList"]["name"]])) > $attributList["attributList"][$vMinMax]){ // if data form form > maxlength
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
                                if(array_key_exists('type', $attributList["attributList"])){
                                    if($attributList["attributList"]["type"]=="email"){
                                        if (!filter_var($dataSubmit[$attributList["attributList"]["name"]], FILTER_VALIDATE_EMAIL)) {
                                            $errorList[] = $err["email"];
                                        }
                                    }elseif($attributList["attributList"]["type"]=="number" || $attributList["attributList"]["type"]=="range"){
                                        if(!is_numeric($dataSubmit[$attributList["attributList"]["name"]])){
                                            $errorList[] = $err["number"];
                                        }else{
                                            // IF IS THE VALUE IS NUMERIC
                                            // attr: min
                                            if(array_key_exists("min", $attributList["attributList"])){ // if the attribute "min" is init in object
                                                if(is_numeric($attributList["attributList"]["min"])){
                                                    if(intval($dataSubmit[$attributList["attributList"]["name"]]) < intval($attributList["attributList"]["min"])){
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
                                            if(array_key_exists("max", $attributList["attributList"])){ // if the attribute "min" is init in object
                                                if(is_numeric($attributList["attributList"]["max"])){
                                                    if(intval($dataSubmit[$attributList["attributList"]["name"]]) > intval($attributList["attributList"]["max"])){
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
                                    }elseif($attributList["attributList"]["type"]=="color"){
                                        if(!preg_match('/^#[a-f0-9]{6}$/i', $dataSubmit[$attributList["attributList"]["name"]])){
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
                                if(array_key_exists('option', $attributList["attributList"])){
                                    if(gettype($attributList["attributList"]["option"])=="array"){ // i check if the option value provided is of type "array"
                                        if(array_key_exists("multiple", $attributList["attributList"])){ // IF SELECT MULTIPLE EXPECTED
                                            // MULTIPLE VALUES RETURNED
                                            if(gettype($dataSubmit[$attributList["attributList"]["name"]])=="array"){
                                                $cleanArr = format::cleanArr($dataSubmit[$attributList["attributList"]["name"]]);
                                                if(count($cleanArr)>0){
                                                    foreach($cleanArr as $value){
                                                        if(!array_key_exists($value, $attributList["attributList"]["option"])){
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
                                                if(!array_key_exists($dataSubmit[$attributList["attributList"]["name"]], $attributList["attributList"]["option"])){ // i check if the value sended is in array (object)
                                                    if(array_key_exists("required", $attributList["attributList"])){
                                                        $errorList[] = $err["unexpectedVal"];
                                                        if(PROD==false){
                                                            trigger_error("<p class='dev_critical'>Security: the value sended form &quot; select &quot; dont't feel be in the object.</p>", E_USER_ERROR);
                                                        }   
                                                    }
                                                }
                                            }
                                        }else{
                                            // IF ALONE VALUE EXPECTED
                                            if(gettype($dataSubmit[$attributList["attributList"]["name"]])=="string"){
                                                if(!array_key_exists($dataSubmit[$attributList["attributList"]["name"]], $attributList["attributList"]["option"])){ // i check if the value sended is in array (object)
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
                
            }else{
                $errorList[] = $err["misElmt"];
                if(PROD==false){
                    var_dump(count($dataSubmit));
                    var_dump(count($this->element));
                    trigger_error("<p class='dev_critical'>Check that all the elements of the form have an attribute &laquo; name &raquo;</p>", E_USER_ERROR);
                }
            }
        }else{
            $errorList[] = $err["nodata"]; 
        }
        return $errorList;
    }
}




/*
   _____ ______ _____ _    _ _____  _____ _________     __
  / ____|  ____/ ____| |  | |  __ \|_   _|__   __\ \   / /
 | (___ | |__ | |    | |  | | |__) | | |    | |   \ \_/ / 
  \___ \|  __|| |    | |  | |  _  /  | |    | |    \   /  
  ____) | |___| |____| |__| | | \ \ _| |_   | |     | |   
 |_____/|______\_____|\____/|_|  \_\_____|  |_|     |_|   
                                                                                                                  
*/
class security{
    // for encrypt data
    public static function encrypt(string $str, string $password){
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($str, $cipher, $password, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $password, $as_binary=true);
        return base64_encode( $iv.$hmac.$ciphertext_raw);
    }
    // for decrypt data
    public static function decrypt(string $str, string $password){
        $c = base64_decode($str);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $password, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $password, $as_binary=true);
        if (hash_equals($hmac, $calcmac))// timing attack safe comparison
        {
            return $original_plaintext."\n";
        }
    }

    public static function cleanStr(string $str):string{
        return htmlentities(trim(preg_replace('/\s+/', ' ', $str)), ENT_QUOTES, "UTF-8");
    }
}
/*
  _____         _____ _______          ______  _____  _____  
 |  __ \ /\    / ____/ ____\ \        / / __ \|  __ \|  __ \ 
 | |__) /  \  | (___| (___  \ \  /\  / / |  | | |__) | |  | |
 |  ___/ /\ \  \___ \\___ \  \ \/  \/ /| |  | |  _  /| |  | |
 | |  / ____ \ ____) |___) |  \  /\  / | |__| | | \ \| |__| |
 |_| /_/    \_\_____/_____/    \/  \/   \____/|_|  \_\_____/ 
                                                                                                                      
*/
class password extends security{
    // for hash password
    public static function hash(string $password, string $algo = "ripemd320"){
        global $password_salt;
        $password_time = strval(time());
        $hash = hash($algo, $password_salt.$password_time.$password);
        return $password_time.",".$hash;
    }

    // Check if the provided password (from form) is the same that in the DB.
    public static function match(string $data, string $password, string $algo = "ripemd320"):bool{ // first parameter come from db (salt,hash) and the second password (clear to compare)
        global $password_salt;
        $password1_time = explode(",",$data)[0]; // salt form $data
        $password1_hash = explode(",",$data)[1]; // password hash form $data

        $password2_hash = hash($algo, $password_salt.$password1_time.$password); // password (2) to compare

        if($password1_hash==$password2_hash){ // check if hash is same
            return true;
        }else{
            return false;
        }
    }

    // generate random password (8 to 10 characters)
    public static function gen(){
        $length = rand(8,10); // password length
        
        $data = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcefghjkmnpqrstuvwxyz'; // 0oO are excludes
        return substr(str_shuffle($data), 0, $length);
    }
}

/*
  ______ ____  _____  __  __       _______ 
 |  ____/ __ \|  __ \|  \/  |   /\|__   __|
 | |__ | |  | | |__) | \  / |  /  \  | |   
 |  __|| |  | |  _  /| |\/| | / /\ \ | |   
 | |   | |__| | | \ \| |  | |/ ____ \| |   
 |_|    \____/|_|  \_\_|  |_/_/    \_\_|   
                                           
                                           
*/
class format{
    // return phone number (Ten character) pair per pair with a dot between
    public static function phone(mixed $n):string{
        return preg_replace('/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/','\1.\2.\3.\4.\5',$n);
    }
    // convert a french phone number to international format
    public static function phoneInternational(mixed $n):string{
        return preg_replace('/^0/', "+33", $n);
    }
    // replace the character "@" by the "@" of font-awesome (spam prevent)
    public static function mailProtect(string $str):string{
        return str_replace("@","<i class='fas fa-at'></i>",$str);
    }
    // convert str to lowercase and remove trim
    public static function normalize(string $str):string{
        return preg_replace('/\s+/', ' ', strtolower(trim($str)));
    }

    public static function cleanArr(array $arr):array{
        $cleanArr = [];

        // first i clean all values and insert into new array
        foreach($arr as $key => $value){
            $cleanValue = format::normalize($value);
            $cleanArr[] = $cleanValue;
        }
        // i remove duplicate values
        array_unique($cleanArr);
        return $cleanArr;
    }

}
?>