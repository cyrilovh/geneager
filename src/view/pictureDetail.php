<aside>
    <?php
        echo $titleHTML.$descriptionHTML;
    ?>
    <p><i class="fa-solid fa-location-dot"></i> </p>
    <p><i class="fa-solid fa-calendar-days"></i> <?=class\format::strToDate($data["yearEvent"].$data["monthEvent"].$data["dayEvent"]); ?></p>
    


    <img src="/photo/<?=$filename;?>" >
</aside>