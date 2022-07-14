<aside>
    <h2>Mettre en ligne une photo</h2>
    <?=(isset($errorList)) ? "<div class='alert alert-danger'>$errorList</div>" : ""; ?> <!-- form errors -->
    <?=(isset($successMsg)) ? "<div class='alert alert-success'>$successMsg</div>" : ""; ?> <!-- form errors -->
    <?=(isset($infoMsg)) ? "<div class='alert alert-info'>$infoMsg</div>" : ""; ?> <!-- form errors -->
    <?php
        echo $form->display();
    ?>
</aside>

<?php
    if(isset($_POST["id"])){
        $id=$_POST["id"];
        echo "<b>$id</b>";
    }else{
        echo "nothing";
    }
