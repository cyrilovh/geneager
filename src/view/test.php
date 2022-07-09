<?=(isset($errorList)) ? "<div class='alert alert-danger'>$errorList</div>" : ""; ?> <!-- form errors -->
<?php
    echo $form->display();
?>
