<?php

use class\userInfo;
?>
<aside>
    <h1><?=$title; ?></h1>
    <?=(isset($errorMsg) ? die("<div class='alert alert-danger'>".$errorMsg."</div>") : ""); ?>
    <?=(isset($successMsg) ? die("<div class='alert alert-success'>".$successMsg."</div>") : ""); ?>
    <p>Nom d'utilisateur:</p>
    <p><input type="text" class="form-control w100" name="username" value="<?=$userData["username"]?>" disabled></p>
    <p>Role:</p>
    <p><input type="text" class="form-control w100" name="role" value="<?=$userData["role"]?>" disabled></p>
    <hr>
    <?=$userForm->display(); ?>
</aside>