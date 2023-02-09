<aside>
    <?php
        echo $titleHTML.$descriptionHTML;
    ?>
    <p><i class="fa-solid fa-location-dot"></i> </p>
    <p><i class="fa-solid fa-calendar-days"></i> <?=class\format::strToDate(\class\format::YMDtoStr($data["yearEvent"],$data["monthEvent"],$data["dayEvent"])); ?></p>
    <div class="preview">
        <img src="/photo/<?=$filename;?>" style="width:100%; max-width:100vw;">
    </div>
</aside>