<aside>
    <h2>Mettre en ligne une photo</h2>
    <?=(isset($errorList)) ? "<div class='alert alert-danger'>$errorList</div>" : ""; ?> <!-- form errors -->
    <?=(isset($successMsg)) ? "<div class='alert alert-success'>$successMsg</div>" : ""; ?> <!-- form errors -->
    <?=(isset($infoMsg)) ? "<div class='alert alert-info'>$infoMsg</div>" : ""; ?> <!-- form errors -->
    <?=(isset($warningList)) ? "<div class='alert alert-warning'>$warningList</div>" : ""; ?> <!-- form warning -->
    <?php

    use class\validator;

        echo $form->display();
    ?>
</aside>

<?php
    if(validator::isId()){
        $id=$_GET["id"];
        echo "ID fournis <b>$id</b>";
    }
?>
