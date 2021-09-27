<?php
    echo "<p>test test test test test</p>";
    echo test::test2();

?>

<form method="post" action="/test">
    <input type="text" value="" name="inputtest"/>
    <input type="submit" value="ok" />
</form>
<?php
        echo "--------------------------------<br>";
        echo "--------------------------------<br>";
        echo "--------------------------------<br>";
        echo "<hr>\$_POST:<br>";
        if(isset($_POST)){
            var_dump($_POST);
        }
        echo "<hr>";
        echo "--------------------------------<br>";
        echo "--------------------------------<br>";
        echo "--------------------------------<br>";
?>

<?php

        echo "<hr>\$post:<br>";
        if(isset($_POST['inputtest'])){
            echo \gng\post::get("inputtest");
        }
        echo "<hr>";
        echo "--------------------------------<br>";
        echo "--------------------------------<br>";
        echo "--------------------------------<br>";
        echo "\$GET:<br>";
        echo \gng\get::get();

        echo "--------------------------------<br>";
        echo "--------------------------------<br>";
        echo "--------------------------------<br>";
        echo "--------------------------------<br>";
?>

<?php

    /*
        https://www.php.net/manual/fr/function.substr.php
    */
    function strrevpos($instr, $needle)
    {
        $rev_pos = strpos (strrev($instr), strrev($needle));
        if ($rev_pos===false) return false;
        else return strlen($instr) - $rev_pos - strlen($needle);
    };
    function after_last($thisone, $inthat)
    {
        if (!is_bool(strrevpos($inthat, $thisone)))
        return substr($inthat, strrevpos($inthat, $thisone)+strlen($thisone));
    };
    echo after_last ('?', '/test/#!hello');
 
?>