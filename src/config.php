<?php
    /* CONFIG HERE THE INFORMATIONS FOR MySQL*/
    $db_name ="geneager"; // the name of the database
    $db_host ="127.0.0.1"; // hostname of you database server (if you don't know ty 127.0.0.1 or localhost)
    $db_user = "root"; // the username for connection to database
    $bd_password = ""; // password fot connection to database

    /* GENERAL CONFIG */
    define('ENCODE', "UTF-8"); // encode
    define('SALT_PASSWORD', "qs--ZU=FxG8eCYCesQ"); // STATIC SALT FOR ENCRYPT PASSWORD IN DATABASE
    define('KEY_EMAIL', "V-J8#JDyz5Ja#!=V"); // STATIC SALT FOR ENCRYPT PASSWORD IN DATABASE

    /* SECURTY */
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