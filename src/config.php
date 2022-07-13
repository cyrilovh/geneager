<?php
    /* CONFIG HERE THE INFORMATIONS FOR MySQL*/
    $db_name ="geneager"; // the name of the database
    $db_host ="127.0.0.1"; // hostname of you database server (if you don't know ty 127.0.0.1 or localhost)
    $db_user = "root"; // the username for connection to database
    $bd_password = ""; // password fot connection to database

    /* GENERAL CONFIG */
    define('ENCODE', "UTF-8"); // encode

    define('ROOT_DIR',  $_SERVER['DOCUMENT_ROOT']."/");
    define('UPLOAD_DIR', "private/upload/"); // upload directory
    define('UPLOAD_DIR_FULLPATH', ROOT_DIR.UPLOAD_DIR); // upload directory
    define('MAX_FILE_SIZE', 5242880); // max file size in bytes (FR: octets) 2097152 = 2Mo (2 * 1024 * 1024)
    define('UPLOAD_FILETYPE_ALLOWED', array(
        "picture" => array("image/png", "image/jpeg", "image/gif", "image/webp"),
        "video" => array("video/mp4", "video/ogg", "video/webm"),
        "audio" => array("audio/mp3", "audio/ogg", "audio/weba"),
        "document" => array("application/pdf"),
    )); // array of file types allowed to upload
    define('QUALITY_FILE_CONVERSION', 80); // quality of file conversion (100 = max quality). This is used for image conversion jpg to webp for example. 

    // THIS FOLLOWING LINES IN COMMENT ARE NOT YET USED (they will be used in the future versions)
    // define('UPLOAD_MAX_FILES', 10); // max files allowed to upload per request
    // define('UPLOAD_MAX_FILESIZE_TOTAL', 5242880); // max file size in bytes (FR: octets) 2097152 = 2Mo (2 * 1024 * 1024) for all files per request


    /* SECURTY */

    /* encrypt data */
    define('SALT_PASSWORD', "qs--ZU=FxG8eCYCesQ"); // STATIC SALT FOR ENCRYPT PASSWORD IN DATABASE
    // define('KEY_EMAIL', "V-J8#JDyz5Ja#!=V"); // STATIC SALT FOR ENCRYPT EMAIL IN DATABASE

    /* crsf */
    define('PASSWORD_TOKEN', 'CHANGE-YOUR-TOK3N'); // TOKEN FOR FORMS (ANTI-CSRF)
    define('TOKEN_LIFETIME', '10');   // TOKEN LIFE TIME MINUTES

    /* DEV MODE */
    define("PROD", false);

    /* Session start */
    session_start();

/*
  _____              _ _        _                   _          __      _ _               _                     _ _                 
 |  __ \            ( ) |      | |                 | |        / _|    | | |             (_)                   | (_)                
 | |  | | ___  _ __ |/| |_     | |_ ___  _   _  ___| |__     | |_ ___ | | | _____      ___ _ __   __ _ ___    | |_ _ __   ___  ___ 
 | |  | |/ _ \| '_ \  | __|    | __/ _ \| | | |/ __| '_ \    |  _/ _ \| | |/ _ \ \ /\ / / | '_ \ / _` / __|   | | | '_ \ / _ \/ __|
 | |__| | (_) | | | | | |_     | || (_) | |_| | (__| | | |   | || (_) | | | (_) \ V  V /| | | | | (_| \__ \   | | | | | |  __/\__ \
 |_____/ \___/|_| |_|  \__|     \__\___/ \__,_|\___|_| |_|   |_| \___/|_|_|\___/ \_/\_/ |_|_| |_|\__, |___/   |_|_|_| |_|\___||___/
                                                                                                  __/ |                            
                                                                                                 |___/                                        
  _  __                                                          _                     _            
 (_)/ _|                                                        | |                   | |           
  _| |_     _   _  ___  _   _      __ _ _ __ ___     _ __   ___ | |_      __ _      __| | _____   __
 | |  _|   | | | |/ _ \| | | |    / _` | '__/ _ \   | '_ \ / _ \| __|    / _` |    / _` |/ _ \ \ / /
 | | |     | |_| | (_) | |_| |   | (_| | | |  __/   | | | | (_) | |_    | (_| |   | (_| |  __/\ V / 
 |_|_|      \__, |\___/ \__,_|    \__,_|_|  \___|   |_| |_|\___/ \__|    \__,_|    \__,_|\___| \_/  
             __/ |                                                                                  
            |___/                                                                                      
    
*/

    /* HEADER, NAVBAR, FOOTER per default */
    $include_header = ""; // default: header (header = call the file /src/inc/header.inc.php)
    $include_navbar = ""; // default: navbar (")
    $include_footer = ""; // default: footer (")

    /* default values */
    $meta_robots = ""; // empty, "nofollow", "noindex" or "noindex, nofollow"

    /* list of pages (views) not directly accessible via a query */
    const DENIEDVIEWS = array('router', '404', 'noContent'); // list of views not accessibles from URL bar or query

    /* PROD/DEV */
    if(PROD==true){
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
    }else{
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    $include_JsCss = array()
?>