<img src="/picture/family/<?=$picture['filename'];?>" title="<?=$picture['title']; ?>" id="picture" usemap="#workmap" />
<div class="popup">
    <div class="window">
        <h1>Gestion des identifications:</h1>
        <table>
            <tr>
                <td>
                    photo + identité
                </td>
                <td>
                    coordonnées
                </td>
                <td>
                    boutons actions
                </td>
            </tr>

        </table>
    </div>
</div>
<?php
    foreach($tagList->getTagList() as $tag){
        $ancestor = $tag->getAncestor()->getFullIdentityDisplayShorter(true);
        $coordinates = $tag->getCoordinates()->getCSS();
        $ancestorID = $tag->getAncestor()->getID();
        echo "
        <div style='$coordinates' class='tag'>
            <div>
                <div>
                    <a href='/ancestor/$ancestorID'><span class='fas fa-eye'></span></a>
                    <a href='/userEditAncestor/$ancestorID'><span class='fas fa-edit'></span></a>
                    <span class='fas fa-trash'></span>
                </div>
                <p>$ancestor</p>
            </div>
        </div>";
    }
?>
