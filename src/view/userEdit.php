<?php

use class\userInfo;
?>
<aside>
    <p class="bar"><a href="/userPassword" class="btn btn-sm btn-info"><span class='fas fa-key'></span> Modifier le mot passe</a></p>
    <h1><?=$title; ?></h1>
    <p><b>Status: </b><?=($userData["banned"] == "0") ? "<span class='txt-green'>Actif</span>" : "<span class='txt-red'>Banni</span>"; ?></p><br>
    <?=(isset($errorMsg) ? die("<div class='alert alert-danger'>".$errorMsg."</div>") : ""); ?>
    <?=(isset($successMsg) ? die("<div class='alert alert-success'>".$successMsg."</div>") : ""); ?>
    <p>Nom d'utilisateur:</p>
    <p><input type="text" class="form-control w100" name="username" value="<?=$userData["username"]?>" disabled></p>
    <p>Role:</p>
    <p><input type="text" class="form-control w100" name="role" value="<?=$userData["role"]?>" disabled></p>
    <hr>
    <?=$userForm->display(); ?>
</aside>