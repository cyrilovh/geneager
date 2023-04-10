<?php

use class\userInfo;
?>
<aside class="flex-column">
    <?=$output; ?>
    <?=userInfo::isAuthorOrAdmin(userInfo::getUsername()) ? "<p class='bar'><a href='/userEditPicture/?filename=".$picture->getFilename()."' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i> &Eacute;diter</a> <a href='userDeletePicture/".$picture->getID()."' class='btn btn-danger btn-sm'><span class='fas fa-trash'></span> Supprimer</a></p>" : "";?>
</aside>
