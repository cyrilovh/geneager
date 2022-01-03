<h1>Tests</h1>
<?php
    if(!isset($_GET["name"])){
        $files = array_diff(scandir("."), array('.', '..','index.php'));
        foreach($files as $file){
            echo "<a href='?name=$file'>$file</a>";
        }
    }else{
        // autoload PHP classes
        require "../src/config.php";
        define("MVC", "../src/");
        require_once MVC."autoload.php";
        autoloader::register();
        include $_GET["name"];
    }
?>