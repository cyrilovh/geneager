<?php

use class\display, class\format, class\UserInfo; ?>
<aside>
    <h2>Liste des fiches d'identités:</h2>
    <div class="filterList">
        Trier par
        <select name="ancestorOrderBy" class="filter">
            <?php
            foreach (enumList\ancestorOrderBy::array() as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
            ?>
        </select>
        Ordre
        <select name="sortBy" class="filter">
            <?php
            foreach (enumList\sortBy::array() as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
            ?>
        </select>
    </div>
    <div class="filterList">
        Filtrer genre:
        <select name="gender" class="filter removable">
            <?php
            foreach (enumList\gender::array() as $key => $value) {
                echo "<option value='$key'>" . format::htmlToUpperFirst($value) . "</option>";
            }
            ?>
        </select>
    </div>
    <p class="bar">
        <a class="btn btn-outline-success btn-sm" href="/userNewAncestor"><i class="fa-solid fa-plus"></i> Nouvel ancêtre</a>
    </p>
    <div class="ancestorList">
        <?= $output; ?>
    </div>
</aside>
<?php
echo class\paging::gen($pageCount, $page);
?>