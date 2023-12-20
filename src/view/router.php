<html>
<head>
    <meta charset="<?=ENCODE; ?>">
    <title><?=$obj_MetaTitle->getData("title"); ?></title>
    <link rel="Stylesheet" type="text/css" href="/assets/css/default.css" />
    <link rel="stylesheet" href="/assets/css/all.min.css">

    <script type="text/Javascript" src="/assets/js/default.js" defer></script>

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

    <?php echo \class\additionnalJsCss::get("css"); ?>
    <?php echo \class\additionnalJsCss::get("js"); ?>
    <meta name="description" content="<?=$obj_MetaTitle->getData("description"); ?>">
    <meta name="keywords" content="<?=$obj_MetaTitle->getData("keyword"); ?>">
    <meta name="generator" content="Geneager">
    <link rel="icon" type="image/png" href="/assets/favicon/<?=$obj_MetaTitle->getData("favicon"); ?>.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/<?=$obj_MetaTitle->getData("favicon"); ?>-apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/<?=$obj_MetaTitle->getData("favicon"); ?>-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/<?=$obj_MetaTitle->getData("favicon"); ?>-16x16.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
    <meta name="author" content="<?=$obj_MetaTitle->getData("author"); ?>">
    <?=(!empty($meta_robot)? "<meta name='robots' content='$meta_robot'>" : ""); ?>
</head>
<body>
    <?php
        (!is_null($obj_HNF->getHeader())? require_once $obj_HNF->getHeader() : ""); // i load the header (if exist
        (!is_null($obj_HNF->getNavbar())? require_once $obj_HNF->getNavbar() : ""); // i load the navbar (if exist
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
    <?php (!is_null($obj_HNF->getFooter())? require_once $obj_HNF->getFooter() : ""); ?>
</body>
</html>
<?php 
    $conn=null; // we close DB connection
?>

