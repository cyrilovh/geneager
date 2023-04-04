<?php
namespace class;

/**
 * A class to generate a captcha and validate the user's input.
 */
class captcha
{
    public static $captchaNameDefault = "captcha";
    public static $fontFamilly = "../public/assets/fonts/CaviarDreams.ttf";

    /**
     * Generate a captcha picture.
     * Possibble to change name of the session variable: use captcha::$captchaNameDefault = "myCaptchaName";
     * @param int $width
     * @param int $height
     */
    public static function genPicture(int $width = 150, int $height = 75):void{
        $im = imagecreatetruecolor($width, $height);

        $bg = imagecolorallocate($im, 220, 220, 220);
        $white = imagecolorallocate($im, 255, 255, 255);
        $black = imagecolorallocate($im, 0, 0, 0);
        
        // set background colour.
        imagefilledrectangle($im, 0, 0, $width, $height, $bg);
        
        // output text.
        $code = random::alphaNum(4, 5);
        $_SESSION[self::$captchaNameDefault] = $code;

        imagettftext($im, 35, 0, 10, 55, $black, self::$fontFamilly, $code);
        
        for ($i = 0; $i < 25; $i++) {
            //imagefilledrectangle($im, $i + $i2, 5, $i + $i3, 70, $black);
            imagesetthickness($im, rand(1, 4));
            imagearc(
                $im,
                rand(1, 300), // x-coordinate of the center.
                rand(1, 300), // y-coordinate of the center.
                rand(1, 300), // The arc width.
                rand(1, 300), // The arc height.
                rand(1, 300), // The arc start angle, in degrees.
                rand(1, 300), // The arc end angle, in degrees.
                (rand(0, 1) ? $black : $white) // A color identifier.
            );
        }
        
        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);
    }

    /**
     * Check if the user's input is correct.
     * Possibble to change name of the session variable: use captcha::$captchaNameDefault = "myCaptchaName";
     * @param string $data The user's input.
     * @return bool
     */
    public static function check(string $data):bool{
        if (isset($data) && isset($_SESSION[self::$captchaNameDefault])){
            if (strtolower($data) == strtolower($_SESSION[self::$captchaNameDefault])){
                return true;
            }
        }
        return false;
    }

}
