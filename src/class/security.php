<?php
namespace class;
/**
* Security class (encrypt/decrypt data), clean filters (security)
*/
class security{
    /**
     * Encrypt data
     *
     * @param string $str
     * @param string $password
     * @return string
     */
    public static function encrypt(string $str, string $password):string{
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($str, $cipher, $password, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $password, $as_binary=true);
        return base64_encode( $iv.$hmac.$ciphertext_raw);
    }
    /**
     * Decrypt data
     *
     * @param string $str
     * @param string $password
     * @return string
     */
    public static function decrypt(string $str, string $password):string{
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
        return "";
    }
    /**
     * Clean sting: htmlentities + trim and remove double spaces
     *
     * @param string $str
     * @return string
     */
    public static function cleanStr(string $str):string|null{
        return is_null($str) ? "" : htmlentities(trim(preg_replace('/\s+/', ' ', $str)), ENT_QUOTES, "UTF-8");
    }

    /**
     * Clean array: htmlentities + trim and remove double spaces + remove duplicated values
     *
     * @param array $arr
     * @return array
     */
    public static function cleanArr(array $arr):array{
        $cleanArr = [];

        // first i clean all values and insert into new array
        foreach($arr as $key => $value){
            $cleanValue = static::cleanStr($value);
            $cleanArr[] = $cleanValue;
        }
        // i remove duplicate values
        array_unique($cleanArr);
        return $cleanArr;
    }

    /**
     * Clean filename: remove all special chars and replace by underscore
     *
     * @param string $filename filename to clean with extension
     * @return string
     */
    public static function cleanFilename(string $filename):string{
        $fileParts = pathinfo($filename);
        $filenameOnly = preg_replace( '/[^a-z0-9_-]+/', '_', strtolower($fileParts["filename"]) );
        $extension = preg_replace( '/[^a-z0-9]+/', '_', strtolower($fileParts["extension"]) );
        return $filenameOnly.".".$extension;
    }
}
?>