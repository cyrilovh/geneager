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
     * @return void
     */
    public static function encrypt(string $str, string $password){
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
     * @return void
     */
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
    /**
     * Clean sting: htmlentities + trim and remove double spaces
     *
     * @param string $str
     * @return string
     */
    public static function cleanStr(string $str):string{
        return htmlentities(trim(preg_replace('/\s+/', ' ', $str)), ENT_QUOTES, "UTF-8");
    }
}
?>