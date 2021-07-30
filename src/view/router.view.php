<!--
    THIS FILE THE BASE OF THE VIEWS ("TEMPLATE")
-->
<html>
<head>
    <meta charset="<?=ENCODE; ?>">
    <title><?=$obj_MetaTitle->getData("title"); ?></title>
    <link rel="Stylesheet" type="text/css" href="assets/css/default.css" />
    <link rel="stylesheet" href="assets/css/all.min.css">

    <script type="text/Javascript" src="assets/js/default.js" defer></script>

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

    <?php echo \gng\additionnalJsCss::get("css"); ?>
    <?php echo \gng\additionnalJsCss::get("js"); ?>
    <meta name="description" content="<?=$obj_MetaTitle->getData("description"); ?>">
    <meta name="keywords" content="<?=$obj_MetaTitle->getData("keyword"); ?>">
    <meta name="generator" content="Geneager">
    <meta name="author" content="<?=$obj_MetaTitle->getData("author"); ?>">
</head>
<body>
    <?php
        $obj_HNF->get("header"); 
        $obj_HNF->get("navbar"); 
    ?>
    <main>
        <?php
            // here i load view(s)
            foreach($include_MVC as $f){
                $explode = explode(":", $f);
                if($explode[0]=="view"){
                    require $explode[1];
                }
            }
        ?>
    </main>
    <?php
        $obj_HNF->get("footer"); 
    ?>
</body>
</html>
<?php 
    $conn=null; // we close DB connection
?>

