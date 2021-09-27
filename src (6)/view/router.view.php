<html>
<head>
    <meta charset="<?=ENCODE; ?>">
    <title><?=$obj_MetaTitle->getData("title"); ?></title>
    <link rel="Stylesheet" type="text/css" href="/public/assets/css/default.css" />

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

